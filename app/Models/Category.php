<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

     public function course(){
        return $this->hasMany(Course::class, 'category_id', 'id')->where('status', 1);
     }

     public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }


}
