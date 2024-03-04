<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    protected $table = 'client_contacts';

    protected $fillable = [
        'client_id',
        'name',
        'designation',
        'department',
        'contact_landline',
        'contact_mobile',
        'email',
        'birthday',
        'remarks',
        'status_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // Add any other relationships or methods you need here
}
