<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTravelPolicy extends Model
{
    use HasFactory;

    protected $table = 'client_travel_policy';
    
    protected $fillable = [
        'client_id',
        'category_id',
        'lla',
        'service_class',
        'flight_window',
        'advance_purchase',
        'lcc_condition',
        'seat_selection',
        'baggage_allowance',
        'group_booking_policy',
        'companion_hcp_personaltravel',
        // You can add other fields here
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function category() 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
