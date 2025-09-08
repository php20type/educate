<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'bio',
        'legacy_id',
        'postalCode',
        'country_id',
        'state_id',
        'city_id',
        'marketing_status',
        'territory_id',
        'tag_id'
    ];

    // Belongs to relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function territory()
    {
        return $this->belongsTo(Territory::class, 'territory_id');
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    // New database hasmany relations
    public function peopleEmail()
    {
        return $this->hasMany(PeopleEmail::class, 'people_id');
    }
    public function peopleAddress()
    {
        return $this->hasMany(PeopleAddress::class, 'people_id');
    }

    public function peoplePhone()
    {
        return $this->hasMany(PeoplePhone::class, 'people_id');
    }
    public function peopleTask()
    {
        return $this->hasMany(PeopleTask::class, 'people_id');
    }
    public function peopleUrl()
    {
        return $this->hasMany(PeopleUrl::class, 'people_id');
    }
    public function peopleCompany()
    {
        return $this->hasMany(PeopleCompany::class, 'people_id');
    }

    // Belongs to many pivot table relation for people_companies table
    public function companiesAlt()
    {
        return $this->belongsToMany(Company::class, 'people_company')
            ->withTimestamps();
    }


    // Has many relations
    public function activities()
    {
        return $this->hasMany(Activity::class, 'participant_id');
    }

    // Lead People pivot table
    public function leadPeople()
    {
        return $this->hasMany(LeadPeople::class, 'people_id');
    }
    public function leads()
    {
        return $this->belongsToMany(Lead::class, 'lead_peoples')
            ->withTimestamps();
    }

    // Pivot table relation for new - company_peoples table
    public function companyPeople()
    {
        return $this->hasMany(CompanyPeople::class, 'people_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_peoples')
            ->withTimestamps();
    }



}

