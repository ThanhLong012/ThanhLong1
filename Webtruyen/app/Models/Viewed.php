<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewed extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id');
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
    public function viewer()
    {
        return $this->belongsTo(Viewer::class, 'viewer_id');
    }

}
