<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFee extends Model
{
    use HasFactory;

    protected $table = 'client_fees';

    protected $fillable = [
        'client_id',
        'category_id',
        'route_id',
        'description',
        'source_id',
        'amount',
    ];

    // Define the relationship with the 'client' model
    public function client()
    {
        return $this->belongsTo(Client::class);
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
