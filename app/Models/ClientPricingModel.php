<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPricingModel extends Model
{
    use HasFactory;

    protected $table = 'client_pricingmodel';

    protected $fillable = [
        'client_id',
        'route_id',
        'pricingmodel_type_id',
    ];

    // Define the relationship with the Route model
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    // Define the relationship with the PricingmodelType model
    public function pricingModelType()
    {
        return $this->belongsTo(PricingmodelType::class, 'pricingmodel_type_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}