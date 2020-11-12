@extends('layouts.app')

@section('content')

    <div class="container">

    
        @foreach($post as $posts)
            <div class="row pb-5" >
                <div class="col-2">
                    <a href="/p/{{ $posts->id }}">
                        <img src="/storage/{{ $posts->image }}" class="w-100">
                    </a>
                </div>

                <div class="col-3">
                    
                    <h5>{{ $posts->foodname }}</h5>
                    <h6>Cost : ${{ $posts->cost }}</h6>
                   {{-- <h6>{{ $posts->description }}</h6>
                     <h6>{{ $posts->cuisine }}</h6>
                     <h6>Cost : ${{ $posts->cost }}</h6> 
                    <h6>Serves : {{ $posts->qty }}Pax</h6> --}}
                    <h6>By : </h6>
                    <div class="d-flex align-items-center" >
                        <div class="pr-3">
                            <img src="{{ $posts->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 75px;">
                        </div>
                        <div>
                            <h6><a href="/profile/{{ $posts->user->id }}">
                            <span class="text-dark">{{ $posts->user->username }}</span></a></h6>
                           
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $post->links() }}
                </div>
            </div>

    </div>
@endsection