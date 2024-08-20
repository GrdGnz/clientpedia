<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPreferredCar extends Model
{
    use HasFactory;

    protected $table = 'client_preferred_cars';

    protected $fillable = [
        'client_id',
        'car_code',
        'contact_person',
        'contact_number',
        'contact_email',
        'status_id',
    ];

    /**
     * Get the client that owns the preferred car.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
