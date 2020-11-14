@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-12 d-flex justify-content-center pb-5">
                 <h1>Welcome to Homemake </h1>

        </div>
            <div class="row">
                @foreach($post as $posts)  
                    <div class="card col-md-4 pb-3">
                        <div class="card  bg-light" >
                                <a href="/p/{{ $posts->id }}">
                                <img class="card-img-top"  src="/storage/{{ $posts->image }}" alt="Card image cap">
                                </a>
                                        <div class="card-body">
                                            <h5 class="card-title"><b>{{ $posts->foodname }}</b></h5>
                                            <p class="card-text">{{ $posts->description }}</p>
                                            <p class="card-text">Cost    : ${{ $posts->cost }}</p>
                                            <p class="card-text">Cuisine : {{ $posts->cuisine }}</p>
                                            <p class="card-text">Serves  : {{ $posts->qty }} Pax</p>    
                                        </div>
                                <div class="card-footer">
                                    <div class="d-flex align-items-center" >
                                            <div class="pr-3">
                                                <img src="{{ $posts->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 50px;">
                                            </div>
                                            <div>
                                            <h5><a href="/profile/{{ $posts->user->id }}">
                                            <span class="text-dark">{{ $posts->user->username }}</span></a></h5>        
                                            </div>
                                    </div>
                                </div>
                        </div>
                    </div> 
                 @endforeach
            </div>
            
                    
    
            <div class="row pt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $post->links() }}
                </div>
            </div> 

    </div>
@endsection