<?php

namespace App\Http\Controllers;

use App;
use App\Models\Avatar;
use Auth;
use DB;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function index(){
        $loc = session()->get('locale');
        App::setLocale($loc);

        $userId = auth()->id();
        
        $boughtAvatarIds = DB::table('user_avatars')
        ->where('user_id', $userId)
        ->pluck('avatars_id')
        ->toArray();

        // Get avatars that the user hasn't bought
        $avatars = Avatar::whereNotIn('id', $boughtAvatarIds)->get();

        return view('avatar', compact('avatars'));
    }

    public function buyAvatar(Request $request)
    {
        $aid = $request->input('id');
        $avatar = Avatar::find($aid);

        
        $user = Auth::user();
        $money = $user->money;
        
        if ($avatar->price > $money) {
            return redirect()->back()->with('error', __('messages.insufficient_funds'));
        }
        
        // Deduct money and attach avatar to user
        $user->money -= $avatar->price;
        $user->save();
        
        DB::table('user_avatars')->insert([
            'user_id' => $user->id,
            'avatars_id' => $aid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('avatar.index')->with('success', __('messages.avatar_purchased'));
    }
}
