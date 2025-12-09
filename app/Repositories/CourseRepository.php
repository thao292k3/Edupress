<?php

namespace App\Repositories;

use App\Models\Course;
use App\Traits\FileUploadTrait;

class CourseRepository
{
    use FileUploadTrait;

    /**
     * Create new course
     */
    public function create(array $data)
    {
        return Course::create($data);
    }

    /**
     * Update course
     */
    public function update(array $data, Course $course)
    {
        $course->update($data);
        return $course;
    }

    /**
     * Upload course image
     */
    public function uploadCourseImage($file, $oldImage = null)
    {
     return $this->uploadFile($file, 'course', $oldImage);
    }

    /**
     * Upload certificate template
     */
    public function uploadCertificate($file, $oldFile = null)
    {
        return $this->uploadFile($file, 'certificates', $oldFile);
    }

    /**
     * Delete course
     */
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

    public function syncVideos(Course $course, array $videosData = [])
{
    $course->videos()->delete();

    $dataToInsert = [];

    // Xử lý URL
    if (!empty($videosData['video_urls']) && is_array($videosData['video_urls'])) {
        foreach ($videosData['video_urls'] as $url) {
            if (!empty($url)) {
                $dataToInsert[] = [
                    'video_url' => $url,
                    'video_file' => null,
                ];
            }
        }
    }

    // Xử lý file upload (single file)
    if (!empty($videosData['video_file']) && $videosData['video_file'] instanceof \Illuminate\Http\UploadedFile) {
        $path = $this->uploadFile($videosData['video_file'], 'course_videos');

        $dataToInsert[] = [
            'video_url' => null,
            'video_file' => $path,
        ];
    }

    if (!empty($dataToInsert)) {
        $course->videos()->createMany($dataToInsert);
    }
}

}
