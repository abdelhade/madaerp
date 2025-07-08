<?php

namespace Modules\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    protected $table = 'client_contacts';
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(CrmClient::class, 'client_id');
    }
}
