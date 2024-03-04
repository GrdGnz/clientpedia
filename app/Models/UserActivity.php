<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $table = 'user_activities';

    protected $fillable = ['user_id', 'action', 'description'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function  getLastLoginDate($userId) 
    {
        // Get the last 'login' action for the specified user
        $lastLoginActivity = UserActivity::where('user_id', $userId)
            ->where('action', 'login')
            ->orderBy('created_at', 'desc')
            ->value('created_at');

        return $lastLoginActivity;
    }

}
