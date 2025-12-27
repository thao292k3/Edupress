@extends('frontend.master')

@section('content')
<div class="container py-4">
    <h3>Kết quả bài kiểm tra - {{ $course->title ?? '' }}</h3>
    <p>Điểm: <strong>{{ $submission->score }}%</strong></p>
    @if($submission->passed)
        <p class="text-success">Bạn đã vượt qua. Kiểm tra email để nhận chứng nhận.</p>
    @else
        <p class="text-danger">Bạn chưa đạt. Vui lòng liên hệ giảng viên hoặc làm lại bài kiểm tra.</p>
    @endif
    <a href="{{ route('frontend.home') }}" class="btn btn-link mt-3">Quay lại</a>
</div>
@endsection
