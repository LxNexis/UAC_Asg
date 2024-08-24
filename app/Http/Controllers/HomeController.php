<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $userId = auth()->id();

        // Get IDs from the 'friends' table

        if(auth()->check()){
            $friendIds = DB::table('friends')
        ->where('user1_id', $userId)
        ->orWhere('user2_id', $userId)
        ->pluck('user1_id') // Get all user1_id values
        ->merge(
            DB::table('friends')
                ->where('user1_id', $userId)
                ->orWhere('user2_id', $userId)
                ->pluck('user2_id') // Get all user2_id values
        );

        // Get IDs from the 'pendings' table
        $pendingIds = DB::table('pendings')
        ->where('userSrc_id', $userId)
        ->orWhere('userDst_id', $userId)
        ->pluck('userSrc_id') // Get all userSrc_id values
        ->merge(
            DB::table('pendings')
                ->where('userSrc_id', $userId)
                ->orWhere('userDst_id', $userId)
                ->pluck('userDst_id') // Get all userDst_id values
        );

        // Combine all IDs and include the current user ID
        $excludedIds = $friendIds
        ->merge($pendingIds)
        ->merge([$userId])
        ->unique()
        ->toArray();
        
        // dd($excludedIds);
        // Query to get users who are not friends or pending with the authenticated user
        $users = DB::table('users')
            ->whereNotIn('users.id', $excludedIds)
            ->leftJoin('user_interests', 'users.id', '=', 'user_interests.user_id')
            ->leftJoin('interests', 'user_interests.interest_id', '=', 'interests.id')
            ->select('users.id', 'users.name', 'users.email', 'interests.name as interest_name', 'profile_pic')
            ->get()
            ->groupBy('id');
        } else{
            $users = User::leftJoin('user_interests', 'users.id', '=', 'user_interests.user_id')
                    ->leftJoin('interests', 'user_interests.interest_id', '=', 'interests.id')
                    ->select('users.id', 'users.name', 'users.email', 'interests.name as interest_name', 'profile_pic')
                    ->get()
                    ->groupBy('id');;
        }
        

        // dd($users);

        return view('home', compact('users'));
    }
}
