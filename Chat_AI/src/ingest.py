import mysql.connector
import os
import shutil
import re
from langchain_ollama import OllamaEmbeddings
from langchain_community.vectorstores import Chroma
from langchain_core.documents import Document

def ingest_data():
    # 1. Cấu hình đường dẫn storage (Não bộ AI)
    current_dir = os.path.dirname(os.path.abspath(__file__))
    storage_path = os.path.join(os.path.dirname(current_dir), "storage")

    try:
        # 2. Kết nối MySQL
        print("--- Dang ket noi MySQL Database ---")
        conn = mysql.connector.connect(
            host="127.0.0.1",
            user="root",
            password="",      
            database="edupress"
        )
        # dictionary=True giúp truy xuất dữ liệu dạng row['column_name']
        cursor = conn.cursor(dictionary=True)
        print(" Ket noi MySQL thanh cong!")

        # 3. Truy vấn dữ liệu JOIN
        query = """
            SELECT c.*, cat.name as cat_name 
            FROM courses c
            LEFT JOIN categories cat ON c.category_id = cat.id
            WHERE c.status = 1
        """
        cursor.execute(query)
        rows = cursor.fetchall()
        
        if not rows:
            print(" Khong tim thay khoa hoc nao co status = 1.")
            return

        documents = []
        for row in rows:
            # Xử lý giá tiền (MySQL Decimal chuyển về Float)
            selling_price = float(row['selling_price']) if row['selling_price'] else 0
            price_info = "Miễn phí" if row['is_free'] == 1 else f"{selling_price:,.0f} VNĐ"
            
            # Gom thông tin vào hồ sơ
            full_content = f"""
            TÊN KHÓA HỌC: {row['course_name']}
            - Danh mục: {row['cat_name'] if row['cat_name'] else 'Chưa phân loại'}
            - Trình độ: {row['course_level']}
            - Tiêu đề: {row['course_title']}
            - Giá: {price_info}
            - Lợi ích: {row['course_benefits']}
            - Mô tả chi tiết: {row['description']}
            """

            # Làm sạch mã HTML và khoảng trắng thừa
            clean_text = re.sub('<[^<]+?>', '', full_content)
            clean_text = " ".join(clean_text.split())

            doc = Document(
                page_content=clean_text,
                metadata={"id": row['id'], "category": row['cat_name']}
            )
            documents.append(doc)

        conn.close()

        # 4. Nạp vào Vector Database (Chroma)
        print(f"--- Đang nap {len(documents)} khoa hoc vao nao bo AI ---")
        
        if os.path.exists(storage_path):
            try:
                shutil.rmtree(storage_path)
            except PermissionError:
                print(" Thu muc storage dang ban, se cap nhat de du lieu.")

        embeddings = OllamaEmbeddings(model="gemma2:2b") 
        Chroma.from_documents(
            documents=documents, 
            embedding=embeddings, 
            persist_directory=storage_path
        )
        
        print(" HOAN TAT: AI da hoc xong du lieu tu MySQL!")

    except mysql.connector.Error as err:
        print(f" Lỗi kết nối MySQL: {err}")
    except Exception as e:
        print(f" Loi he thong: {e}")

if __name__ == "__main__":
    ingest_data()