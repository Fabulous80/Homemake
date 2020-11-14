<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    
    public function index(User $user)
    {
        // return data array on who the user is following
        $follows = auth()->user() ? auth()->user()->following->contains($user->id) : false;

        // cache function to reduce resources to reuse the counts if user refresh page in under 30 seconds
        $postCount = Cache::remember(
            'count.posts.'.$user->id, 
            now()->addSeconds(30), 
            function () use ($user) {
            return $user->posts->count();
        });

        $followersCount = Cache::remember(
            'count.followers.'.$user->id, 
            now()->addSeconds(30), 
            function () use ($user) {
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember(
            'count.following.'.$user->id, 
            now()->addSeconds(30), 
            function () use ($user) {
            return $user->following->count();
        });

    

        return view('profiles.index', compact('user','follows','postCount','followersCount','followingCount'));
    }


    //function to edit user->profile , update will check for user ID and return a boolean.
    //authorize will then allow then allow user->id that correspond with profile->user_id to edit profile

    public function edit(User $user)
    {
        $this->authorize('update',$user->profile);
        return view('profiles.edit', compact('user'));
    }

    // same as above. once profile policy check completed, allow user to update the profile
    public function update(User $user)
    {
        $this->authorize('update',$user->profile);

        $data = request()->validate([
            'title' => '',
            'description' => '',
            'others' => '',
            'image' =>'',

        ]);

        
        // to update image in $imagepath if image in $data contains new update
        if (request('image')){

            $imagePath = request('image')->store('profile','public');

            //
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagePath];

        }
      
                // to merge the $imagepath into the data array
                auth::user()->profile->update(array_merge(
                    $data,
                    $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");

    } 

}
