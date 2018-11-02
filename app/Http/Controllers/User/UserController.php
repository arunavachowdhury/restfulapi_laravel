<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Mail;


class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return $this->ShowAll($user);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = [
            'name'=> 'required',
            'email'=> 'required|unique:users',
            'password'=> 'required|min:6|confirmed' 
        ];
        $this->validate($request,$validatedData);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'varified' => User::UNVARIFIED_USER,
            'varification_token' => User::generateVerificationToken(),
            'admin' => User::REGULER_USER 
        ]);
        return $this->ShowOne($user);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->ShowOne($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validatedData = [
            'email'=> 'unique:users,email,' . $user->id,
            'password'=> 'min:6|confirmed', 
            'admin' => 'in:' . User::REGULER_USER . ', ' . User::ADMIN_USER
        ];
        $this->validate($request, $validatedData);

        if($request->has('name')){
            $user->name = $request->name;
        }
        if($request->has('email') && $user->email != $request->id){
            $user->email = $request->email;
            $user->varified = User::UNVARIFIED_USER;
            $user->varification_token = User::generateVerificationToken();
        }
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
        if($request->has('admin')){
            if(!$user->isVarified()){
               return $this->Error('User must be varified to change admin field',409);
            }
            $user->admin = $request->admin;
        }
        if(!$user->isDirty()) {
            return $this->Error('You need to specify a different value to update', 422);
        }
        $user->save();
        return $this->ShowOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->ShowOne($user); 
    }
}
