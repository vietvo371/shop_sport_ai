#!/bin/bash

# Thư mục gốc của dự án
ROOT_DIR="/Volumes/MAC_OPTION/DATN/KLTN_94_NGOC"

echo "🚀 Khởi động hệ thống SportStore KLTN..."

# 1. Mở tab mới chạy Backend (Laravel - Port 8000)
osascript <<EOF
tell application "Terminal"
    activate
    do script "cd '$ROOT_DIR/sportstore-be' && echo '🔥 Khởi động Backend Laravel...' && php artisan serve"
end tell
EOF
#  chạy queue
osascript <<EOF
tell application "Terminal"
    activate
    do script "cd '$ROOT_DIR/sportstore-be' && echo '🔥 Khởi động Backend Laravel...' && php artisan queue:work"
end tell
EOF

# 2. Mở tab mới chạy Frontend (NextJS - Port 3000)
osascript <<EOF
tell application "Terminal"
    activate
    do script "cd '$ROOT_DIR/sportstore-client' && echo '⚛️ Khởi động Frontend NextJS...' && yarn dev"
end tell
EOF

# 3. Mở tab mới chạy AI Service (FastAPI - Port 8001)
osascript <<EOF
tell application "Terminal"
    activate
    do script "cd '$ROOT_DIR/sportstore-ai' && echo '🤖 Khởi động AI Recommendation Engine...' && source venv/bin/activate && uvicorn app.main:app --host 0.0.0.0 --port 8001 --reload"
end tell
EOF

echo "✅ Đã mở 3 Terminal cho Backend, Frontend và AI Service!"
echo "Các port tương ứng:"
echo " - Frontend: http://localhost:3000"
echo " - Backend:  http://localhost:8000"
echo " - AI API:   http://localhost:8001"
