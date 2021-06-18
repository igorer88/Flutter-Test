<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\UserRequest;
use App\Http\Resources\Post\PostResource;
use App\Modele\Post;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function posts($id)
    {
        return PostResource::collection(User::findOrfail($id)->posts()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
      //  User::create($request->all());
        $user =new User;
        $user->last_name= $request->last_name;
        $user->first_name= $request->first_name;
        $user->email= $request->email;
        $user->user_type= $request->user_type;
        $user->password= Hash::make($request->password);
        
        if($request->hasFile('avatar')){
            foreach ($request->file('avatar') as $key => $image) {
                $path=$image->store('avatar');
                $user->avatar=$path; 
            }
        }

        $user->save();

        return 'User created!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        return new UserResource(User::findOrfail($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $user)
    {
        $user=User::findOrfail($user);
        $user->update($request->all());
        return 'User updated!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user=User::findOrfail($user);
              
        $posts=Post::where('author_id',$user->id)->get() ;
     
        foreach ($posts as $key => $value) {
            $value->delete();
        }
        $user->delete();
        return 'User deleted';
    }
}
