<?php

namespace App\Http\Controllers;

use App\Events\GreetingSent;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function showChat() {
        return view('chat.show');
    }

    public function messageReceived(Request $request) {
        $rules = [
            'message' => 'required'
        ];

        $request->validate($rules);

        broadcast(new MessageSent(auth()->user(), $request->message));

        return $this->success([
            'user' => auth()->user(),
            'message' => $request->message
        ], 'Message has been sent successfully');
    }

    public function greetReceive(Request $request, User $receiver) {
        broadcast(new GreetingSent($receiver, "{$request->user()->name} đã chào bạn"));
        broadcast(new GreetingSent($request->user(), "Bạn đã chào {$receiver->name}"));

        return "Greeted from {$request->user()->name} to {$receiver->name}";
    }
}
