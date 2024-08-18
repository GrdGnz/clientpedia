<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPreferredAirlinesUpload extends Model
{
    use HasFactory;

    protected $table = 'client_preferred_airlines_upload';

    protected $fillable = [
        'client_id',
        'file_path',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
