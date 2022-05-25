<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id');
    }
    public function story_category()
    {
        return $this->belongsTo(StoryCategory::class, 'story_id');
    }
}
