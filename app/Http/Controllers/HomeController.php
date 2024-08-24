<?php

namespace App\Http\Controllers;

use App;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Request $request) {

        $loc = session()->get('locale');
        App::setLocale($loc);

        $userId = auth()->id();

        // Check for pending friend requests
        $friendRequests = DB::table('pendings')
            ->where('userDst_id', $userId)
            ->count();

        // Check for unread messages
        $unreadMessages = DB::table('messages')
            ->where('recipient_id', $userId)
            ->where('is_read', 0)
            ->count();

        // Set flash messages for notifications
        if ($friendRequests > 0) {
            session()->flash('friend_request', "You have $friendRequests new friend request(s).");
        }

        if ($unreadMessages > 0) {
            session()->flash('unread_messages', "You have $unreadMessages unread message(s).");
        }

        // Get search and filter inputs
        $search = $request->input('search');
        $gender = $request->input('gender');
        $interest = $request->input('interest'); // Add this for interest-based search

        // Get IDs from the 'friends' table
        if (auth()->check()) {
            $friendIds = DB::table('friends')
                ->where('user1_id', $userId)
                ->orWhere('user2_id', $userId)
                ->pluck('user1_id')
                ->merge(
                    DB::table('friends')
                        ->where('user1_id', $userId)
                        ->orWhere('user2_id', $userId)
                        ->pluck('user2_id')
                );

            // Get IDs from the 'pendings' table
            $pendingIds = DB::table('pendings')
                ->where('userSrc_id', $userId)
                ->orWhere('userDst_id', $userId)
                ->pluck('userSrc_id')
                ->merge(
                    DB::table('pendings')
                        ->where('userSrc_id', $userId)
                        ->orWhere('userDst_id', $userId)
                        ->pluck('userDst_id')
                );

            // Combine all IDs and include the current user ID
            $excludedIds = $friendIds
                ->merge($pendingIds)
                ->merge([$userId])
                ->unique()
                ->toArray();

            // Query to get users who are not friends or pending with the authenticated user
            $usersQuery = DB::table('users')
                ->where('visibility', 0) // Ensure only visible users are shown
                ->whereNotIn('users.id', $excludedIds)
                ->leftJoin('user_interests', 'users.id', '=', 'user_interests.user_id')
                ->leftJoin('interests', 'user_interests.interest_id', '=', 'interests.id')
                ->select('users.id', 'users.name', 'users.email', 'interests.name as interest_name', 'profile_pic', 'gender');
        } else {
            $usersQuery = User::leftJoin('user_interests', 'users.id', '=', 'user_interests.user_id')
                ->leftJoin('interests', 'user_interests.interest_id', '=', 'interests.id')
                ->select('users.id', 'users.name', 'users.email', 'interests.name as interest_name', 'profile_pic', 'gender');
        }

        // Apply search filter
        if (!empty($search)) {
            $usersQuery->where(function($query) use ($search) {
                $query->where('users.name', 'like', '%' . $search . '%')
                      ->orWhere('users.email', 'like', '%' . $search . '%')
                      ->orWhere('interests.name', 'like', '%' . $search . '%'); // Include interest search
            });
        }

        // Apply gender filter
        if ($gender !== null) {
            $usersQuery->where('users.gender', $gender);
        }

        // Apply interest filter
        if (!empty($interest)) {
            $usersQuery->where('interests.name', $interest);
        }

        $users = $usersQuery->get()->groupBy('id');

        return view('home', compact('users'));
    }

    public function profile(){

        $loc = session()->get('locale');
        App::setLocale($loc);

        return view('profile');
    }

    public function topup(){
        $loc = session()->get('locale');
        App::setLocale($loc);

        return view('topup');
    }

    public function coinTopup(Request $request){
        $user = auth()->user();

        $user->money += 100;
        $user->save();

        return redirect()->route('topup.show');
    }

    public function hide(Request $request)
    {
        $user = Auth::user();

        if ($user->money < 50) {
            return redirect()->route('user.profile')->with('error', __('messages.insufficient_funds'));
        }

        // Deduct 50 coins
        $user->money -= 50;
        $user->visibility = 1;
        $user->save();

        // Replace profile picture with a random bear image
        $bearImages = ['1.png', '2.png', '3.png'];
        $randomBear = $bearImages[array_rand($bearImages)];
        $user->profile_pic = $randomBear;
        $user->save();

        return redirect()->route('user.profile')->with('success', __('messages.profile_hidden'));
    }

    public function unhide(Request $request)
    {
        $user = Auth::user();

        if ($user->money < 5) {
            return redirect()->route('user.profile')->with('error', __('messages.insufficient_funds'));
        }

        // Deduct 50 coins
        $user->money -= 5;
        $user->visibility = 0;
        $user->save();

        return redirect()->route('user.profile')->with('success', __('messages.profile_unhidden'));
    }

    public function showBoughtAvatars()
{
    $userId = auth()->id();
    $boughtAvatars = DB::table('user_avatars')
        ->join('avatars', 'user_avatars.avatars_id', '=', 'avatars.id')
        ->where('user_avatars.user_id', $userId)
        ->select('avatars.name', 'avatars.pic', 'avatars.price')
        ->get();

    return view('my_avatars', compact('boughtAvatars'));
}
}
