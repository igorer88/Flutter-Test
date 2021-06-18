<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Shared\UsersMasterController;
use Illuminate\Http\Request;
use App\User;

use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    protected $masterController;

    public function __construct()
    {
        $this->masterController=new UsersMasterController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.users')->with('users', $this->masterController->index());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return redirect()->route('users.users')->with('message', $this->masterController->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        return view('users.profile')->with('user', $this->masterController->show($user));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function posts($user)
    {
        return view('posts.posts')->with('posts', $this->masterController->posts($user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user=User::findOrfail($user);
        
        return view('users.edit_user')->with('user', $user);
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
        return redirect()->route('users.users')->with('message', $this->masterController->update($request,$user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        return redirect()->route('users.users')->with('message', $this->masterController->destroy($user));
    }
}
