import pandas as pd
from sqlalchemy.orm import Session
from sklearn.metrics.pairwise import cosine_similarity
import numpy as np
from .sys_logger import log_ai, log

# Định nghĩa trọng số cho các hành vi
BEHAVIOR_WEIGHTS = {
    'mua_hang': 5.0,
    'them_gio_hang': 4.0,
    'yeu_thich': 3.0,
    'click': 2.0,
    'xem': 1.0
}

def fetch_behavior_data(db: Session):
    """
    Query dữ liệu từ bảng hanh_vi_nguoi_dung và chuyển đổi thành DataFrame có điểm số tĩnh.
    Chỉ lấy những User đã login (thực sự).
    """
    query = """
        SELECT nguoi_dung_id, san_pham_id, hanh_vi
        FROM hanh_vi_nguoi_dung
        WHERE nguoi_dung_id IS NOT NULL
    """
    # Sử dụng connection từ Session để query bằng pandas
    df = pd.read_sql_query(query, db.bind)
    return df

def process_behavior_scores(df: pd.DataFrame) -> pd.DataFrame:
    """
    Quy đổi hành vi ra điểm số và tính tổng điểm của từng User đối với từng Item
    """
    if df.empty:
        return df
        
    # Map text sang score
    df['score'] = df['hanh_vi'].map(BEHAVIOR_WEIGHTS).fillna(0)
    
    # Gom nhóm và tính tổng score cho mỗi cặp (User, Item)
    user_item_scores = df.groupby(['nguoi_dung_id', 'san_pham_id'])['score'].sum().reset_index()
    return user_item_scores

def get_popular_items(db: Session, top_n: int = 8) -> list:
    """
    Lấy danh sách top N sản phẩm thịnh hành dựa trên tổng tương tác (không đăng nhập)
    Chạy query gồm cả user null để tính tổng thể website.
    """
    query = """
        SELECT san_pham_id, hanh_vi
        FROM hanh_vi_nguoi_dung
    """
    df = pd.read_sql_query(query, db.bind)
    if df.empty:
        log.warning("Database trống, không thể lấy Popular items.")
        return []

    # Map weight cho toàn bộ (kể cả Guest)
    df['score'] = df['hanh_vi'].map(BEHAVIOR_WEIGHTS).fillna(0)
    
    # Tính tổng điểm popular cho mỗi item
    item_scores = df.groupby('san_pham_id')['score'].sum().sort_values(ascending=False).reset_index()
    
    result = item_scores['san_pham_id'].head(top_n).tolist()
    log_ai("FALLBACK", f"Trả về Top {top_n} mặt hàng phổ biến: {result}")
    return result

def get_item_based_recommendations(user_id: int, db: Session, top_n: int = 8) -> list:
    """
    Collaborative Filtering: Lọc cộng tác dự trên các sản phẩm (Item-based)
    Hệ thống gợi ý các "Item" có "Tính tương đồng Cosine" cao nhất với những sản phẩm mà user_id đã từng tương tác.
    """
    df_raw = fetch_behavior_data(db)
    
    if df_raw.empty:
        log.warning(f"Chưa có bất kỳ user nào tương tác. Kích hoạt phổ biến cho User {user_id}")
        return get_popular_items(db, top_n)
        
    df = process_behavior_scores(df_raw)
    
    # Kiểm tra xem User này có tồn tại trong Data tương tác chưa
    if user_id not in df['nguoi_dung_id'].values:
        log_ai("COLD-START", f"User [{user_id}] mới tinh chưa có hành vi. (Fallback -> Popular Items)")
        return get_popular_items(db, top_n)
    
    log_ai("DATA", f"Hệ thống đã nạp {len(df_raw)} records, đã chấm trọng số. Đang lập ma trận User-Item...")
    
    # 1. Tạo Ma Trận User - Item
    # Hàng là người dùng, Cột là sản phẩm, Giá trị là tổng Điểm
    user_item_matrix = df.pivot(index='nguoi_dung_id', columns='san_pham_id', values='score').fillna(0)
    
    # 2. Tính Ma trận độ tương đồng (Item-Item Similarity Matrix)
    # Cosine Similarity trên Column của Item (đã transpose)
    log_ai("COMPUTE", f"Đang tính toán Cosine Similarity cho User {user_id}")
    item_similarity = cosine_similarity(user_item_matrix.T)
    # Tạo DataFrame cho dễ tra cứu (Index và Column đều là Item IDs)
    item_sim_df = pd.DataFrame(item_similarity, index=user_item_matrix.columns, columns=user_item_matrix.columns)
    
    # 3. Thông tin hành vi quá khứ của User hiện tại
    user_history = user_item_matrix.loc[user_id]
    user_interacted_items = user_history[user_history > 0].index.tolist()
    
    # 4. Dự báo điểm (Score prediction) cho các Sản phẩm User chưa xem
    predicted_scores = {}
    
    all_items = user_item_matrix.columns.tolist()
    items_to_predict = [item for item in all_items if item not in user_interacted_items]
    
    if not items_to_predict:
        # Nếu user cày nát website coi hết mọi sản phẩm -> Trả về random popular
        return get_popular_items(db, top_n)

    for unseed_item in items_to_predict:
        score_sum = 0
        similarity_sum = 0
        
        for interacted_item in user_interacted_items:
            # Độ tương đồng giữa item đã xem và item đang dự báo
            sim = item_sim_df.loc[unseed_item, interacted_item]
            # Mức độ user thích item đã xem
            rating = user_history[interacted_item]
            
            score_sum += sim * rating
            similarity_sum += sim
            
        if similarity_sum > 0:
            predicted_scores[unseed_item] = score_sum / similarity_sum
        else:
            predicted_scores[unseed_item] = 0

    # Sort descending
    sorted_items = sorted(predicted_scores.items(), key=lambda x: x[1], reverse=True)
    
    # Lấy ra Top N Item ID khuyên dùng nhất
    recommended_item_ids = [item[0] for item in sorted_items[:top_n]]
    
    # Nếu chưa đủ List (do item thưa) thì độn thêm Popular items
    if len(recommended_item_ids) < top_n:
        log_ai("FILL", f"Số lượng User {user_id} xem còn ít. Lấp đầy mảng bằng Popular items.")
        popular_fill = get_popular_items(db, top_n=top_n*2)
        for p_item in popular_fill:
            if p_item not in recommended_item_ids and p_item not in user_interacted_items:
                recommended_item_ids.append(p_item)
            if len(recommended_item_ids) >= top_n:
                break
                
    log_ai("RESULT", f"Gợi ý hoàn tất cho User {user_id}: {recommended_item_ids}")            
    return recommended_item_ids


