<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Notification;

class UserNotificationsController extends Controller
{
    public function index()
    {
        auth()->user()->notifications->markAsRead();
        return view('notifications.notifications', [
            'notifications' => auth()->user()->notifications
        ]);
    }

    public function show($locale, $notificationId, $notificationType)
    {   
        if($notificationType == 'Onto4All Contact'){
            return view('messages.messages-show', [
                'notification' => auth()->user()->notifications()->where('id','=', $notificationId)->first()
            ]);
        }
        else{
            return redirect(route('ontologies.index', app()->getLocale()));
        }
    }

    public function sendContactNotification()
    {
        $notification = [
            'title' => request('category'),
            'message'=> request('message'),
            'from'=> auth()->user()->email,
            'type'=>'Onto4All Contact'
        ];
        $users = User::where('categoria','administrador')->get();
        Notification::send($users, new UserNotification($notification));
        return redirect()->route('help', app()->getLocale())->with('Success', 'Your message was send');
    }
}
