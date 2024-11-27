<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SavePushNotificationAdmin;

class FirebaseController extends Controller
{
    public function create()
    {
        return view('dashboard.notifications.create');
    }
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);

        $title = $request->title;
        $message = $request->message;
        $users = User::where('is_notify_offer', '1')->where('device_token', '!=', null)->get(['id', 'device_token']);
        // Retrieve user tokens for users who opted for notifications
        $validUsers = $users->filter(function ($user) {
            return !empty($user->device_token); // Ensures device_token is not null or empty
        });
        $userTokens = $validUsers->pluck('device_token')->toArray();
        $chunkSize = 10; // Define chunk size for FCM batch processing
        $tokenChunks = array_chunk($userTokens, $chunkSize);

        // Send notifications via Firebase in chunks
        foreach ($tokenChunks as $tokens) {
            $notification = new SavePushNotificationAdmin($title, $message);
            $notification->toFirebase($tokens);
        }

        // Prepare and insert notifications into the database in batches
        $notifications = [];
        $batchSize = 100; // Number of records per database insert operation
        foreach ($users as $user) {
            $notifications[] = [
                'title' => $title,
                'body' => $message,
                'receiver_id' => $user->id,
                'sender_id' => 1, // Assuming sender ID is always 1
                'is_read' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert batch when size exceeds batch size
            if (count($notifications) >= $batchSize) {
                Notification::insert($notifications);
                $notifications = [];
            }
        }

        // Insert any remaining notifications
        if (!empty($notifications)) {
            Notification::insert($notifications);
        }

        return redirect()->back()->with('success', 'Notifications created successfully.');
    }
}
