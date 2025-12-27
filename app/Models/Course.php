<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Course extends Model
{
    protected $guarded = [];

    protected function sellingPriceVn(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $this->formatPrice($attributes['selling_price']),
        );
    }

    
    protected function discountPriceVn(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $this->formatPrice($attributes['discount_price']),
        );
    }

    
   

    private function formatPrice($price)
    {
        
        $price = (float) $price;

        if ($price <= 0) { 
            return '0 VND';
        }
        
        
        return number_format($price, 0, '', '.') . ' VND'; 
    }
    
    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('position');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Course_videos::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(
        Lesson::class, 
        Section::class, 
        'course_id', 
        'section_id',
        'id', 
        'id'
    );
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function totalDuration()
    {
        return $this->lessons()->sum('duration');
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class, 'course_id', 'id');
    }

    public function totalStudents()
    {
        
        return $this->enrollments()->count(); 
    }

    public function totalLessons()
    {
        return $this->lessons()->count(); 
    }


    public function getProgressPercentageForUser($userId)
    {
        $totalLessons = $this->totalLessons();

        if ($totalLessons === 0) {
            return 0;
        }

        
        $completedLessonsCount = LessonProgress::where('user_id', $userId)
            ->whereIn('lesson_id', $this->lessons->pluck('id')) 
            ->where('is_completed', 1)
            ->count();

        return round(($completedLessonsCount / $totalLessons) * 100);
    }

    public function students()
    {
    
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
                    ->where('role', 'student'); 
        
        
    }

    public function courseGoals()
        {
            return $this->hasMany(\App\Models\CourseGoal::class);
        }

    public function user(){
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }

    public function course_goal(){
        return $this->hasMany(CourseGoal::class, 'course_id', 'id');
    }

    public function quizzes()
{
    return $this->hasMany(Quiz::class, 'course_id');
}

    


}
