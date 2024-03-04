<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePhoto extends Model
{
    protected $fillable = ['user_id', 'photo_path', 'thumbnail_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}