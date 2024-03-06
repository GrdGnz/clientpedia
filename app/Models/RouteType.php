<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteType extends Model
{
    use HasFactory;

    protected $table = 'route_types';

    protected $fillable = [
        'name',
    ];
}
