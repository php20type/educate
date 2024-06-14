<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'program_id', 'image', 'is_active'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the chapters for the course.
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
