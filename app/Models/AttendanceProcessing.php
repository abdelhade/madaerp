<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\AttendanceProcessingDetail;
use App\Models\EmployeeProduction;

class AttendanceProcessing extends Model
{
    protected $guarded = ['id'];
    protected $table = 'attendance_processings';
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    
    public function attendanceProcessingDetails()
    {
        return $this->hasMany(AttendanceProcessingDetail::class);
    }
    public function employeeProductions()
    {
        return $this->hasMany(EmployeeProduction::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}