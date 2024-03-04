<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAncilliaryFee extends Model
{
    use HasFactory;

    protected $table = 'client_ancilliary_fees';

    protected $fillable = [
        'client_id',
        'description',
        'currency_code',
        'amount',
        'status_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
