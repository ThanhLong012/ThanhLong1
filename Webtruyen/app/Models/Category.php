<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'categories';

    public function categoryChildren()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function stories()
    {
        return $this->belongsToMany(Story::class, 'story_categories', 'category_id', 'story_id')->withTimestamps();
    }

}
