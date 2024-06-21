<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'video_link',
        'title',
        'course_id',
        'pdf_url',
        'affiliate_link',
        'description',
        'image',
        'status',
    ];

    /**
     * Get the course that owns the chapter.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // public function progress()
    // {
    //     return $this->hasMany(ChapterProgress::class);
    // }
    public function progress()
    {
        return $this->hasMany(ChapterProgress::class);
    }
}
