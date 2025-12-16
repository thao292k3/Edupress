<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       $quiz = $this->route('quiz'); 
        
        
        return $quiz && $quiz->course->instructor_id === Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'question_text' => 'required|string',
            'type' => 'required|in:multiple_choice,single_choice,text',
            'marks' => 'required|integer|min:1',
            
            // Rules cho các loại câu hỏi có đáp án
            'answers' => 'required_if:type,multiple_choice,single_choice|array',
            'answers.*.id' => 'nullable|exists:answers,id', // Đáp án cũ (chỉ dùng cho Update)
            'answers.*.text' => 'required_with:answers|string',
            
            // Nếu là single_choice/multiple_choice, phải có correct_answers
            'correct_answers' => 'required_if:type,multiple_choice,single_choice|array', 
            // Lưu ý: Validation này không kiểm tra giá trị của 'correct_answers' là index hay ID, 
            // việc đó cần được xử lý trong Controller/Service.

            // Rules cho câu hỏi tự luận/điền khuyết
            'correct_answer_text' => 'nullable|string', 

            // Rules cho việc xóa đáp án (chỉ dùng cho Update)
            'answers_to_delete' => 'nullable|array', 
            'answers_to_delete.*' => 'integer|exists:answers,id',
        ];
    }

    public function messages()
    {
        return [
            'question_text.required' => 'Nội dung câu hỏi không được để trống.',
            'type.required' => 'Vui lòng chọn loại câu hỏi.',
            'marks.min' => 'Điểm phải lớn hơn hoặc bằng 1.',
            'answers.required_if' => 'Câu hỏi trắc nghiệm phải có ít nhất một đáp án.',
            'answers.*.text.required_with' => 'Nội dung đáp án không được để trống.',
            'correct_answers.required_if' => 'Vui lòng chọn đáp án đúng.',
        ];
    }
}
