<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LiveSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!Auth::check() || Auth::user()->role !== 'instructor') {
            return false;
        }

        $courseId = $this->input('course_id') ?? ($this->route('live_session') ? $this->route('live_session')->course_id : null);
        
        if ($courseId) {
            $course = Course::find($courseId);
            return $course && $course->instructor_id === Auth::id();
        }
        
        return true;
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
            'topic' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform' => 'required|string|max:50',
            'meeting_link' => 'required|url|max:500', 
            
            'start_at' => 'required|date_format:Y-m-d\TH:i|after_or_equal:now',
            'duration_minutes' => 'required|integer|min:5|max:300',
        ];
    }

    public function messages(): array
    {
       
        return [
            'start_at.after_or_equal' => 'Thời gian bắt đầu phải lớn hơn hoặc bằng thời gian hiện tại.',
            'meeting_link.url' => 'Đường dẫn buổi họp phải là URL hợp lệ.'
        ];
    }
}
