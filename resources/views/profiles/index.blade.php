@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
         <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
    
        <div class="col-9 pt-5">

            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <h2>{{$user->username}}</h2>

                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
            @can('update', $user->profile)
            <a class="btn btn-primary" href="/p/create" role="button">Add New Food Item </a>
            @endcan

        </div>

             @can('update', $user->profile)
             <a href="/profile/{{ $user->id }}/edit"> Edit Profile </a>
             @endcan

            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postCount }}</strong> items</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>

            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div> {{ $user->profile->others ??'N/A' }}</div>
        </div>

        {{-- <div class="row pt-5">

            @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>       
            @endforeach


        </div> --}}

        <div class="row">
                @foreach($user->posts as $post) 
                    <div class="card col-md-4 pb-3">
                        <div class="card  bg-light" >
                                <a href="/p/{{ $post->id }}">
                                <img class="card-img-top"  src="/storage/{{ $post->image }}" alt="Card image cap">
                                </a>
                                        <div class="card-body">
                                            <h5 class="card-title"><b>{{ $post->foodname }}</b></h5>
                                            <p class="card-text">{{ $post->description }}</p>
                                            <p class="card-text">Cost    : ${{ $post->cost }}</p>
                                            <p class="card-text">Cuisine : {{ $post->cuisine }}</p>
                                            <p class="card-text">Serves  : {{ $post->qty }} Pax</p>    
                                        </div>
                        </div>
                    </div> 
                 @endforeach
            </div>

    </div>
</div>
@endsection
