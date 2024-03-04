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
        'order_number',
        'description',
    ];
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
