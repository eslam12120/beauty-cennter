<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Kreait\Firebase\Factory;
use Google\Auth\OAuth2;

class SavePushNotificationAdmin extends Notification
{
    use Queueable;

    protected $title;
    protected $message;


    protected $firebaseMessaging;
    protected $projectId;



    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
        $this->projectId = 'after-glow-ac9f7';
        $this->firebaseMessaging = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createMessaging();
    }

    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,

        ];
    }
    public function toFirebase($notifiable)
    {
        $url = 'https://fcm.googleapis.com/v1/projects/' . $this->projectId . '/messages:send';
        $accessToken = $this->getAccessToken();
        foreach ($notifiable as $deviceToken) {
            $message = CloudMessage::withTarget('token', $deviceToken)
                ->withNotification(FirebaseNotification::create($this->title, $this->message))
                ->withData([
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    'id' => '1',
                    'status' => 'done',
                    'title' => $this->title,
                ]);

            $data = [
                'message' => [
                    'token' => $deviceToken,
                    'notification' => [
                        'title' => $this->title,
                        'body' => $this->message,
                    ],
                    'data' => [
                        'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                        'id' => '1',
                        'status' => 'done',
                        'title' => $this->title,
                    ],
                ],
            ];

            $headers = [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json',
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                throw new \Exception('Curl error: ' . curl_error($ch));
            }
            curl_close($ch);
        }
    }
    private function getAccessToken()
    {
        // Get OAuth 2.0 access token from Firebase
        $client = new \Google_Client();
        $client->setAuthConfig(base_path(env('FIREBASE_CREDENTIALS')));
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $accessToken = $client->fetchAccessTokenWithAssertion();
        return $accessToken['access_token'];
    }
}
