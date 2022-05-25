<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'story_categories', 'story_id', 'category_id')->withTimestamps();
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'story_genres', 'story_id', 'genre_id')->withTimestamps();
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
    public function chapter()
    {
        return $this->hasMany(Chapter::class, 'story_id', 'id');
    }

}
