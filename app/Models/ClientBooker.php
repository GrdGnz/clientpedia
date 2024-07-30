<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBooker extends Model
{
    use HasFactory;

    protected $table = 'client_booker';

    protected $fillable = [
        'client_id',
        'name',
        'designation',
        'department',
        'contact_landline',
        'contact_mobile',
        'email',
        'status_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
