<?php
namespace App\Helper;

use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Messaging\CloudMessage;

class FCMHelpers
{
    public static function sendNotification($fcmToken, $title, $body)
    {
//        $messaging = app('firebase.messaging');
//
//        $message = CloudMessage::fromArray([
//            'token' => $fcmToken,
//            'notification' => ['title' => 'Hello!', 'body' => 'This is a test notification.'],
//        ]);
//        dd($message);
        $messaging = app('firebase.messaging');

        $message = CloudMessage::fromArray([
            'token' => $fcmToken,
            'data' => [ // 🔥 Use 'data' instead of 'notification'
                'title' => $title,
                'body' => $body,
                'icon' => url('/assets/images/logos/logo-jjm.svg'),
                'click_action' => url('/') // URL to open when clicked
            ],
            'webpush' => [
                'headers' => [
                    'Urgency' => 'high'
                ],
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'icon' => url('/assets/images/logos/logo-jjm.svg')
                ]
            ]
        ]);

        $messaging->send($message);


        $serverKey = env('FIREBASE_SERVER_KEY');

//        $response = Http::withHeaders([
//            'Authorization' => 'key=' . $serverKey,
//            'Content-Type' => 'application/json',
//        ])->post('https://fcm.googleapis.com/fcm/send', [
//            'to' => $fcmToken,
//            'notification' => [
//                'title' => $title,
//                'body' => $body,
//                'icon' => url('/assets/images/logos/logo-jjm.svg'), // Your app's icon
//                'click_action' => url('/'), // URL to open on click
//            ],
//        ]);

//        return $response->json();
    }
}

