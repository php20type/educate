<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeopleAddress extends Model
{
     protected $fillable=[
        'people_id',
        'address',
        'main_address',
        'work_address',
        'home_address',
        'billing_address',
        'mailing_address',
    ];

     public function people()
    {
        return $this->belongsTo(People::class, 'people_id');
    }
}
