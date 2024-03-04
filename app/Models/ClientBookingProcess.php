<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBookingProcess extends Model
{
    use HasFactory;

    protected $table = 'client_booking_process';

    protected $fillable = [
        'client_id',
        'route_id',
        'category_id',
        'order_number',
        'description',
    ];
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
