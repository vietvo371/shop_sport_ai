const fs = require('fs');

const files = [
    './nike_full_dataset.json',
    './wika_full_dataset.json',
    './kaiwin_full_dataset.json',
    './kamito_full_dataset.json'
];

function mapCategories(brand, name, currentCats) {
    let parent = "Khác";
    let child = "Khác";
    const nameLower = name.toLowerCase();
    const catsLower = (currentCats || []).join(" ").toLowerCase();
    const combined = nameLower + " " + catsLower;

    // 1. Phân loại cấu trúc "danh mục cha"
    if (combined.includes('pickleball') || nameLower.includes('pickleball') || combined.includes('pickeball') || nameLower.includes('pickeball')) {
        parent = "Pickleball";
    } else if (combined.includes('cầu lông') || nameLower.includes('cầu lông')) {
        parent = "Cầu lông";
    } else if (combined.includes('bóng chuyền') || nameLower.includes('chuyền')) {
        parent = "Bóng chuyền";
    } else if (combined.includes('bóng bàn') || nameLower.includes('bàn')) {
        parent = "Bóng bàn";
    } else if (combined.includes('chạy bộ') || combined.includes('running') || combined.includes('runner') || nameLower.includes('pegasus') || nameLower.includes('winflo') || nameLower.includes('zoom')) {
        parent = "Chạy bộ";
    } else if (combined.includes('bóng đá') || nameLower.includes('striker') || nameLower.includes('veloz') || nameLower.includes('faster') || nameLower.includes('tf') || nameLower.includes('k-pro') || nameLower.includes('tl22')) {
        parent = "Bóng đá";
    } else if (combined.includes('lifestyle') || combined.includes('thời trang') || combined.includes('polo') || combined.includes('tshirt') || combined.includes('t-shirt') || nameLower.includes('air max') || nameLower.includes(' ls.')) {
        parent = "Thời trang";
    } else if (combined.includes('balo') || combined.includes('túi') || combined.includes('sa bàn') || combined.includes('phụ kiện') || combined.includes('tất') || combined.includes('vớ')) {
        parent = "Phụ kiện";
    } else {
        parent = "Thể thao";
    }

    if (brand === "Nike" && parent === "Thể thao") {
        if (catsLower.includes('women')) parent = "Thời trang Nữ";
        if (catsLower.includes('kids')) parent = "Thời trang Trẻ em";
        else parent = "Thời trang";
    }

    // 2. Phân loại cấu trúc "danh mục con"
    if (nameLower.includes('giày') || nameLower.includes('shoe')) {
        if (parent === "Bóng đá") child = "Giày bóng đá";
        else if (parent === "Pickleball") child = "Giày Pickleball";
        else if (parent === "Cầu lông") child = "Giày cầu lông";
        else if (parent === "Bóng chuyền") child = "Giày bóng chuyền";
        else if (parent === "Bóng bàn") child = "Giày bóng bàn";
        else if (parent === "Chạy bộ") child = "Giày chạy bộ";
        else child = "Giày thể thao";
    } else if (nameLower.includes('áo') || nameLower.includes('shirt') || nameLower.includes('top') || nameLower.includes('jersey') || nameLower.includes('polo')) {
        if (nameLower.includes('polo')) child = "Áo Polo";
        else if (nameLower.includes('t-shirt') || nameLower.includes('tshirt') || nameLower.includes('thun')) child = "Áo thun thể thao";
        else if (parent === "Bóng đá") child = "Áo bóng đá";
        else if (parent === "Bóng bàn") child = "Áo bóng bàn";
        else child = "Áo thể thao";
    } else if (nameLower.includes('quần') || nameLower.includes('short') || nameLower.includes('pant') || nameLower.includes('legging')) {
        if (parent === "Bóng đá") child = "Quần bóng đá";
        else if (parent === "Pickleball") child = "Quần Pickleball";
        else child = "Quần thể thao";
    } else if (nameLower.includes('bộ') || nameLower.includes('set')) {
         child = "Quần áo thể thao";
         if (parent === "Bóng đá") child = "Quần áo bóng đá";
    } else if (nameLower.includes('vợt') || nameLower.includes('racket')) {
        if (parent === "Pickleball") child = "Vợt Pickleball";
        else if (parent === "Cầu lông") child = "Vợt cầu lông";
        else if (parent === "Bóng bàn") child = "Vợt bóng bàn";
        else child = "Vợt thể thao";
    } else if (nameLower.includes('balo') || nameLower.includes('túi') || nameLower.includes('bag')) {
        if (nameLower.includes('giày') || nameLower.includes('túi đựng')) child = "Túi đựng giày";
        else child = "Balo - Túi thể thao";
    } else if (nameLower.includes('quả bóng') || nameLower.includes('bóng thi đấu') || (nameLower.includes('bóng') && !nameLower.includes('bóng đá') && !nameLower.includes('bóng bàn') && !nameLower.includes('bóng chuyền') && !nameLower.includes('bóng rổ') && catsLower.includes('bóng'))) {
        if (parent === "Bóng đá") child = "Quả bóng đá";
        else if (parent === "Pickleball") child = "Bóng Pickleball";
        else if (parent === "Bóng chuyền") child = "Quả bóng chuyền";
        else child = "Quả bóng thể thao";
    } else if (nameLower.includes('sa bàn')) {
        child = "Sa bàn chiến thuật";
    } else if (nameLower.includes('tất') || nameLower.includes('vớ') || nameLower.includes('sock')) {
        child = "Tất/Vớ thể thao";
    } else {
        if (parent === "Phụ kiện") child = "Phụ kiện thể thao";
        else if (parent === "Bóng đá") child = "Phụ kiện bóng đá";
        else child = "Trang phục - Phụ kiện";
    }

    return [brand, parent, child];
}

let modifiedCount = 0;

files.forEach(filepath => {
    if (!fs.existsSync(filepath)) {
        console.log(`Lỗi: Không tìm thấy file ${filepath}`);
        return;
    }
    
    let brandName = "Wika";
    const filename = filepath.toLowerCase();
    if (filename.includes('nike')) brandName = "Nike";
    else if (filename.includes('kamito')) brandName = "Kamito";
    else if (filename.includes('kaiwin')) brandName = "Kaiwin";
    else if (filename.includes('wika')) brandName = "Wika";

    let data;
    try {
        data = JSON.parse(fs.readFileSync(filepath, 'utf8'));
    } catch(err) {
        console.log(`Lỗi đọc file ${filepath}:`, err);
        return;
    }
    
    let updatedCount = 0;
    
    if (data.products) {
        data.products.forEach(prod => {
            const currentCats = prod.categories || [];
            prod.categories = mapCategories(brandName, prod.name || "", currentCats);
            updatedCount++;
            modifiedCount++;
        });
    }
    
    fs.writeFileSync(filepath, JSON.stringify(data, null, 2), 'utf8');
    console.log(`✅ Đã cập nhật ${updatedCount} sản phẩm trong file ${filepath}`);
});

console.log(`\n🎉 Xong! Đã chuẩn hóa categories cho ${modifiedCount} sản phẩm thành công.`);
