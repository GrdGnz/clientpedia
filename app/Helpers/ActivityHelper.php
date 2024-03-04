<?php

// app/Helpers/ActivityHelper.php

use App\Models\UserActivity;

function logUserActivity($userId, $action, $description)
{
    UserActivity::create([
        'user_id' => $userId,
        'action' => $action,
        'description' => $description,
    ]);
}
