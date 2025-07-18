<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = ['id'];
    protected $table = 'attendances';
    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function attendanceProcessingDetails()
    {
        return $this->hasMany(AttendanceProcessingDetail::class);
    }
}
