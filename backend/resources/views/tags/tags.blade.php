@extends('layouts.app')

@section('content')
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
    <div class="row">
 
        @foreach($tags as $tag )
            <div class="col-md-3 mt-2 mb-2">
                <div class="card">

                    <div class="card-header">
                            <h5>{{$tag->title  }}</h5>
                    </div>
                    <div class="card-footer" >

                            <div class="form-group row">
                                    <div class="col-md-9">
                                            <a href="{{ route('tags.tag', $tag->id) }}" class="btn btn-info">  <i class="fas fa-eye"></i> </a> <a href="{{ route('tags.edit-tag', $tag->id) }}" class="btn btn-primary"> <i class="fas fa-edit"></i></a>
                                    </div>

                                    <div class="col-md-3">

                                        <form action="{{ route('tags.delete-tag', $tag->id)}}" method="post">
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
            {{$tags->links()  }}
    </div>
@endsection
