<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTravelSecurity extends Model
{
    use HasFactory;

    protected $table = 'client_travel_security';

    protected $fillable = [
        'client_id', 'description', 'status_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
