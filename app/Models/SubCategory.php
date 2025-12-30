<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];

     public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'subcategory_id', 'id');
    }
}
