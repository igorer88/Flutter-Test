@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h3>Tag</h3></div>

                <div class="card-body">
                        <li style="color:red">{{ $tag->title }}</li>
                </div>

            </div>
        </div>
    </div>


    <hr>
    <div class="row mb-0 justify-content-center ">
    
            <div class="col-md-6">
                <a href="{{ route('tags.tags') }}" class="btn btn-info">Back to all tags  <i class="fas fa-sign-in-alt"></i> </a> <a href="{{ route('tags.edit-tag', $tag->id) }}" class="btn btn-primary">Edit <i class="fas fa-edit"></i></a> 
            </div>
                
            <div class="col-md-4 ">
                        
                <form action="{{ route('tags.delete-tag', $tag->id)}}" method="post">
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
