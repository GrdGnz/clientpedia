<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profilePhoto()
    {
        return $this->hasOne(ProfilePhoto::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'user_clients');
    }

    // Define a relationship to the new table
    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }
    
}
