<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {

        $recipient_id = $request['recipient_id'];
        // dd($recipient_id);
        $messages = Message::where(function ($query) use ($recipient_id) {
            $query->where('user_id', Auth::id())
                  ->where('recipient_id', $recipient_id);
        })->orWhere(function ($query) use ($recipient_id) {
            $query->where('user_id', $recipient_id)
                  ->where('recipient_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();


        // dd($messages);
        // return redirect()->route('chat.', compact('messages', 'recipient_id'));
        return view('chat', compact('messages', 'recipient_id'));
    }

    public function store(Request $request)
    {
        // dd($request['recipient_id']);
        $request->validate([
            'message' => 'required|string',
            'recipient_id' => 'required|exists:users,id',
        ]);

        $msg = Message::create([
            'user_id' => Auth::id(),
            'recipient_id' => $request->recipient_id,
            'content' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // dd($request->recipient_id);

        return redirect()->route('chat.index', ['recipient_id' => $request->recipient_id]);
    }
}

