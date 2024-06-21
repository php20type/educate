<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterProgress extends Model
{
    protected $fillable = ['student_id', 'chapter_id', 'completed'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
