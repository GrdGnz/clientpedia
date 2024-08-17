<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummarySubheader extends Model
{
    use HasFactory;

    protected $table = 'summary_subheader';

    protected $fillable = [
        'header_id',
        'title',
        'service_type',
    ];

    public function header()
    {
        return $this->belongsTo(SummaryHeader::class, 'header_id');
    }
}
