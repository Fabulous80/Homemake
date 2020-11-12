@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-6">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
 
        <div class="col-6">
            
            <h3>{{ $post->foodname }}</h3> 
            <br>
            <p>{{ $post->description }}</p>
            <p>{{ $post->cuisine }}</p>
            <p>Cost : ${{ $post->cost }}</p>
            <p>Serves : {{ $post->qty }}Pax</p>
            <p>By :</p>
            <br>
            
            <div class="d-flex align-items-center" >
                <div class="pr-3">
                    <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 100px;">
                </div>
                <div>
                    <h5><a href="/profile/{{ $post->user->id }}">
                    <span class="text-dark">{{ $post->user->username }}</span></a></h5>
                </div>
            </div>
            <p>
                <br>
                
                 @can('update', $post)
                 <a href="/p/{{ $post->id }}/edit"> Edit Food Item </a>
                 @endcan
            </p>
        </div>
   
    </div>
</div>
@endsection