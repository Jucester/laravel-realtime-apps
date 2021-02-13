<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('chat.show');
    }

    public function messageReceived(Request $request)
    {
        $data = $request->validate([
            'message' => 'required'
        ]);

        broadcast(new MessageSend($request->user(), $data['message']));
        
        return response()->json('Message broadcasted');
    }

    public function greetingReceived(Request $request, User $user)
    {
         return "Greeting {$user->name} from {$request->user()->name}";
    }
}
