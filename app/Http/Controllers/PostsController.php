<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    
    // function to filter http
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    // return lastest post where user is following
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
       
        $post = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(6);
           
        
        return view('posts.index', compact('post'));
    }
    // create post
    public function create()
    {
        return view('posts.create');
    }

    // function for storing new post
    public function store(Request $request)
    {
        $data = $request->validate([
            'foodname' => 'required',
            'description' => 'required',
            'cuisine' => 'required',
            'cost' => 'required',
            'qty' => 'required',
            'image' => ['required','image'],
         ]);

        $imagePath = request('image')->store('uploads','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth::user()->posts()->create([
            
            'foodname' => $data['foodname'],
            'description' => $data['description'],
            'cuisine' => $data['cuisine'],
            'cost' => $data['cost'],
            'qty' => $data['qty'],
            'image' => $imagePath,
        ]);

       return redirect('/profile/' . auth::user()->id);
    }

    // show post function
    public function show(\App\Models\Post $post)
    {
        
        return view('posts.show', compact('post'));

    }

      //function to edit user->post , update will check for user ID and return a boolean.
    //authorize will then allow then allow user->id that correspond with post->user_id to edit post
    public function edit(Post $post)
    {
      
        $this->authorize('update',$post);
     
        return view('posts.edit', compact('post'));
    }
    // same as above. once profile policy check completed, allow user to update the post

    public function update(Post $post)
    {
    
            
        $this->authorize('update',$post);
        $data = request()->validate([
            'foodname' => '',
            'description' => '',
            'cuisine' => '',
            'cost' => '',
            'qty' => '',
            'image' =>'',
        ]);
        

         // to update image in $imagepath if image in $data contains new update
        if (request('image')){

                    $imagePath = request('image')->store('uploads','public');
                    $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
                    $image->save();
                    $imageArray = ['image' => $imagePath];      
            }
           
            // to merge the $imagepath into the data array
            $nData = array_merge(
          
                $data,
                $imageArray ?? []
            );

            
            //update the edited data into post
            $post->update($nData);

            

       
        return redirect("/p/{$post->id}");

    } 

    //delete function
    public function destroy(Post $post){

        $this->authorize('update',$post);
        $post->delete();
        return redirect("profile/{$post->user->id}");

    }

}



