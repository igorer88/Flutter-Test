@extends('layouts.app')

@section('content')
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<div class="row">

    @foreach($categories as $category )
    <div class="col-md-3 mt-2 mb-2">
        <div class="card">

            <div class="card-header">
                <h5>{{$category->title }}</h5>
            </div>

            <div class="card-body" style="background-color:{{ $category->color }};">
            </div>
            <div class="card-footer">

                <div class="form-group row">
                    <div class="col-md-9">
                        <a href="{{ route('categories.category', $category->id) }}" class="btn btn-info"> <i class="fas fa-eye"></i> </a> <a href="{{ route('categories.edit-category', $category->id) }}" class="btn btn-primary"> <i class="fas fa-edit"></i></a>
                    </div>

                    <div class="col-md-3">

                        <form action="{{ route('categories.delete-category', $category->id)}}" method="post">
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
    {{$categories->links() }}
</div>
@endsection

{{-- @foreach ($categories as $category )
                       <ul>
                            <li style="color:{{ $category->color }}">
<div class="form-group row mb-0">

    <div class="col-md-3 ">
        {{ $category->id }} {{ $category->title }}
    </div>

    <div class="col-md-4 offset-md-2">
        <a href="{{ route('categories.category', $category->id) }}" class="btn btn-info"> View <i class="fas fa-eye"></i> </a> <a href="{{ route('categories.edit-category', $category->id) }}" class="btn btn-primary">Edit <i class="fas fa-edit"></i></a>
    </div>

    <div class="col-md-3">

        <form action="{{ route('categories.delete-category', $category->id)}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">
                Delete <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </form>

    </div>
</div>
</li>
</ul>
@endforeach --}}