import sqlite3
import os

def create_db():
    db_path = "data/courses.db"
    if os.path.exists(db_path):
        os.remove(db_path)
        
    conn = sqlite3.connect(db_path)
    cursor = conn.cursor()
    
    cursor.execute('''
    CREATE TABLE IF NOT EXISTS courses (
        name TEXT,
        title TEXT,
        price TEXT
    )
    ''')
    
    # Dữ liệu thật từ bạn
    courses = [
        ('Lập trình Web', 'Tự học lập trình web chỉ 5 phút mỗi ngày', 'Miễn phí'),
        ('Làm phim hoạt hình 3D', 'Làm phim hoạt hình 3D với iClone', '1.100.000 VND'),
        ('Lập trình Android từ A - Z', 'Hướng dẫn cài đặt và sử dụng Android Studio', '900.000 VND'),
        ('Social Media Marketing', 'Social Media Marketing Tutorial For Beginners', 'Đang cập nhật'),
        ('Giảm cân đón tết', 'Mỗi ngày 5 phát để có body vạn người mê', '700.000 VND'),
        ('KHÓA HỌC EDIT VIDEO CAPCUT', 'Giới thiệu khóa học edit video', '500.000 VND')
    ]
    
    cursor.executemany('INSERT INTO courses (name, title, price) VALUES (?, ?, ?)', courses)
    conn.commit()
    conn.close()
    print("✅ Đã cập nhật Database với 6 khóa học thật!")

create_db()