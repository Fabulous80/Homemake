<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class FollowsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(User $user)
    {   

        //to store data of following
        
        return auth()->user()->following()->toggle($user->profile);

    }
}
