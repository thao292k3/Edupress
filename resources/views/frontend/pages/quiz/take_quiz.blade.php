@extends('frontend.master')
@section('content')
<style>
    /* Tổng thể khu vực thi */
    .quiz-page { background-color: #f0f4f8; min-height: 100vh; padding: 40px 0; }
    .quiz-header { background: #fff; border-radius: 12px; padding: 25px; margin-bottom: 30px; border-left: 6px solid #3b82f6; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
    
    /* Box câu hỏi */
    .question-card { background: #fff; border-radius: 12px; padding: 30px; margin-bottom: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; }
    .question-number { background: #3b82f6; color: white; padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: bold; margin-bottom: 15px; display: inline-block; }
    .question-text { font-size: 19px; font-weight: 600; color: #1f2937; line-height: 1.6; margin-bottom: 25px; }

    /* Custom Radio & Checkbox */
    .answer-option { display: block; position: relative; padding: 16px 16px 16px 52px; margin-bottom: 12px; background: #fff; border: 2px solid #f3f4f6; border-radius: 10px; cursor: pointer; transition: all 0.2s; font-size: 16px; color: #4b5563; }
    .answer-option:hover { background: #f9fafb; border-color: #d1d5db; }
    
    /* Hiệu ứng khi được chọn */
    .answer-option input:checked ~ .option-content { font-weight: 600; color: #2563eb; }
    .answer-option input:checked { border-color: #2563eb; background-color: #eff6ff; }
    .answer-option input { position: absolute; opacity: 0; }

    .custom-mark { position: absolute; top: 18px; left: 18px; height: 20px; width: 20px; background-color: #fff; border: 2px solid #d1d5db; border-radius: 50%; }
    .answer-option input:checked ~ .custom-mark { background-color: #2563eb; border-color: #2563eb; }
    .custom-mark:after { content: ""; position: absolute; display: none; left: 6px; top: 2px; width: 5px; height: 10px; border: solid white; border-width: 0 2px 2px 0; transform: rotate(45deg); }
    .answer-option input:checked ~ .custom-mark:after { display: block; }

    /* Thanh thời gian */
    .sticky-timer { position: sticky; top: 20px; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-top: 4px solid #ef4444; }
    #timer-clock { font-size: 32px; font-weight: 800; color: #ef4444; text-align: center; font-family: 'Courier New', Courier, monospace; }
</style>

<div class="quiz-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="quiz-header">
                    <h2 class="fw-bold">{{ $quiz->title }}</h2>
                    <p class="text-muted mb-0"><i class="la la-file-alt"></i> {{ $quiz->questions->count() }} câu hỏi | <i class="la la-clock"></i> {{ $quiz->duration_minutes }} phút</p>
                </div>

                <form action="{{ route('quiz.submit', $quiz->id) }}" method="POST" id="mainQuizForm">
                    @csrf
                    @foreach ($quiz->questions as $index => $question)
                        <div class="question-card">
                            <span class="question-number">Câu {{ $index + 1 }}</span>
                            <div class="question-text">{{ $question->question_text }}</div>

                            <div class="options-container">
                                @foreach ($question->answers as $answer)
                                    <label class="answer-option" id="label-{{ $answer->id }}">
                                        <input type="{{ $question->type == 'multiple_choice' ? 'checkbox' : 'radio' }}" 
                                               name="answers[{{ $question->id }}]{{ $question->type == 'multiple_choice' ? '[]' : '' }}" 
                                               value="{{ $answer->id }}"
                                               onchange="highlightOption(this, 'label-{{ $answer->id }}')">
                                        <span class="custom-mark"></span>
                                        <span class="option-content">{{ $answer->answer_text }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4 mb-5">
                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-lg fw-bold py-3 rounded-3">NỘP BÀI THI NGAY</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-4">
                <div class="sticky-timer">
                    <h5 class="text-center text-muted small fw-bold mb-2">THỜI GIAN CÒN LẠI</h5>
                    <div id="timer-clock">00:00</div>
                    <hr>
                    <div class="small text-muted">
                        <li>Vui lòng không tải lại trang.</li>
                        <li>Hệ thống tự nộp khi hết giờ.</li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    let totalSeconds = {{ ($quiz->duration_minutes ?? 0) * 60 }};
    const display = document.querySelector('#timer-clock');
    
    const timer = setInterval(() => {
        let mins = Math.floor(totalSeconds / 60);
        let secs = totalSeconds % 60;
        display.innerHTML = `${mins < 10 ? '0' : ''}${mins}:${secs < 10 ? '0' : ''}${secs}`;
        
        if (totalSeconds <= 0) {
            clearInterval(timer);
            document.getElementById('mainQuizForm').submit();
        }
        totalSeconds--;
    }, 1000);

   
    function highlightOption(input, labelId) {
        const label = document.getElementById(labelId);
        const container = label.closest('.options-container');
        
        if (input.type === 'radio') {
            container.querySelectorAll('.answer-option').forEach(el => el.style.borderColor = '#f3f4f6');
            container.querySelectorAll('.answer-option').forEach(el => el.style.backgroundColor = '#fff');
        }
        
        if (input.checked) {
            label.style.borderColor = '#2563eb';
            label.style.backgroundColor = '#eff6ff';
        } else {
            label.style.borderColor = '#f3f4f6';
            label.style.backgroundColor = '#fff';
        }
    }
</script>
@endsection