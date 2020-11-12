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

    

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $post = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

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

    public function show(\App\Models\Post $post)
    {
        
        return view('posts.show', compact('post'));

    }

   

    public function edit(Post $post)
    {
        $this->authorize('update',$post);
        return view('posts.edit', compact('post'));
    }

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

        

        if (request('image')){

            $imagePath = request('image')->store('profile','public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagePath];

        }
      

        auth::user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/p/{$post->id}");

    } 

}



