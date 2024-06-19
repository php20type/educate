<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['name', 'description', 'image', 'status'];

    use HasFactory;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'user_programs');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_programs');
    }
}
