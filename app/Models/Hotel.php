<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $fillable = [
        'code',
        'name',
        'address',
        'city',
        'state',
        'country',
        'status_id',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
