<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [
        'accountmanager_user_id',
        'name',
        'code',
        'status_id'
    ];

    // Define the relationship to User through the user_clients table
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_clients');
    }

    public function info()
    {
        return $this->belongsTo(ClientInfo::class, 'id', 'client_id');
    }

    public function accountmanager()
    {
        return $this->belongsTo(User::class, 'accountmanager_user_id', 'id');
    }

    public static function updateAccountManager($clientIds, $accountManagerId)
    {
        // Update the accountmanager_user_id for selected clients
        Client::whereIn('id', $clientIds)
            ->update(['accountmanager_user_id' => $accountManagerId]);
    }
}
