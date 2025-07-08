<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalDetail extends Model
{
    protected $table = 'journal_details';

    protected $guarded = [];

    public $timestamps = false;


    public function accountHead()
    {
        
        return $this->belongsTo(AccHead::class, 'account_id');
        
    }
    public function head()
    {
        return $this->belongsTo(JournalHead::class);
    }
}
