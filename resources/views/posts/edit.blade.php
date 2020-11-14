@extends('layouts.app')

@section('content')
<div class="container">
   <form action="/p/{{ $post->id }}" enctype="multipart/form-data" method="post">
    @csrf
     {{-- Patch Medthod for update --}}
    @method('PATCH')

    <div class="row">
        <div class="col-8 offset-2">


            <div class="d-flex justify-content-center" >
                <h1>Edit Food Item</h1>
            </div>
            <br>
             {{-- Input for Food Name with error check--}}
            <div class="form-group row">
                <label for="foodname" class="col-md-4 col-form-label text-md-right">Food Name</label>
                    <div class="col-md-6">
                        <input id="foodname" type="text" 
                        class="form-control @error('foodname') is-invalid @enderror" 
                        name="foodname"
                        foodname="foodname" 
                        value="{{ old('foodname') ?? $post->foodname}}" 
                        required autocomplete="foodname" autofocus>

                            @error('foodname')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
            </div>
             {{-- Input for Food Description with error check--}}
            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
                        <input id="description" type="text" 
                        class="form-control @error('description') is-invalid @enderror" 
                        name="description"
                        description="description"  
                        value="{{ old('description') ?? $post->description }}" 
                        required autocomplete="description" autofocus>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
            </div>
             {{-- Option for Food Cuisine with error check--}}
            <div class="form-group row">
                <label for="cuisine" class="col-md-4 col-form-label text-md-right ">Food Cuisine</label>
                     <div class="pl-3"  >
                    <select class="col-md-10 form-control" input id="cuisine" class="form-control @error('cuisine') is-invalid @enderror" 
                        name="cuisine"
                        cuisine="cuisine" 
                        value="{{ old('cuisine') ?? $post->cuisine }}" 
                        required autocomplete="cuisine" autofocus>
                        <option>Chinese</option>
                        <option>Malay</option>
                        <option>Indian</option>
                        <option>Western</option>
                        <option>Perankan</option>
                        <option>Korean</option>
                        <option>Japanese</option>
                        <option>Italian</option>
                        <option>Middle Eastern</option>
                        <option>Others</option>
                    </select>
                    </div>
                            @error('cuisine')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
             {{-- Input for Food Cost with error check--}}
            <div class="form-group row">
                <label for="cost" class="col-md-4 col-form-label text-md-right">Food Cost</label>
                    <div class="col-md-6">
                        <input id="cost" type="interger" 
                        class="form-control @error('cost') is-invalid @enderror" 
                        name="cost"
                        cost="cost" value="{{ old('cost') ?? $post->cost }}" 
                        required autocomplete="cost" 
                        autofocus>

                            @error('cost')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
            </div>
             {{-- Input for Food Quantity with error check--}}
            <div class="form-group row">
                <label for="qty" class="col-md-4 col-form-label text-md-right">Food Quantity</label>
                    <div class="col-md-6">
                        <input id="qty" type="interger" 
                        class="form-control @error('qty') is-invalid @enderror" 
                        name="qty"
                        qty="qty" value="{{ old('qty') ?? $post->qty }}" 
                        required autocomplete="qty" 
                        autofocus>

                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
            </div>
            {{-- Input for Food Picture with error check--}}
            <div class="row">
                <label for="image" class="col-md-4 col-form-label text-md-right">Food Picture</label>
                <div class="col-md-6">
                <input type="file", class="form-control-file" id="image" name="image">

                @error('image')
                {{-- <span class="invalid-feedback" role="alert"> --}}
                    <strong>{{ $message }}</strong>
                {{-- </span> --}}
                @enderror
                </div>
            </div>

             {{-- Save Changes --}}
                <div class="row pt-4">
                <label for="submit" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-6">
                    <button class="btn btn-primary">Save Edited Item</button>
                </div>
        </div>
      </div>
    </form>
</div>
@endsection
