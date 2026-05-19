<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .header { background-color: #4A90E2; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px; }
        .footer { background-color: #f9f9f9; padding: 15px; text-align: center; font-size: 12px; color: #777; }
        .button { background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>CHÚC MỪNG HOÀN THÀNH KHÓA HỌC!</h2>
        </div>
        <div class="content">
            <p>Chào <strong>{{ $user->name }}</strong>,</p>
            <p>Chúng tôi rất vui mừng thông báo rằng bạn đã hoàn thành xuất sắc khóa học: <br>
               <span style="font-size: 18px; color: #4A90E2;"><strong>{{ $course->course_name }}</strong></span>
            </p>

            @if($is_free)
                <p>Cảm ơn bạn đã tin tưởng và đồng hành cùng chúng tôi. Hy vọng những kiến thức từ khóa học miễn phí này sẽ là bệ phóng cho sự nghiệp của bạn.</p>
                <p>Đừng quên tham khảo thêm các khóa học chuyên sâu khác của chúng tôi nhé!</p>
            @else
                <p>Bạn đã nỗ lực rất nhiều để đạt được kết quả này. Chúng tôi đã đính kèm <strong>Chứng chỉ hoàn thành</strong> trong email này để ghi nhận thành quả của bạn.</p>
                <p>Bạn có thể tải xuống và chia sẻ nó lên LinkedIn hoặc CV của mình.</p>
            @endif

            <a href="{{ url('/') }}" class="button">Quay lại trang học tập</a>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>Email này được gửi tự động, vui lòng không phản hồi.</p>
        </div>
    </div>
</body>
</html>