import uvicorn
from fastapi import FastAPI, HTTPException, Depends
from fastapi.middleware.cors import CORSMiddleware
from sqlalchemy.orm import Session
from sqlalchemy import text

# Import Database & ML Logic
from .database import get_db
from . import ml_engine
from .sys_logger import log

app = FastAPI(title="SportStore AI Real Recommendation Service")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

@app.get("/")
def read_root():
    return {"status": "ok", "message": "SportStore ML Service is running normally on port 8001"}

@app.get("/api/v1/health")
def health_check():
    return {"status": "healthy", "service": "sportstore-ai"}

@app.get("/api/v1/test-db")
def test_db_connection(db: Session = Depends(get_db)):
    """
    Thực hiện query đơn giản để kiểm tra kết nối Database MySQL
    """
    log.info("Nhận Request API: GET /api/v1/test-db")
    try:
        # Thực hiện SELECT 1 để kiểm tra ping tới MySQL
        db.execute(text("SELECT 1"))
        return {
            "success": True,
            "message": "Kết nối Database MySQL thành công!",
            "database": "sportstore_be"
        }
    except Exception as e:
        log.error(f"Lỗi kết nối DB: {str(e)}")
        raise HTTPException(status_code=500, detail=f"Không thể kết nối Database: {str(e)}")

@app.get("/api/v1/recommend/popular")
def get_popular_recommendations(db: Session = Depends(get_db)):
    """
    Tính Popular score từ Database và log lại.
    """
    log.info("Nhận Request API: GET /api/v1/recommend/popular")
    try:
        popular_ids = ml_engine.get_popular_items(db, top_n=8)
        return {
            "success": True,
            "message": "Danh sách sản phẩm phổ biến nhất hệ thống",
            "data": popular_ids
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

@app.get("/api/v1/recommend/user/{user_id}")
def get_personalized_recommendations(user_id: int, db: Session = Depends(get_db)):
    """
    Lấy điểm gợi ý cá nhân hóa dựa vào Collaborative Filtering
    """
    log.info(f"Nhận Request API: GET /api/v1/recommend/user/{user_id}")
    if user_id <= 0:
        log.error(f"Request từ chối: user_id={user_id} không hợp lệ")
        raise HTTPException(status_code=400, detail="Trường user_id không hợp lệ")
    
    try:
        recommended_ids = ml_engine.get_item_based_recommendations(user_id=user_id, db=db, top_n=8)
        return {
            "success": True,
            "message": f"ML Personalized Recommendation cho user {user_id}",
            "data": recommended_ids
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

@app.get("/api/v1/recommend/item/{product_id}")
def get_similar_item_recommendations(product_id: int, db: Session = Depends(get_db)):
    """
    Lấy danh sách sản phẩm tương tự dựa trên Item-Item Cosine Similarity.
    Dùng cho trang chi tiết sản phẩm.
    """
    log.info(f"Nhận Request API: GET /api/v1/recommend/item/{product_id}")
    if product_id <= 0:
        raise HTTPException(status_code=400, detail="product_id không hợp lệ")
    
    try:
        similar_ids = ml_engine.get_similar_items(product_id=product_id, db=db, top_n=12)
        return {
            "success": True,
            "message": f"Sản phẩm tương tự với item {product_id}",
            "data": similar_ids
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == "__main__":
    uvicorn.run("app.main:app", host="0.0.0.0", port=8001, reload=True)
