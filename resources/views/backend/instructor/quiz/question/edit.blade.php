@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Chỉnh sửa Câu hỏi #{{ $question->id }} (Quiz: {{ $quiz->title }})</h4>
            <a href="{{ route('instructor.quizzes.show', $quiz->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại chi tiết Quiz
            </a>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('instructor.quizzes.questions.update', [$quiz->id, $question->id]) }}" method="POST" id="questionForm">
                @csrf
                @method('PUT')

                {{-- 1. Tiêu đề Câu hỏi --}}
                <div class="mb-3">
                    <label for="question_text" class="form-label">Nội dung Câu hỏi <span class="text-danger">*</span></label>
                    <textarea name="question_text" id="question_text" class="form-control" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
                </div>

                <div class="row">
                    {{-- 2. Loại Câu hỏi --}}
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Loại Câu hỏi <span class="text-danger">*</span></label>
                        <select name="type" id="question_type" class="form-select" required>
                            <option value="single_choice" {{ old('type', $question->type) == 'single_choice' ? 'selected' : '' }}>Trắc nghiệm (1 đáp án)</option>
                            <option value="multiple_choice" {{ old('type', $question->type) == 'multiple_choice' ? 'selected' : '' }}>Trắc nghiệm (Nhiều đáp án)</option>
                            <option value="text" {{ old('type', $question->type) == 'text' ? 'selected' : '' }}>Tự luận/Điền khuyết (Text)</option>
                        </select>
                    </div>

                    {{-- 3. Điểm --}}
                    <div class="col-md-6 mb-3">
                        <label for="marks" class="form-label">Điểm <span class="text-danger">*</span></label>
                        <input type="number" name="marks" id="marks" class="form-control" min="1" required value="{{ old('marks', $question->marks) }}">
                    </div>
                </div>

                <hr>

                {{-- 4. PHẦN TẠO/SỬA ĐÁP ÁN (SẼ ĐƯỢC ĐIỀN BẰNG JS) --}}
                <h5 class="mb-3">Cấu hình Đáp án</h5>
                <div id="answer_configuration">
                    {{-- Nội dung sẽ được render bởi JavaScript dựa trên $question->type và dữ liệu $answers --}}

                    @if (in_array($question->type, ['single_choice', 'multiple_choice']))
                        {{-- Hiển thị form cho Trắc nghiệm --}}
                        <div id="answers_list" class="mb-3">
                            @foreach ($answers as $index => $answer)
                                <div class="input-group mb-2 answer-row" data-answer-id="{{ $answer->id }}">
                                    
                                    {{-- Hidden input cho ID Đáp án --}}
                                    <input type="hidden" name="answers[{{ $index }}][id]" value="{{ $answer->id }}">

                                    {{-- Checkbox/Radio cho Đáp án Đúng --}}
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0 correct-answer-input" 
                                               type="{{ $question->type == 'single_choice' ? 'radio' : 'checkbox' }}" 
                                               name="correct_answers[]" 
                                               value="{{ $index }}" 
                                               {{ $answer->is_correct ? 'checked' : '' }}>
                                    </div>
                                    
                                    {{-- Input text cho Đáp án --}}
                                    <input type="text" name="answers[{{ $index }}][text]" 
                                           class="form-control answer-text-input" 
                                           placeholder="Nội dung đáp án" 
                                           value="{{ old("answers.$index.text", $answer->answer_text) }}"
                                           required>
                                    
                                    {{-- Nút xóa Đáp án (chỉ khi có nhiều hơn 1) --}}
                                    <button class="btn btn-outline-danger remove-answer-btn" type="button" 
                                            data-answer-id="{{ $answer->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        
                        <button type="button" class="btn btn-sm btn-outline-success mb-3" id="add_answer_btn">
                            <i class="fas fa-plus"></i> Thêm Đáp án
                        </button>
                        
                        {{-- Hidden input để theo dõi các đáp án bị xóa --}}
                        <input type="hidden" name="answers_to_delete" id="answers_to_delete" value="">

                    @elseif ($question->type == 'text')
                        {{-- Hiển thị form cho Tự luận/Điền khuyết --}}
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Với câu hỏi Tự luận, bạn chỉ cần cung cấp câu trả lời tham khảo. Việc chấm điểm sẽ do giáo viên thực hiện.
                        </div>
                         <div class="mb-3">
                            <label for="correct_answer_text" class="form-label">Câu trả lời mẫu</label>
                            <textarea name="correct_answer_text" id="correct_answer_text" class="form-control" rows="3">{{ old('correct_answer_text', $question->correct_answer_text) }}</textarea>
                        </div>
                    @endif
                    
                </div>
                
                <button type="submit" class="btn btn-success mt-4">
                    <i class="fas fa-save"></i> Lưu Câu hỏi
                </button>
            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const questionTypeSelect = document.getElementById('question_type');
        const answerConfigDiv = document.getElementById('answer_configuration');
        const form = document.getElementById('questionForm');
        let answersToDelete = [];
        let answerIndex = {{ count($answers) > 0 ? count($answers) : 0 }}; // Bắt đầu index từ số lượng đáp án hiện tại

        function renderAnswers(type) {
            let html = '';
            
            if (type === 'text') {
                html = `
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Với câu hỏi Tự luận, bạn chỉ cần cung cấp câu trả lời tham khảo. Việc chấm điểm sẽ do giáo viên thực hiện.
                    </div>
                    <div class="mb-3">
                        <label for="correct_answer_text" class="form-label">Câu trả lời mẫu</label>
                        <textarea name="correct_answer_text" id="correct_answer_text" class="form-control" rows="3">{{ old('correct_answer_text', $question->correct_answer_text) }}</textarea>
                    </div>
                `;
            } else {
                // Rendering cho Trắc nghiệm
                html = `<div id="answers_list" class="mb-3"></div>
                        <button type="button" class="btn btn-sm btn-outline-success mb-3" id="add_answer_btn">
                            <i class="fas fa-plus"></i> Thêm Đáp án
                        </button>
                        <input type="hidden" name="answers_to_delete" id="answers_to_delete_hidden" value="">`;
            }
            
            answerConfigDiv.innerHTML = html;
            
            if (type !== 'text') {
                // Tải lại các đáp án cũ nếu có
                const answersData = @json($answers);
                answersData.forEach((answer, index) => {
                    addAnswerRow(type, answer.answer_text, answer.is_correct, answer.id);
                });
                
                // Thêm sự kiện cho nút thêm mới
                document.getElementById('add_answer_btn').addEventListener('click', () => addAnswerRow(questionTypeSelect.value));
            }
        }

        function addAnswerRow(type, text = '', isCorrect = false, id = null) {
            const list = document.getElementById('answers_list');
            const radioOrCheckbox = type === 'single_choice' ? 'radio' : 'checkbox';
            const inputName = radioOrCheckbox === 'radio' ? 'correct_answers[]' : 'correct_answers[]';
            
            const newIndex = id !== null ? answerIndex++ : answerIndex++; // Dùng index mới cho đáp án mới

            const newRow = document.createElement('div');
            newRow.className = 'input-group mb-2 answer-row';
            newRow.setAttribute('data-answer-id', id);

            newRow.innerHTML = `
                <input type="hidden" name="answers[${newIndex}][id]" value="${id || ''}">
                <div class="input-group-text">
                    <input class="form-check-input mt-0 correct-answer-input" 
                           type="${radioOrCheckbox}" 
                           name="${inputName}" 
                           value="${newIndex}" 
                           ${isCorrect ? 'checked' : ''}>
                </div>
                <input type="text" name="answers[${newIndex}][text]" 
                       class="form-control answer-text-input" 
                       placeholder="Nội dung đáp án" 
                       value="${text}" required>
                <button class="btn btn-outline-danger remove-answer-btn" type="button" data-answer-id="${id}">
                    <i class="fas fa-times"></i>
                </button>
            `;

            list.appendChild(newRow);
            updateRadioCheckboxNames(); // Cập nhật tên input cho Single Choice
        }

        // Đảm bảo chỉ 1 radio button được check
        function updateRadioCheckboxNames() {
            const type = questionTypeSelect.value;
            const radioInputs = document.querySelectorAll('#answers_list .correct-answer-input[type="radio"]');

            if (type === 'single_choice') {
                radioInputs.forEach(input => {
                    input.setAttribute('name', 'correct_answers[]'); // Laravel sẽ chỉ nhận 1 giá trị
                });
            } else {
                 // Nếu chuyển sang checkbox, không cần thay đổi tên
            }
        }
        
        // Xử lý sự kiện thay đổi loại câu hỏi
        questionTypeSelect.addEventListener('change', function() {
            // Tải lại toàn bộ form đáp án nếu loại câu hỏi thay đổi
            renderAnswers(this.value);
        });

        // Xử lý Xóa đáp án (sử dụng Event Delegation)
        answerConfigDiv.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.remove-answer-btn');
            if (removeBtn) {
                const answerRow = removeBtn.closest('.answer-row');
                const answerId = removeBtn.getAttribute('data-answer-id');
                
                // Chỉ xóa nếu có nhiều hơn 1 đáp án
                if (document.querySelectorAll('.answer-row').length > 1 || answerId !== 'null') {
                    if (answerId && answerId !== 'null') {
                        answersToDelete.push(answerId);
                        document.getElementById('answers_to_delete_hidden').value = JSON.stringify(answersToDelete);
                    }
                    answerRow.remove();
                } else {
                    alert('Phải có ít nhất một đáp án.');
                }
            }
        });

        // Khởi tạo nút thêm đáp án khi DOM đã sẵn sàng
        document.getElementById('add_answer_btn').addEventListener('click', () => addAnswerRow(questionTypeSelect.value));

    });
</script>
@endpush