@extends('layouts.app')

@section('content')
<div class="container">
   <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')

    <div class="row">
        <div class="col-8 offset-2">


            <div class="d-flex justify-content-center" >
                <h1>Edit Profile</h1>
            </div>
            <br>

            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" 
                        class="form-control @error('title') is-invalid @enderror" 
                        name="title"
                        title="title" 
                        value="{{ old('title') ?? $user->profile->title}}" 
                        required autocomplete="title" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
                        <input id="description" type="text" 
                        class="form-control @error('description') is-invalid @enderror" 
                        name="description"
                        description="description"  
                        value="{{ old('description') ?? $user->profile->description }}" 
                        required autocomplete="description" autofocus>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
            </div>
            <div class="form-group row">
                <label for="others" class="col-md-4 col-form-label text-md-right">Others</label>

                    <div class="col-md-6">
                        <input id="others" type="text" 
                        class="form-control @error('others') is-invalid @enderror" 
                        name="others"
                        others="others" 
                        value="{{ old('others') ?? $user->profile->others}}" 
                        required autocomplete="others" autofocus>

                            @error('others')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
            </div>
           
            <div class="row">
                <label for="image" class="col-md-4 col-form-label text-md-right">Profile Image</label>
                <div class="col-md-6">
                <input type="file", class="form-control-file" id="image" name="image">

                @error('image')
                {{-- <span class="invalid-feedback" role="alert"> --}}
                    <strong>{{ $message }}</strong>
                {{-- </span> --}}
                @enderror
                </div>
            </div>


                <div class="row pt-4">
                <label for="submit" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-6">
                    <button class="btn btn-primary">Save Profile</button>
                </div>
        </div>
      </div>
    </form>
</div>
@endsection
