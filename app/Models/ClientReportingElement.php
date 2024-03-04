<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReportingElement extends Model
{
    use HasFactory;

    protected $table = 'client_reporting_elements';

    protected $fillable = [
        'client_id',
        'report_code',
        'description',
        'status_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
