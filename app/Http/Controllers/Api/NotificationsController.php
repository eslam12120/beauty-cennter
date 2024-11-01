<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function userNotifications()
    {
        $userId = Auth::user();
        return response()->json([
            'notifications' => $userId->notifications
        ]) ;
    }
}
