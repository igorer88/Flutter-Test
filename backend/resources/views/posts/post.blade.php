@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $post->title }}</h3>
                    <p>{{ $post->content }}</p>
                </div>

            </div>
            <div class="row">
                @foreach ($post->tags as $tag)
                <div>
                    <div class="card ml-2 mt-2 p-2">
                        <p class="card-text">{{ $tag->title  }}</p>
                    </div>

                </div>

                @endforeach
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Commentaires {{ $post->comments->count() }} </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 ">
                            <img style="height:65px;width:65px;" src="{{$post->author->avatar}}" alt="User profile" class="rounded-circle">
                        </div>
                        <div class="col-md-10">
                            <form method="POST" action="{{ route('posts.do-comment',$post->id) }} ">
                                @csrf
                                <div class="form-group row">

                                    <div class="col-md-9">
                                        {{-- <input id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" required autocomplete="content" autofocus> --}}
                                        <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" rows="1" required autocomplete="content" autofocus>write your comment</textarea>
                                        @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Comment') }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @foreach ($post->comments as $comment)
                    <div class="row mb-4">
                        <div class="col-md-2 ">
                            <img style="height:70px;width:70px;" src="{{$comment->author->avatar}}" alt="User profile" class="rounded-circle" />
                        </div>
                        <div class="col-md-9">
                            <p><em>{{$comment->author->first_name .' . ' }} {{$comment->updated_at->diffForHumans() }}</em> </p>

                            <p><strong>{{$comment->content }}</strong></p>
                            <form action="{{ route('posts.delete-comment', [$post->id,$comment->id])}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

        </div>
        <div class="col-md-4">
            @foreach($post->images as $image )
            <img class="img-thumbnail rounded-left mb-2 " {{-- width=50px height="50px" --}} src="{{asset($image->image_url)}}" alt="Post image" />
            @endforeach

            @foreach($post->videos as $video )
            <img class="img-thumbnail rounded-left" src="{{$video->url}}" alt="Post image" />
            @endforeach
        </div>
    </div>


    <hr>
    <div class="row mb-0 justify-content-center ">

        <div class="col-md-6">
            <a href="{{ route('posts.posts') }}" class="btn btn-info">Back to all posts <i class="fas fa-sign-in-alt"></i> </a> <a href="{{ route('posts.edit-post', $post->id) }}" class="btn btn-primary">Edit <i class="fas fa-edit"></i></a>
        </div>

        <div class="col-md-4 ">

            <form action="{{ route('posts.delete-post', $post->id)}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">
                    Delete <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>

        </div>
    </div>
</div>


@endsection