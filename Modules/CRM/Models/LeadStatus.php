<?php

namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    protected $table = 'lead_statuses';

    protected $fillable = ['name', 'color', 'order_column'];

    public static function ordered()
    {
        return self::orderBy('order_column')->get();
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'status_id');
    }
}
