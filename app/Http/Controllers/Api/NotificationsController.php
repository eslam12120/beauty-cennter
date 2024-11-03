<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function userNotifications()
    {
        $notifications = Notification::where('receiver_id', Auth::id())->orderBy('id', 'DESC')->simplePaginate(30);
        return response()->json([
            'data' => $notifications,
            'message'=>'success'
        ],200) ;
    }

    public function read_notifications()
    {
        Notification::where('receiver_id', Auth::id())->orderBy('id', 'DESC')->update([
            'is_read'=> '1'
        ]);
        return response()->json([
            'message'=>'success'
        ],200);
    }
}
