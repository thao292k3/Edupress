<?php

namespace App\Services;

use App\Models\Course;
use App\Models\LiveSessions;
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
            'category_id', 'subcategory_id', 'course_name', 'course_title',
            'course_name_slug', 'description', 'course_level', 'course_duration',
            'resources', 'is_free', 'selling_price', 'discount_price',
            'preview_count', 'pass_score', 'certificate', 'bestseller',
            'featured', 'highestrated', 'certificate_template',
            'limit_duration_months', 'status',
        ]);

        $data['preview_count'] = $request->preview_count ?? 1;
        $data['pass_score'] = $request->pass_score ?? 60;
        $data['instructor_id'] = Auth::id();

        if (isset($data['is_free']) && $data['is_free'] == 1) {
            $data['selling_price'] = null;
            $data['discount_price'] = null;
            $data['bestseller'] = 'no'; 
            $data['featured'] = 'no'; 
            $data['highestrated'] = 'no'; 
            $data['limit_duration_months'] = null; 
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

        
        $course = $this->courseRepository->create($data);

        
        if ($course && $request->has('live_sessions') && is_array($request->live_sessions)) {
            foreach ($request->live_sessions as $sessionData) {
               
                if (!empty($sessionData['topic']) && !empty($sessionData['meeting_link'])) {
                    \App\Models\LiveSessions::create([
                        'course_id'        => $course->id, 
                        'topic'            => $sessionData['topic'],
                        'description'      => $sessionData['description'] ?? null,
                        'platform'         => $sessionData['platform'] ?? 'Zoom',
                        'meeting_link'     => $sessionData['meeting_link'],
                        'start_at'         => $sessionData['start_at'],
                        'duration_minutes' => $sessionData['duration_minutes'] ?? 60,
                        'is_teacher_joined'=> false,
                        'min_participants' => $sessionData['min_participants'] ?? 15, 
                        'max_participants' => $sessionData['max_participants'] ?? 20, 
                    ]);
                }
            }
        }

        
        if ($request->has('course_goals') && is_array($request->course_goals)) {
            $this->createCourseGoals($course->id, $request->course_goals);
        }

        return $course;
    }


    public function updateCourse($request, Course $course)
    {
        
        $data = $request->only([
            'category_id', 'subcategory_id', 'course_name', 'course_title',
            'course_name_slug', 'description', 'course_level', 'course_duration',
            'resources', 'is_free', 'selling_price', 'discount_price',
            'preview_count', 'pass_score', 'certificate', 'bestseller',
            'featured', 'highestrated', 'limit_duration_months', 'status',
        ]);

       
        if ($request->hasFile('course_image')) {
            $data['course_image'] = $this->courseRepository->uploadCourseImage(
                $request->file('course_image'),
                $course->course_image 
            );
        }

        
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

        
        if ($request->has('live_sessions')) {
            
            \App\Models\LiveSessions::where('course_id', $course->id)->delete();

            foreach ($request->live_sessions as $session) {
                
                if (!empty($session['topic']) && !empty($session['meeting_link'])) {
                    \App\Models\LiveSessions::create([
                        'course_id'        => $course->id,
                        'topic'            => $session['topic'],
                        'meeting_link'     => $session['meeting_link'],
                        'start_at'         => $session['start_at'],
                        'duration_minutes' => 60, 
                        'platform'         => 'Teams', 
                    ]);
                }
            }
            $updated = true;
        }

        // Xử lý Course Goals
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
