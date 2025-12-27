<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'course_id'   => 'required|exists:courses,id',
            'section_id'  => 'required|exists:sections,id',

            'lecture_title'       => 'required|string|max:255',
            'content' => 'nullable|string',

            'is_preview'  => 'boolean',

            'url'   => 'nullable|url',
            'video_file'  => 'nullable|mimes:mp4,webm,ogg|max:50000',

            'duration'    => 'nullable|numeric|min:0',

            'attachments'   => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,doc,docx,zip|max:20000',

            'links'     => 'nullable|array',
            'links.*'   => 'nullable|url|max:255',

            'lesson_file'  => 'nullable|mimes:pdf,doc,docx,zip|max:20000',
            'lesson_document_link' => 'nullable|string|max:255',

            'order' => 'nullable|integer|min:0',

            'quiz_id' => 'nullable|exists:quizzes,id',
        ];
    }
}
