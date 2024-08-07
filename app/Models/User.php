<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'instagram',
        'country',
        'city',
        'date_of_birth',
        'about_me',
        'educate_community_profile',
        'instagram_profile',
        'twitter_profile',
        'time_zone',
        'email',
        'image',
        'is_admin',
        'is_verify',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_programs');
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'user_programs');
    }

    public function getProgramsForLoggedInUser()
    {
        return $this->programs()->with('courses')->get();
    }

    public function chapterProgress()
    {
        return $this->hasMany(ChapterProgress::class);
    }
}
