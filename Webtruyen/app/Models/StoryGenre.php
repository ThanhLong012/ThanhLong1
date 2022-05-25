<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryGenre extends Model
{
    use HasFactory;
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id');
    }
    public function chapter()
    {
        return $this->hasMany(Chapter::class, 'story_id', 'story_id');
    }
}
