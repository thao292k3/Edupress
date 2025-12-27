<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role === 'instructor';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'course_id' => 'required|exists:courses,id', 
            'section_id' => 'required|integer|exists:sections,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            
            // Cấu hình Quiz
            'total_marks' => 'nullable|integer|min:0', 
            'pass_score' => 'required|integer|min:0|max:100', // Điểm đậu (tính theo %)
            'duration_minutes' => 'nullable|integer|min:1',
            'show_result_immediately' => 'boolean',
            
            'status' => 'required|in:0,1', // 0=Draft, 1=Active
        ];
    }

    public function messages(): array
{
    return [
        'section_id.required' => 'Không tìm thấy thông tin chương học (Section ID).',
        'section_id.exists'   => 'Chương học không tồn tại trong hệ thống.',
    ];
}
}
