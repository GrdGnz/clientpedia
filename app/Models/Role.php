<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ACCOUNT_MANAGER = 'Account Manager';
    const TRAVEL_CONSULTANT = 'Travel Consultant';
    const ADMINISTRATOR = 'Administrator';

    protected $fillable = ['name'];

    // Retrieve a role by name
    public static function getRoleByName($name)
    {
        return self::where('name', $name)->first();
    }

    // Get the role name
    public function getRoleName()
    {
        return $this->name;
    }
}
