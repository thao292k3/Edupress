<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\CourseGoal;
use App\Traits\FileUploadTrait;

class CourseRepository
{
    use FileUploadTrait;

public function getAll()
    {
        return Course::with('sections.lessons')->orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return Course::with('sections.lessons')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Course::create($data);
    }

    public function update(Course $course, array $data)
    {
        $course->update($data);
       return $course->wasChanged();
    }

    public function uploadCourseImage($file, $oldImage = null)
    {
     return $this->uploadFile($file, 'course', $oldImage);
    }

    public function uploadCertificate($file, $oldFile = null)
    {
        return $this->uploadFile($file, 'certificates', $oldFile);
    }



    public function delete(Course $course)
    {
         if ($course->course_image) {
            $this->deleteFile($course->course_image);
        }

        if ($course->certificate_template) {
            $this->deleteFile($course->certificate_template);
        }

        return $course->delete();
    }

    public function createCourseGoals($courseId, array $goals)
    {
        
        
        $dataToInsert = [];
        foreach ($goals as $goal_name) {
            if (!empty($goal_name)) {
                $dataToInsert[] = [
                    'course_id' => $courseId,
                    'goal_name' => $goal_name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($dataToInsert)) {
            return CourseGoal::insert($dataToInsert);
        }

        return true; 
    }


    public function syncCourseGoals($courseId, array $goals)
{
    
    CourseGoal::where('course_id', $courseId)->delete(); 

   
    $dataToInsert = [];
    foreach ($goals as $goal_name) {
        if (!empty(trim($goal_name))) { 
            $dataToInsert[] = [
                'course_id' => $courseId,
                'goal_name' => trim($goal_name),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    }

    
    if (!empty($dataToInsert)) {
        return CourseGoal::insert($dataToInsert);
    }

    return true; 
}

    


   



}
