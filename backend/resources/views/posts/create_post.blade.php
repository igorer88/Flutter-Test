@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register Post') }}</div>

                <div class="card-body">
                    <form method="POST"   action="{{ route('posts.save-post') }} " enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label ">{{ __('Title') }}</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus placeholder="Post title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-2 col-form-label ">{{ __('Content') }}</label>
    
                            <div class="col-md-10">
                                {{-- <input id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" required autocomplete="content" autofocus> --}}
                                <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" required autocomplete="content" autofocus>Post content</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="category_id" class="col-md-2 col-form-label ">{{ __('Category') }}</label>
    
                            <div class="col-md-10">
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option selected>Select category of post</option> 
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>  
                                    @endforeach  
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="post_tags" class="col-md-2 col-form-label ">{{ __('Post tags') }}</label>
        
                            <div class="col-md-10">
                                <select class="form-control" id="post_tags" name="post_tags[]" multiple  required>
                                    <option selected value="">Select tags of post</option> 
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>  
                                    @endforeach  
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_id" class="col-md-2 col-form-label ">{{ __('Images post') }}</label>
    
                            <div class="col-md-10">
                                <input id="image_id" type="file" class="form-control @error('image_id') is-invalid @enderror" name="image_id[]" value="{{ old('image_id') }}" required autocomplete="image_id" autofocus placeholder="Post images" multiple>
    
                                @error('image_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add post') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
