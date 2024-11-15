<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    public function index()
    {
        $notifications = PushNotification::orderBy('created_at', 'desc')->paginate(25);
        return view('dashboard.notifications.index', compact('notifications'));
    }
    public function bulksend(Request $req)
    {
        $comment = new PushNotification();
        $comment->title_en = $req->input('title_en');
        $comment->title_ar = $req->input('title_ar');
        $comment->body_en = $req->input('body_en');
        $comment->body_ar = $req->input('body_ar');

        $comment->save();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $req->id, 'status' => "done");
        $notification = array('title_en' => $req->title_en,'title_ar' => $req->title_ar, 'body_en' => $req->body_en,'body_ar' => $req->body_ar, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => "/topics/all", 'notification' => $notification, 'data' => $dataArr, 'priority' => 'high');
        $fields = json_encode($arrayToSend);
        $headers = array(
            'Authorization: key=' . "AAAAmFR07Rg:APA91bHiQl0zRsyHMXMrPTCPUZG1f_dRTsU9VpH9ND6vr7y6OFD5j6SCscSxq_E_nfBqwGp8JkVlLIxEzM4pj0_1OXRaajdiGMfUy8AuD3CG6G0yRsTOij29_erwnIn21VcfrxKXM3Rj",
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        //var_dump($result);
        curl_close($ch);

        return redirect()->route('notifications.index')->with(['success' => 'added successfully']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.notifications.create');
    }
    public function delete($id)
    {
        $notifications = PushNotification::find($id);
        $notifications->delete();

        return redirect()->route('notifications.index')->with(['success' => 'deleted successfully']);
    }
}
