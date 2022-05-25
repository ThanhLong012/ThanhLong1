<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryCategory extends Model
{
    use HasFactory;
    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id');
    }
    public function chapter()
    {
        return $this->hasMany(Chapter::class, 'story_id', 'story_id');
    }
}
