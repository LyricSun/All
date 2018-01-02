<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user = User::withCount(['posts','fans','stars'])->find($user->id);
        $posts = $user->posts;
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['posts','fans','stars'])->get();
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['posts','fans','stars'])->get();
        return view('user.show',compact('user','posts','fusers','susers'));
    }

    public function fan(User $user)
    {
        $current_user = \Auth::user();
        $current_user->doFan($user->id);
        return[
            'code' => 1
        ];
    }

    public function unfan(User $user)
    {
        $current_user = \Auth::user();
        $current_user->doUnFan($user->id);
        return[
            'code' => -1
        ];
    }
}
