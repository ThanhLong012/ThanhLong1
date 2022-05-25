<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function genreChildren()
    {
        return $this->hasMany(Genre::class, 'parent_id');
    }
    public function stories()
    {
        return $this->belongsToMany(Story::class, 'story_genres', 'genre_id', 'story_id')->withTimestamps();
    }

}
