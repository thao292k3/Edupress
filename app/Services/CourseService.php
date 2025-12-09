<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Create new course
     */
    public function createCourse($request)
    {
            $data = $request->only([
            'category_id',
            'subcategory_id',
            'course_title',
            'course_name',
            'course_name_slug',
            'description',
            'video_url',
            'course_level',
            'course_duration',
            'resources',
            'is_free',
            'selling_price',
            'discount_price',
        ]);

        $data['preview_count'] = $request->preview_count ?? 1;
        $data['pass_score'] = $request->pass_score ?? 60;
        $data['instructor_id'] = Auth::id();

        if ($request->hasFile('course_image')) {
            $data['course_image'] = $this->courseRepository->uploadCourseImage(
                $request->file('course_image')
            );
        }

        if ($request->hasFile('certificate_template')) {
            $data['certificate_template'] = $this->courseRepository->uploadCertificate(
                $request->file('certificate_template')
            );
        }

        return $this->courseRepository->create($data);
    }

    /**
     * Update course
     */
    public function updateCourse($request, Course $course)
    {
        $data = $request->only([
            'category_id',
            'subcategory_id',
            'course_name',
            'course_title',
            'course_name_slug',
            'description',
            // 'video_url',
            'course_level',
            'course_duration',
            'resources',
            'is_free',
            'selling_price',
            'discount_price',
            'preview_count',
            'pass_score',
            'certificate', 
            'bestseller',
            'featured',
            'highestrated',
            'certificate_template',
        ]);

        // Upload new course image
        if ($request->hasFile('course_image')) {
            $data['course_image'] = $this->courseRepository->uploadCourseImage(
                $request->file('course_image'),
                $course->course_image // old file
            );
        }

        // Upload new certificate
        if ($request->hasFile('certificate_template')) {
            $data['certificate_template'] = $this->courseRepository->uploadCertificate(
                $request->file('certificate_template'),
                $course->certificate_template // old file
            );
        }

        $updated = $this->courseRepository->update($data, $course);

        $this->courseRepository->syncVideos($course, $request->video_urls);

        return $updated;
    }

    /**
     * Delete course
     */
    public function deleteCourse(Course $course)
    {
        return $this->courseRepository->delete($course);
    }
}
