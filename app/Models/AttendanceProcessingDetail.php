<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceProcessingDetail extends Model
{
    protected $guarded = ['id'];
    protected $table = 'attendance_processing_details';
    protected $casts = [
        'time' => 'time',
    ];
    public function attendanceProcessing()
    {
        return $this->belongsTo(AttendanceProcessing::class);
    }
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
