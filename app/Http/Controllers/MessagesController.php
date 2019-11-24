<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;

class MessagesController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:1|max:50',
            'email'=>'required|max:100',
            'hotel_id'=>'required',
            'message'=>'required|min:4|max:500'
        ]);

        $message = new Message([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'hotel_id' => (int)$request->get('hotel_id'),
            'message' => $request->get('message'),
            'status' => 0
        ]);

        $message->save();
        return redirect('/')->with('success', 'mensagem enviada com sucesso!');

    }

    public function messagesList()
    {
        if(Auth::user()->role == 1) {
            $messages = Message::with('hotel')->paginate(20);
        } else {
            $messages = Message::where('hotel_id', Auth::user()->hotel_id)
            ->with('hotel')->paginate(20);
        }

        return view('admin.messages.index', compact('messages'));
    }
}
