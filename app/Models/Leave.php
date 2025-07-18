<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model 
{

    protected $table = 'leaves';
    public $timestamps = true;
    protected $fillable = array('employee_id', 'start_date', 'end_date', 'reason', 'status', 'applied_at');

    public function employee()
    {
        return $this->belongsTo(Employe::class);
    }

}