<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummaryService extends Model
{
    use HasFactory;

    protected $table = 'summary_services';

    protected $fillable = [
        'client_id',
        'header_id',
        'subheader_id',
        'service_name',
        'measure',
        'currency',
        'office_hours',
        'after_office_hours',
    ];
}
