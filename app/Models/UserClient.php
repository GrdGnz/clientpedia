<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    protected $table = 'user_clients';
    
    protected $fillable = ['user_id', 'client_id']; // Add other fields as needed

}
