<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPreferredCarsUpload extends Model
{
    use HasFactory;

    protected $table = 'client_preferred_cars_upload';

    protected $fillable = [
        'client_id',
        'file_path',
    ];

    /**
     * Get the client associated with the preferred cars upload.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}