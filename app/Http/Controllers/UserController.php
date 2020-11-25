<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\JSONResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return $this->sendResponse($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'title' => 'required|min:3',
            // 'description' => 'required',
        ]);   
        $user = User::create(['name' => $request->name,'email' => $request->email, 'experience' => $request->experience]);
        return redirect('/user/'.$user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show',compact('user',$user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit',compact('user',$user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $request->session()->flash('message', 'Successfully deleted the user!');
        return redirect('user');
    }

    public function sendResponse ($data, $statusCode=200, $message='Success', $errors=[]){
		$updatedData = !is_array($data) ? $data->toArray() : $data;
		$updatedData = $this->updateNullValueWithEmptyValue($updatedData);
		$jsonResponse = new JSONResponse();
		$jsonResponse->setStatusCode($statusCode);
		$jsonResponse->setMessage($message);
		$jsonResponse->setData($updatedData);
		$jsonResponse->setErrors($errors);
		return $jsonResponse->output();
    }
    
    public function updateNullValueWithEmptyValue($array) {
		array_walk_recursive($array, "self::replaceNullValueWithEmptyString");
		return $array;
	}
}
