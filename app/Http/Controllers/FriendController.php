<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use DB;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function friendRequest(Request $request){
        $userId = $request['id'];

        $check = DB::table('pendings')
                    ->where('userDst_id', '=', auth()->id())
                    ->where('userSrc_id', '=', $userId)
                    ->get();
        
        if($check->isEmpty()){
            DB::table('pendings')->insert([
              'userSrc_id' => auth()->user()->id,
              'userDst_id' => $userId,
              'created_at' => now(),
              'updated_at' => now(),  
            ]);
        } else{
            DB::table('pendings')
            ->where('userDst_id', auth()->id())
            ->where('userSrc_id', $userId)
            ->delete();

            DB::table('friends')->insert([
                'user1_id' => auth()->id(),
                'user2_id' => $userId,
            ]);
        }

        return redirect()->route('home.index');
    }

    public function requestView(){
        $userId = auth()->user()->id;

        $usersCome = DB::table('pendings')
                        ->join('users', 'users.id', '=', 'userSrc_id')
                        ->where('userDst_id', '=', $userId)
                        ->select('*')
                        ->get();

        $usersGo = DB::table('pendings')
                        ->join('users', 'users.id', '=', 'userDst_id')
                        ->where('userSrc_id', '=', $userId)
                        ->select('*')
                        ->get();   
                        
        return view('request', compact('usersCome', 'usersGo'));
    }

    public function friends(){
        $userId = auth()->id(); // Get the current logged-in user's ID

        $friends = DB::table('friends')
            ->where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->get();

        $friendIds = $friends->pluck('user1_id')->merge($friends->pluck('user2_id'))->unique()->toArray();

        $users = DB::table('users')
            ->whereIn('id', $friendIds)
            ->get();

        // dd($users);
            
        return view('friend', compact('users'));
        }


    public function sendMessage(Request $request)
        {
            $message = Message::create([
                'user_id' => auth()->id(),
                'content' => $request->input('content'),
            ]);
        
            broadcast(new MessageSent($message))->toOthers();
        
            return response()->json(['status' => 'Message sent!']);
        }
}
