@extends('frontend.master')

@section('content')
<div class="container py-4">
    <h3>Bài kiểm tra cho khóa: {{ $course->title ?? '—' }}</h3>
    <form method="post" action="{{ route('course.test.submit', $course->id) }}">
        @csrf
        @for($i=1;$i<=5;$i++)
            <div class="form-group">
                <label>{{ $i }}. Câu hỏi mẫu</label>
                <div>
                    <label><input type="radio" name="answers[q{{ $i }}]" value="a"> A</label>
                    <label class="ml-3"><input type="radio" name="answers[q{{ $i }}]" value="b"> B</label>
                    <label class="ml-3"><input type="radio" name="answers[q{{ $i }}]" value="c"> C</label>
                </div>
            </div>
        @endfor
        <button class="btn btn-primary">Nộp bài</button>
    </form>
</div>
@endsection
