<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Employee extends Model 
{

    protected $table = 'employees';
    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_hire' => 'date',
        'date_of_fire' => 'date',
    ];

    protected $guarded = ['id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function job()
    {
        return $this->belongsTo(EmployeesJob::class);
    }

    public function leave()
    {
        return $this->hasOne(Leave::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Employee_Evaluation::class);
    }

    public function employeeProductions()
    {
        return $this->hasMany(EmployeeProduction::class);
    }


}