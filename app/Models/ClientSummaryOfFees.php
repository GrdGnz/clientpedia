<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSummaryOfFees extends Model
{
    use HasFactory;

    protected $table = 'client_summary_of_fees';

    protected $fillable = [
        'client_id',
        'category',
        'sub_category',
        'service',
        'measure',
        'currency',
        'standard_office_hours',
        'after_office_hours',
    ];
}
