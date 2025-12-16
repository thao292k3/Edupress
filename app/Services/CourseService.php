<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseService
{
     protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function createCourse($request)
    {
            $data = $request->only([
            'category_id',
            'subcategory_id',
            'course_name',
            'course_title',
            'course_name_slug',
            'description',
            // 'course_benefits',
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
            'limit_duration_months',
            'status',
        ]);

        $data['preview_count'] = $request->preview_count ?? 1;
        $data['pass_score'] = $request->pass_score ?? 60;
        $data['instructor_id'] = Auth::id();

        if (isset($data['is_free']) && $data['is_free'] == 1) {
            $data['selling_price'] = null;
            $data['discount_price'] = null;
            $data['bestseller'] = 'no'; // Đặt về 'no'
            $data['featured'] = 'no'; // Đặt về 'no'
            $data['highestrated'] = 'no'; // Đặt về 'no'
            $data['limit_duration_months'] = null; // Thời hạn truy cập cũng bị xóa
        }

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


    public function updateCourse($request, Course $course)
    {
        $data = $request->only([
            'category_id',
            'subcategory_id',
            'course_name',
            'course_title',
            'course_name_slug',
            'description',
            // 'course_benefits',
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
            'limit_duration_months',
            'status',
        ]);

        // Upload new course image
        if ($request->hasFile('course_image')) {
            $data['course_image'] = $this->courseRepository->uploadCourseImage(
                $request->file('course_image'),
                $course->course_image 
            );
        }

        // Upload new certificate
        if ($request->hasFile('certificate_template')) {
            $data['certificate_template'] = $this->courseRepository->uploadCertificate(
                $request->file('certificate_template'),
                $course->certificate_template 
            );
        }

        if (isset($data['is_free']) && $data['is_free'] == 1) {
            $data['selling_price'] = null;
            $data['discount_price'] = null;
            $data['bestseller'] = 'no';
            $data['featured'] = 'no';
            $data['highestrated'] = 'no';
            $data['limit_duration_months'] = null;
        }

        $updated = $this->courseRepository->update($course, $data);

        if ($request->has('course_goals') && is_array($request->course_goals)) {
            $this->syncCourseGoals($course->id, $request->course_goals);
            $updated = true;
        }

        return $updated;
    }

     public function deleteCourse(Course $course)
    {
        return $this->courseRepository->delete($course);
    }

    public function createCourseGoals($courseId, array $goals)
    {
        return $this->courseRepository->createCourseGoals($courseId, $goals);
    }

    public function syncCourseGoals($courseId, array $goals)
    {
        
        return $this->courseRepository->syncCourseGoals($courseId, $goals);
    }


    
}
