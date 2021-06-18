@extends('layouts.app')

@section('content')
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
    <div class="row">
 
        @foreach($users as $user )
            <div class="col-md-3 mt-2 mb-2">
                <div class="card">

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-2 ">
                                <img style="height:75px;width:75px;" src="{{asset($user->user_image)}}" alt="User profile" class="rounded-circle"/>
                            </div>
                            <div class="col-md-9 offset-md-1">
                                <p><em>{{$user->first_name  }} </em> </p> 
    
                                <p><strong>{{$user->last_name  }}</strong></p> 
                                
                            </div>
                            
                        </div>

                        <div class="form-group row card-footer">
                            <div class="col-md-9">
                                    <a href="{{ route('users.profile', $user->id) }}" class="btn btn-info">  <i class="fas fa-eye"></i> </a> <a href="{{ route('users.edit-user', $user->id) }}" class="btn btn-primary"> <i class="fas fa-edit"></i></a>
                            </div>

                            <div class="col-md-3">

                                <form action="{{ route('users.delete-user', $user->id)}}" method="post">
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
            {{$users->links()  }}
    </div>
@endsection
