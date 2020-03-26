<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageStoreRequest;
use App\Message;
use App\User;
use App\Notifications\Alert;
use Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $messages = Message::select()->latest()->paginate(15);
        return view('messages.messages', compact('messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MessageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageStoreRequest $request)
    {
        $message = new Message;
        $message->name = $request->user()->name;
        $message->email = $request->user()->email;
        $message->message = $request->message;
        $message->read = false;
        $message->category = $request->category;
        $message->save();

        $this->sendNotification($message);

        return redirect('/help')->with('Success', 'Your message was send');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->read = true;
        $message->save();
        return view('messages.messages-show', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::findOrFail($id)->delete();
        return redirect(route('messages.index'))->with('Success', 'The message has been deleted with success');
    }

    /**
     * Search's for the given name on the database
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $messages = Message::where('message','Like',  '%' .$request->search. '%')->paginate(50);
        return view('messages.messages', compact('messages'));
    }

    /**
     * Send a notification to the admins
     * @param $message
     */
    public function sendNotification($message)
    {
        $users = User::where('categoria','administrador')->get();
        $details = [
            'data' => $message->message,
        ];

        Notification::send($users, new Alert($details));
    }
}

