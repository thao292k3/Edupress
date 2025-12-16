@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Thêm Câu hỏi mới cho Quiz: **{{ $quiz->title }}**</h4>
            
            <a href="{{ route('instructor.quizzes.show', $quiz->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại Quiz
            </a>
        </div>

        <div class="card-body">

            <form id="questionForm" action="{{ route('instructor.quizzes.questions.store', $quiz->id) }}" method="POST">
                @csrf
                
               
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nội dung Câu hỏi <span class="text-danger">*</span></label>
                    <textarea name="question_text" rows="4" class="form-control @error('question_text') is-invalid @enderror" 
                              required placeholder="Nhập nội dung câu hỏi tại đây...">{{ old('question_text') }}</textarea>
                    @error('question_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Chọn Loại Câu hỏi <span class="text-danger">*</span></label>
                        <select id="questionType" name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">-- Chọn loại --</option>
                            <option value="single_choice" {{ old('type') == 'single_choice' ? 'selected' : '' }}>Trắc nghiệm (1 đáp án đúng)</option>
                            <option value="multiple_choice" {{ old('type') == 'multiple_choice' ? 'selected' : '' }}>Trắc nghiệm (Nhiều đáp án đúng)</option>
                            <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Tự luận/Trả lời ngắn</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Điểm cho Câu hỏi <span class="text-danger">*</span></label>
                        <input type="number" name="marks" class="form-control @error('marks') is-invalid @enderror" 
                               min="1" value="{{ old('marks', 1) }}" required>
                        @error('marks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>

                
                <div id="answersArea">
                    
                    <p class="text-info text-center">Vui lòng chọn loại câu hỏi để bắt đầu thêm đáp án.</p>
                </div>
                
                <hr>

                <button type="submit" class="btn btn-success mt-3"><i class="fas fa-save"></i> Lưu Câu hỏi</button>
            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const questionTypeSelect = document.getElementById('questionType');
        const answersArea = document.getElementById('answersArea');

        
        let answerIndex = 0; 
        
        
        questionTypeSelect.addEventListener('change', function() {
            const type = this.value;
            answersArea.innerHTML = '';
            answerIndex = 0; 

            if (type === 'single_choice' || type === 'multiple_choice') {
                renderChoiceForm(type);
            } else if (type === 'text') {
                renderTextForm();
            }
        });

        
        function renderTextForm() {
            answersArea.innerHTML = `
                <h5 class="fw-bold">Đáp án Mẫu (Chỉ dành cho Instructor)</h5>
                <p class="text-muted">Đây là câu trả lời/đáp án mẫu để bạn tham khảo khi chấm bài thủ công.</p>
                <div class="mb-3">
                    <textarea name="correct_answer_text" rows="5" class="form-control" 
                              placeholder="Nhập câu trả lời mẫu/dự kiến cho câu hỏi tự luận.">{{ old('correct_answer_text') }}</textarea>
                    @error('correct_answer_text')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="answers" value="[]">
                <input type="hidden" name="correct_answers" value="[]">
            `;
        }

        
        function renderChoiceForm(type) {
            const isMultiple = type === 'multiple_choice';
            const inputType = isMultiple ? 'checkbox' : 'radio';
            
           
            answersArea.innerHTML = `
                <h5 class="fw-bold">Quản lý Đáp án (Trắc nghiệm)</h5>
                <p class="text-muted">Chọn loại input là **${isMultiple ? 'Checkbox (Nhiều đáp án)' : 'Radio (Một đáp án)'}**</p>
                <div id="choiceAnswersContainer" class="mb-3 border p-3 rounded bg-light">
                    </div>
                <button type="button" class="btn btn-info btn-sm text-white" id="addAnswerBtn">
                    <i class="fas fa-plus-circle"></i> Thêm Đáp án
                </button>
                <small class="d-block text-danger mt-2">
                    @error('answers') **Vui lòng thêm ít nhất 2 đáp án.** @enderror
                    @error('correct_answers') **Vui lòng chọn ít nhất 1 đáp án đúng.** @enderror
                </small>
            `;
            
            
            document.getElementById('addAnswerBtn').addEventListener('click', addAnswerInput);

           
            addAnswerInput(); 
            addAnswerInput(); 
            
            
        }


        function addAnswerInput() {
            const container = document.getElementById('choiceAnswersContainer');
            const type = questionTypeSelect.value;
            const inputType = type === 'multiple_choice' ? 'checkbox' : 'radio';
            const nameAttr = type === 'single_choice' ? 'correct_answers[]' : 'correct_answers[]';
            const value = answerIndex; 

            const newAnswerHtml = `
                <div class="input-group mb-3 answer-item" data-index="${value}">
                    {{-- Input chọn đáp án đúng --}}
                    <div class="input-group-text p-0">
                        <label class="p-2 m-0 bg-white" title="Đánh dấu đáp án đúng">
                            <input class="form-check-input mt-0 me-2" 
                                   type="${inputType}" 
                                   name="${nameAttr}" 
                                   value="${value}"
                                   aria-label="Đáp án đúng">
                            Đúng
                        </label>
                    </div>

                    {{-- Input nội dung đáp án --}}
                    <input type="text" name="answers[${value}][text]" 
                           class="form-control @error('answers.*.text') is-invalid @enderror" 
                           placeholder="Nội dung đáp án #${value + 1}" required>

                    {{-- Nút xóa --}}
                    <button class="btn btn-outline-danger remove-answer-btn" 
                            type="button" 
                            data-index="${value}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    @error('answers.*.text')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', newAnswerHtml);
            
           
            const newAnswerElement = container.querySelector(`.answer-item[data-index="${value}"] .remove-answer-btn`);
            newAnswerElement.addEventListener('click', function() {
                this.closest('.answer-item').remove();
            });

            answerIndex++;
        }

        
        const initialType = questionTypeSelect.value;
        if (initialType) {
            questionTypeSelect.dispatchEvent(new Event('change'));
            
            
        }

    });
</script>
@endpush