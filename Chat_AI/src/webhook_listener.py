from flask import Flask, request, jsonify
import subprocess
import os
import sys

app = Flask(__name__)

# Xác định đường dẫn tuyệt đối đến dự án
BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
INGEST_SCRIPT = os.path.join(BASE_DIR, "src", "ingest.py")
# Đường dẫn đến Python của môi trường ảo (để đảm bảo chạy đúng thư viện)
PYTHON_EXE = os.path.join(BASE_DIR, "venv", "Scripts", "python.exe")

@app.route('/webhook/update-courses', methods=['POST'])
def update_ai():
    print("🔔 Nhận được tín hiệu cập nhật từ Website...")
    
    try:
        # Chạy file ingest.py bằng Python của venv
        # Chúng ta dùng subprocess để chạy độc lập
        process = subprocess.Popen(
            [PYTHON_EXE, INGEST_SCRIPT],
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE,
            text=True,
            encoding='utf-8' 
        )
        
        # Bạn có thể chọn đợi hoặc chạy ngầm. 
        # Ở đây ta đợi để báo kết quả về cho Website
        stdout, stderr = process.communicate()

        if process.returncode == 0:
            print("✅ AI đã cập nhật dữ liệu thành công!")
            return jsonify({
                "status": "success", 
                "message": "AI updated successfully",
                "output": stdout
            }), 200
        else:
            print(f"❌ Lỗi khi chạy ingest: {stderr}")
            return jsonify({
                "status": "error", 
                "message": stderr
            }), 500
            
    except Exception as e:
        print(f"❌ Lỗi hệ thống: {str(e)}")
        return jsonify({"status": "error", "message": str(e)}), 500

if __name__ == '__main__':
    print("🚀 Webhook Server đang chạy tại http://localhost:5000")
    print("📡 Đang chờ tín hiệu từ Website (POST /webhook/update-courses)...")
    app.run(host='0.0.0.0', port=5000, debug=False)