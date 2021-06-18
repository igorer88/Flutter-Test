@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-6 p-4">
                        <div class="col-md-2">
                            <img style="height:100px;width:100px;" src="{{asset($user->user_image)}}" alt="User profile" class="rounded-circle"/>
                        </div>
                        <div class="col-md-9 offset-md-1">
                            <p><strong>{{$user->first_name  }} </strong> </p> 

                            <p><strong>{{$user->last_name  }}</strong></p>
                            <p><em>{{$user->email  }}</em></p> 
                            <p><em>{{ucfirst($user->user_type)}}</em></p> 
                            <p><a href="{{ route('users.posts', $user->id) }}" class="btn btn-primary">Edit <i class="fas fa-edit"></i></a> <p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <hr>
    <div class="row mb-0 justify-content-center ">
    
            <div class="col-md-6">
                <a href="{{ route('users.users') }}" class="btn btn-info">Back to all users  <i class="fas fa-sign-in-alt"></i> </a> <a href="{{ route('users.edit-user', $user->id) }}" class="btn btn-primary">Edit <i class="fas fa-edit"></i></a> 
            </div>
                
            <div class="col-md-4 ">
                        
                <form action="{{ route('users.delete-user', $user->id)}}" method="post">
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