def get_similar_items(product_id: int, db: Session, top_n: int = 8) -> list:
    """
    Item-to-Item Similarity: Tìm các sản phẩm tương tự với product_id dựa trên
    cosine similarity từ ma trận item-item (built from user behavior data).
    Fallback: lấy sản phẩm cùng danh mục hoặc thương hiệu.
    """
    df_raw = fetch_behavior_data(db)
    
    if not df_raw.empty:
        df = process_behavior_scores(df_raw)
        
        # Kiểm tra product_id có trong dữ liệu tương tác không
        if product_id in df['san_pham_id'].values:
            log_ai("SIMILAR", f"Tính Item-Item Similarity cho sản phẩm {product_id}")
            
            # 1. Tạo User-Item Matrix
            user_item_matrix = df.pivot(index='nguoi_dung_id', columns='san_pham_id', values='score').fillna(0)
            
            # 2. Tính Item-Item Cosine Similarity
            item_similarity = cosine_similarity(user_item_matrix.T)
            item_sim_df = pd.DataFrame(item_similarity, index=user_item_matrix.columns, columns=user_item_matrix.columns)
            
            # 3. Lấy top N sản phẩm tương tự nhất (loại bỏ chính nó)
            similar_scores = item_sim_df[product_id].drop(product_id, errors='ignore').sort_values(ascending=False)
            similar_ids = similar_scores.head(top_n).index.tolist()
            
            if len(similar_ids) >= top_n // 2:
                log_ai("RESULT", f"Sản phẩm tương tự với {product_id}: {similar_ids}")
                return similar_ids
            
            # Nếu không đủ, bổ sung từ fallback
            log_ai("FILL", f"Chỉ tìm được {len(similar_ids)} items tương tự, bổ sung từ DB")
            fallback_ids = _get_category_fallback(product_id, db, top_n * 2)
            for fid in fallback_ids:
                if fid not in similar_ids and fid != product_id:
                    similar_ids.append(fid)
                if len(similar_ids) >= top_n:
                    break
            return similar_ids
    
    # Fallback: lấy sản phẩm cùng danh mục / thương hiệu
    log_ai("FALLBACK", f"Không có dữ liệu tương tác cho sản phẩm {product_id}. Dùng Category fallback.")
    return _get_category_fallback(product_id, db, top_n)


def _get_category_fallback(product_id: int, db: Session, top_n: int = 8) -> list:
    """
    Fallback: Lấy sản phẩm cùng danh_muc_id hoặc thuong_hieu_id, ưu tiên bán chạy.
    """
    query = f"""
        SELECT sp2.id
        FROM san_pham sp1
        JOIN san_pham sp2 ON (sp2.danh_muc_id = sp1.danh_muc_id OR sp2.thuong_hieu_id = sp1.thuong_hieu_id)
        WHERE sp1.id = {product_id}
          AND sp2.id != {product_id}
          AND sp2.trang_thai = 1
        ORDER BY sp2.da_ban DESC
        LIMIT {top_n}
    """
    result_df = pd.read_sql_query(query, db.bind)
    ids = result_df['id'].tolist() if not result_df.empty else []
    log_ai("CATEGORY-FALLBACK", f"Sản phẩm cùng danh mục/thương hiệu với {product_id}: {ids}")
    return ids
