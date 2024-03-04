<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricingmodel extends Model
{
    use HasFactory;

    protected $table = 'pricingmodels';

    protected $fillable = [
        'name',
    ];
}
