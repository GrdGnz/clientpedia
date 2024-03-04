<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientHotelCorporateCode extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'hotel_id', 'route_id', 'status_id'];

    // Define the relationships
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
