<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPreferredHotel extends Model
{
    use HasFactory;

    protected $table = 'client_preferred_hotels';

    protected $fillable = [
        'client_id',
        'hotel_code',
        'contact_person',
        'contact_number',
        'contact_email',
        'status_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
