@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>

                <div class="card-body">
                    <form method="POST"   action="{{ route('users.update-user', $user->id) }} ">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="last_name" class="col-md-2 col-form-label ">{{ __('Last name') }}</label>

                            <div class="col-md-10">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name" autofocus placeholder="Enter your last name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-2 col-form-label ">{{ __('First name') }}</label>

                            <div class="col-md-10">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="first_name" autofocus placeholder="Enter your first name">

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                       
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus placeholder="Enter your email adress">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-left">{{ __('Password') }}</label>

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-2 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-md-2 col-form-label ">{{ __('User avatar') }}</label>
    
                            <div class="col-md-10">
                                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ $user->avatar }}"  autocomplete="avatar" autofocus placeholder="Avatar">
    
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_type" class="col-md-2 col-form-label ">{{ __('User type') }}</label>
    
                            <div class="col-md-10">
                                <select class="form-control" id="user_type" name="user_type" required>
                                    <option >Select user type</option> 
                                    @if ($user->user_type='user')
                                        <option value="user" selected>User</option>
                                    @endif
                                    @if ($user->user_type='author')
                                        <option value="author" selected>Author</option>
                                    @endif
                                    @if ($user->user_type='admin')
                                        <option value="admin" selected>Admin</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                        {{ __('Back') }}  <i class="fas fa-sign-in-alt"></i> 
                                </button>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}  <i class="fas fa-edit"></i>
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
