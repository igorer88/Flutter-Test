@extends('layouts.app')

@section('content')
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
    <div class="row">
 
        @foreach($comments as $comment )
            <div class="col-md-4 mt-2 mb-2">
                <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <img style="height:70px;width:70px;" src="{{$comment->author->avatar}}" alt="User profile" class="rounded-circle"/>
                                </div>
                                <div class="col-md-9">
                                    
                                    <p class="card-title"><strong>{{$comment->author->first_name  }}</strong></p> 
        
                                    <p class="card-text"><i><strong>{{$comment->content  }}</strong></i></p> 
                                    
                                </div>
                            </div>
                        </div>
                    <div class="card-footer" >

                            <div class="form-group row">
                                    <div class="col-md-9">
                                            <a href="{{ $comment->post->link() }}" class="btn btn-info">  Go to the post</a>
                                    </div>

                                    <div class="col-md-3">

                                        <form action="{{ route('comments.delete-comment', $comment->id)}}" method="post">
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
            {{$comments->links()  }}
    </div>
@endsection
