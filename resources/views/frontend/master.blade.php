<!DOCTYPE html>
<html lang="en">

<head>

    <title>Edupress</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('frontend/images/Logoo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @auth
        <script>
            window.__IS_AUTH__ = true;
        </script>
    @else
        <script>
            window.__IS_AUTH__ = false;
        </script>
    @endauth

    <!-- inject:css -->

    @include('frontend.section.link')

    <!-- end inject -->

    <style>
        .hero-slider:not(.owl-loaded) .hero-slider-item:not(:first-child) {
            display: none;
            /* Chỉ hiện ảnh đầu tiên, ẩn các ảnh còn lại khi Owl chưa load xong */
        }

        .hero-slider:not(.owl-loaded) {
            height: 500px;
            /* Khóa chiều cao cố định để tránh layout bị nhảy */
            overflow: hidden;
        }
    </style>

</head>

<body>

    <!-- start cssload-loader -->


    <!--START HEADER AREA-->
    @include('frontend.section.header')

    @yield('content')


    <!--START COURSE First AREA-->



    <!--START COURSE AREA-->



    <!--START FUNFACT AREA -->



    <!--START CTA AREA-->

    <!--START TESTIMONIAL AREA-->


    <div class="section-block"></div>

    <!--START ABOUT AREA-->



    <div class="section-block"></div>

    <!--START REGISTER AREA-->


    <div class="section-block"></div>

    <!--START CLIENT-LOGO AREA -->




    <!--START BLOG AREA -->




    <!----START GET STARTED AREA---->



    <!---subscribe-area------->



    <!---footer-area--->
    @include('frontend.section.footer')

   <div id="chat-ai-wrapper" style="position: fixed; bottom: 30px; right: 90px; z-index: 999999 !important;">
        <button onclick="toggleChat()"
            style="background: #4f46e5; color: white; border: none; width: 60px; height: 60px; border-radius: 50%; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; transition: transform 0.3s;">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                viewBox="0 0 16 16">
                <path
                    d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15" />
            </svg>
        </button>

        <div id="chat-container"
            style="display: none; width: 350px; height: 450px; background: white; border-radius: 15px; position: absolute; bottom: 80px; right: 0; flex-direction: column; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: 1px solid #e5e7eb; overflow: hidden;">
            <div
                style="background: #4f46e5; color: white; padding: 15px; font-weight: 600; display: flex; justify-content: space-between;">
                <span>🎓 EduPress AI Assistant</span>
                <button onclick="toggleChat()"
                    style="background:none; border:none; color:white; cursor:pointer;">✕</button>
            </div>
            <div id="chat-content"
                style="flex: 1; padding: 15px; overflow-y: auto; background: #f9fafb; display: flex; flex-direction: column; gap: 10px;">
                <div
                    style="background: #e5e7eb; padding: 8px 12px; border-radius: 12px; align-self: flex-start; max-width: 80%; font-size: 14px;">
                    Xin chào! Mình có thể giúp gì cho bạn về các khóa học hôm nay?
                </div>
            </div>
            <div style="padding: 15px; background: white; border-top: 1px solid #eee; display: flex; gap: 8px;">
                <input type="text" id="chat-input" placeholder="Nhập câu hỏi..."
                    style="flex: 1; border: 1px solid #d1d5db; border-radius: 8px; padding: 8px 12px; outline: none;">
                <button onclick="sendToAI()"
                    style="background: #4f46e5; color: white; border: none; border-radius: 8px; padding: 0 15px; cursor: pointer;">Gửi</button>
            </div>
        </div>
    </div>

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>


    <!---tooltip--->

    @include('frontend.section.tooltip')


    <!-- template js files -->
    @include('frontend.section.script')
</body>

</html>


<script>
    window.toggleChat = function() {
        const container = document.getElementById('chat-container');
        container.style.display = (container.style.display === 'none' || container.style.display === '') ? 'flex' : 'none';
    }

    async function sendToAI() {
        const input = document.getElementById('chat-input');
        const content = document.getElementById('chat-content');
        const message = input.value.trim();

        if (!message) return;

        // Hiển thị tin nhắn người dùng
        content.innerHTML +=
            `<div style="background: #4f46e5; color: white; padding: 8px 12px; border-radius: 12px; align-self: flex-end; max-width: 80%; font-size: 14px;">${message}</div>`;
        input.value = '';
        content.scrollTop = content.scrollHeight;

        try {
            // Gửi đến Python API (đảm bảo file app_api.py đang chạy)
            const response = await fetch('http://127.0.0.1:5001/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    message: message
                })
            });
            const data = await response.json();

            // Hiển thị câu trả lời từ AI
            content.innerHTML +=
                `<div style="background: #e5e7eb; padding: 8px 12px; border-radius: 12px; align-self: flex-start; max-width: 80%; font-size: 14px;">${data.answer}</div>`;
        } catch (error) {
            content.innerHTML +=
                `<div style="color: red; font-size: 12px; text-align: center;">Lỗi kết nối với máy chủ AI</div>`;
        }
        content.scrollTop = content.scrollHeight;
    }

    // Gửi bằng phím Enter
    document.getElementById('chat-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendToAI();
    });
</script>
