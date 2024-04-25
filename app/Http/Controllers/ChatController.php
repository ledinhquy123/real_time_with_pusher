<?php

namespace App\Http\Controllers;

use App\Events\TestMessageSent;
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

        broadcast(new TestMessageSent(auth()->user(), $request->message));

        return $this->success([
            'user' => auth()->user(),
            'message' => $request->message
        ], 'Message has been sent successfully');
    }
}
