<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
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
         $course = $this->route('course'); 
        $isFree = $this->input('is_free');

        return [
            'course_title' => 'required|string|max:255',

            'course_name_slug' => [
                'required',
                Rule::unique('courses', 'course_name_slug')
                    ->ignore($course?->id),  
            ],

            'subcategory_id' => 'nullable|exists:sub_categories,id',

            'is_free' => 'boolean',

            'course_image' => [
                'nullable',
                'image',
                'mimetypes:image/jpeg,image/jfif,image/png,image/webp',
                'max:4096'
            ],

            'certificate_template' => [
                'nullable',
                'image',
                'mimetypes:image/jpeg,image/jfif,image/png,image/webp',
                'max:4096'
            ],

            'description' => 'nullable|string',

            'video_urls' => 'nullable|array',
            'video_urls.*' => 'nullable|url|max:255',

            'course_level' => 'nullable|string|max:100',
            'course_duration' => 'nullable|string|max:100',
            'resources' => 'nullable|string|max:255',

            'duration' => 'nullable|string|max:100',
            'certificate' => 'nullable|string|max:100',

            'selling_price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:selling_price',

            'bestseller' => 'nullable|in:yes,no',
            'featured' => 'nullable|in:yes,no',
            'highestrated' => 'nullable|in:yes,no',

            'pass_score' => 'nullable|integer|min:0|max:100',
            'status' => 'nullable|in:0,1',

            'preview_count' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'integer',
                'min:1',
                $isFree ? 'max:200' : 'max:10'
            ],
        ];
    }
}
