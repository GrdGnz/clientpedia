<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFareReference extends Model
{
    use HasFactory;

    protected $table = 'client_fare_reference';

    protected $fillable = [
        'client_id',
        'published_fares',
        'private_fares',
        'corporate_fares',
    ];

    // Define the relationship with the 'client' model
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
