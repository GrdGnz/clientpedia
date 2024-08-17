<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummaryHeader extends Model
{
    use HasFactory;

    protected $table = 'summary_header';

    protected $fillable = [
        'title',
        'service_type',
    ];

    public function subheaders()
    {
        return $this->hasMany(SummarySubheader::class, 'header_id');
    }
}
