@extends('layouts.app')

@section('content')
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<div class="row">
    @foreach($posts as $post)
    <div class="col-md-3 mt-2 mb-2">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-3 ">
                        <img style="height:65px;width:65px;" src="{{asset($post->author->user_image)}}" alt="User profile" class="rounded-circle">
                    </div>
                    <div class="col-md-9">
                        <p>{{$post->author->first_name }}</p>
                        <p>{{$post->author->last_name }}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-text">{{$post->title}}</h5>
                <p class="card-text">{{$post->excerpt}}</p>
            </div>
            <div class="card-footer">
                <div class="form-group row">
                    <div class="col-md-9">
                        <a href="{{ route('posts.post', $post->id) }}" class="btn btn-secondary">
                            <i class="fas fa-eye"></i>
                            Read Me
                        </a>
                        <a href="{{ route('posts.edit-post', $post->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>

                    <div class="col-md-3">

                        <form action="{{ route('posts.delete-post', $post->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
    @endforeach
</div>
<div class="col-md-12">
    {{$posts->links() }}
</div>
@endsection
