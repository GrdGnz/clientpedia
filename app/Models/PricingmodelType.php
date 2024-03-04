<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingmodelType extends Model
{
    use HasFactory;

    protected $table = 'pricingmodel_types';

    protected $fillable = ['name', 'status'];
}
