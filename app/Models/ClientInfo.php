<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\ClientType;

class ClientInfo extends Model
{
    use HasFactory;

    protected $table = 'client_info';

    protected $fillable = [
        'client_id', 
        'client_type_id', 
        'global_customer_number', 
        'contract_start_date', 
        'contract_end_date'
    ];

    public function clientType()
    {
        return $this->belongsTo(ClientType::class, 'client_type_id');
    }

    public function client() 
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
