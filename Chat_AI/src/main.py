import streamlit as st
import os
from langchain_ollama import ChatOllama, OllamaEmbeddings
from langchain_community.vectorstores import Chroma
from langchain_classic.chains import RetrievalQA
from langchain_core.prompts import PromptTemplate

# 1. Cấu hình đường dẫn tuyệt đối
current_dir = os.path.dirname(os.path.abspath(__file__))
root_dir = os.path.dirname(current_dir)
storage_path = os.path.join(root_dir, 'storage')

st.set_page_config(page_title="EduPress AI", page_icon="🎓")
st.title("🤖 EduPress AI Assistant")

# 2. Định nghĩa cách AI trả lời (Prompt Tiếng Việt)
template = """Bạn là trợ lý ảo thông minh của trung tâm EduPress. 
Dựa vào ngữ cảnh dưới đây, hãy trả lời câu hỏi của người dùng một cách chính xác nhất.
Nếu câu hỏi không có trong ngữ cảnh, hãy lịch sự từ chối.

Ngữ cảnh: {context}
Câu hỏi: {question}
Trả lời:"""

QA_CHAIN_PROMPT = PromptTemplate(
    input_variables=["context", "question"],
    template=template,
)

# 3. Khởi tạo AI
@st.cache_resource
def init_bot():
    # Model gemma2:2b đồng bộ với file ingest.py
    embeddings = OllamaEmbeddings(model="gemma2:2b") 
    
    # Kết nối tới Vector Database đã tạo từ ingest.py
    vectorstore = Chroma(
        persist_directory=storage_path, 
        embedding_function=embeddings
    )
    
    llm = ChatOllama(model="gemma2:2b", temperature=0)
    
    return RetrievalQA.from_chain_type(
        llm=llm,
        chain_type="stuff",
        # Tăng k=6 để AI có thể đọc được toàn bộ 6 khóa học cùng lúc
        retriever=vectorstore.as_retriever(search_kwargs={"k": 20}),
        chain_type_kwargs={"prompt": QA_CHAIN_PROMPT}
    )

# 4. Giao diện Chat
if os.path.exists(storage_path):
    try:
        bot = init_bot()
        
        if "messages" not in st.session_state:
            st.session_state.messages = []

        for message in st.session_state.messages:
            with st.chat_message(message["role"]):
                st.markdown(message["content"])

        if prompt := st.chat_input("Hỏi về khóa học (vd: Khóa học Android giá bao nhiêu?)"):
            st.session_state.messages.append({"role": "user", "content": prompt})
            with st.chat_message("user"):
                st.markdown(prompt)

            with st.chat_message("assistant"):
                with st.spinner("Đang suy nghĩ..."):
                    # Sử dụng invoke để đảm bảo chuẩn LangChain mới
                    response = bot.invoke({"query": prompt})
                    answer = response["result"]
                    st.markdown(answer)
                    st.session_state.messages.append({"role": "assistant", "content": answer})
                    
    except Exception as e:
        st.error(f"Lỗi: {e}. Vui lòng kiểm tra lại Ollama hoặc model gemma2:2b.")
else:
    st.warning("⚠️ Hệ thống chưa có dữ liệu. Hãy chạy file ingest.py trước!")