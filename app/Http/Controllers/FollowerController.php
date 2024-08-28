<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    //FOLLOW
    public function follow(User $user){
        $follower = auth()->user();

        //relationship
        $follower->followings()->attach($user);

        return redirect()->route('users.show', $user->id)->with('success', "Followed Successfully!");
    }

    //UNFOLLOW
    public function unfollow(User $user){
        $follower = auth()->user();

        //relationship
        $follower->followings()->detach($user);

        return redirect()->route('users.show', $user->id)->with('success', "unfollow Successfully!");
    }
}
