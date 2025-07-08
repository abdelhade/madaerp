<?php

namespace App\Models;

use App\Models\AccHead;
use App\Models\ProType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\OperationItems;

class OperHead extends Model
{
    use HasFactory;

    protected $table = 'operhead';

    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(ProType::class, 'pro_type');
    }

    public function acc1Head()
    {
        return $this->belongsTo(AccHead::class, 'acc1');
    }

    public function acc2Head()
    {
        return $this->belongsTo(AccHead::class, 'acc2');
    }

    public function employee()
    {
        return $this->belongsTo(AccHead::class, 'emp_id');
    }

    public function store()
    {
        return $this->belongsTo(AccHead::class, 'store_id');
    }

    public function acc1Headuser()
    {
        return $this->belongsTo(AccHead::class, 'user');
    }

    public function operationItems()
    {
        return $this->hasMany(OperationItems::class, 'pro_id');
    }
}
