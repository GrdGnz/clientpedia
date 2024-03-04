<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPreferredAirline extends Model
{
    use HasFactory;

    protected $table = 'client_preferred_airlines';
    
    protected $fillable = [
        'client_id',
        'route_id',
        'airline_code',
        'status_id',
    ];

    // Define the relationship to retrieve the airline information
    public function airline()
    {
        return $this->belongsTo(Airlines::class, 'airline_code', 'code');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}


