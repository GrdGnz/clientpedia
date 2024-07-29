<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientApprover extends Model
{
    use HasFactory;

    protected $table = 'client_approver';

    protected $fillable = [
        'client_id',
        'name',
        'designation',
        'department',
        'contact_landline',
        'contact_mobile',
        'email',
        'approver_level',
        'status_id',
    ];
}
