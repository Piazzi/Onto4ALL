<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\Alert;
use App\Notifications\UserNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserNotificationsController extends Controller
{
    public function index(){
        return view('notifications.notifications', [
            'notifications' => auth()->user()->notifications
        ]);
    }

}
