<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\NewMessage;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $messages = Chat::where(function($q){
                $q->where('sender_id', Auth::id())
                  ->orWhere('recipient_id', Auth::id());
            })
            ->orderBy('sent_at')
            ->get()
            ->groupBy(function($chat){
                return $chat->sender_id === Auth::id() ? $chat->recipient_id : $chat->sender_id;
            });

        return view('chat.index', compact('users', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        $message = Chat::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $request->recipient_id,
            'message' => $request->message,
            'sent_at' => now(),
            'sender_name' => Auth::user()->getAttribute('name'),
        ]);


	event(new NewMessage($message));

        return redirect()->back();
    }
}
