<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientVip extends Model
{
    use HasFactory;

    protected $table = 'client_vips'; // Specify the table name if it's different from the model's name

    protected $fillable = [
        'client_id',
        'name',
        'designation',
        'contact_number',
        'email',
        'birthday',
        'remarks',
        'status_id',
    ];

    // Define relationships if needed
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

}
