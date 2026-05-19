from flask import Flask, request, jsonify
from flask_cors import CORS
from langchain_ollama import ChatOllama, OllamaEmbeddings
from langchain_community.vectorstores import Chroma
from langchain_classic.chains import RetrievalQA
from langchain_core.prompts import PromptTemplate
import os

app = Flask(__name__)
CORS(app)

# 1. Cấu hình đường dẫn storage (Đảm bảo khớp với ingest.py)
current_dir = os.path.dirname(os.path.abspath(__file__))
storage_path = os.path.join(os.path.dirname(current_dir), 'storage')

# 2. Khởi tạo bộ não AI
embeddings = OllamaEmbeddings(model="gemma2:2b")
vectorstore = Chroma(persist_directory=storage_path, embedding_function=embeddings)
llm = ChatOllama(model="gemma2:2b", temperature=0) # temperature=0 để trả lời chính xác dữ liệu gốc

# 3. Định nghĩa Prompt Template (Sửa theo các trường trong ingest.py)
template = """Bạn là trợ lý ảo chuyên nghiệp của EduPress. 
Nhiệm vụ của bạn là cung cấp thông tin khóa học dựa trên dữ liệu từ hệ thống.

Dựa vào ngữ cảnh (Context) dưới đây, hãy trả lời câu hỏi. 
Nếu câu hỏi yêu cầu liệt kê, hãy trình bày rõ ràng các ý: Tên khóa học, Thể loại và Mục đích (Lợi ích).

Ngữ cảnh: {context}

Câu hỏi: {question}

Trả lời (Tiếng Việt, ngắn gọn):"""

QA_CHAIN_PROMPT = PromptTemplate(
    input_variables=["context", "question"],
    template=template,
)

# 4. Khởi tạo chuỗi truy vấn (Tăng k=10 để AI thấy nhiều khóa học hơn)
bot = RetrievalQA.from_chain_type(
    llm=llm,
    chain_type="stuff",
    retriever=vectorstore.as_retriever(search_kwargs={"k": 10}),
    chain_type_kwargs={"prompt": QA_CHAIN_PROMPT}
)

@app.route('/chat', methods=['POST'])
def chat():
    user_message = request.json.get('message')
    if not user_message:
        return jsonify({"error": "No message"}), 400
    
    try:
        # AI xử lý câu hỏi dựa trên kiến thức đã nạp từ ingest.py
        response = bot.invoke({"query": user_message})
        return jsonify({"answer": response["result"]})
    except Exception as e:
        return jsonify({"answer": f"Lỗi hệ thống: {str(e)}"}), 500

if __name__ == '__main__':
    app.run(port=5001, debug=True)