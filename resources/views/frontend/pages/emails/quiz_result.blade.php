@if($result->status == 'fail')
    <h3>Rất tiếc! Bạn không vượt qua bài kiểm tra</h3>
    <p>Kết quả: {{ $result->percentage }}% (Yêu cầu: {{ $result->quiz->pass_score }}%)</p>
    <p>Đừng nản chí, bạn hãy ôn tập lại kiến thức và thực hiện lại bài test nhé.</p>
    <a href="{{ url('/course/details/'.$result->quiz->course_id) }}">Quay lại học tiếp</a>

@elseif(isset($result->is_final_completion) && $result->is_final_completion)
    <h3>CHÚC MỪNG! BẠN ĐÃ HOÀN THÀNH XUẤT SẮC KHÓA HỌC</h3>
    <p>Bạn đã vượt qua tất cả các bài kiểm tra của khóa học: <strong>{{ $result->quiz->course->course_title }}</strong></p>
    <p>Chứng chỉ của bạn đã được hệ thống ghi nhận. (Đính kèm bên dưới)</p>
    <p>Giảng viên: {{ $result->quiz->course->instructor->name }}</p>

@else
    <h3>Chúc mừng! Bạn đã vượt qua bài kiểm tra</h3>
    <p>Bạn đạt được {{ $result->percentage }}%. Hãy tiếp tục hoàn thành các bài học tiếp theo nhé!</p>
@endif