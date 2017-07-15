<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\User;

class UserController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function about()
    {
    	return view('about');
    }

    public function login()
    {
    	// show the form
    	if(Auth::check())
    		return redirect()->route('auth.dashboard');
    	return view('auth.login');
    }

    public function do_login()
    {
    	$rules = array('name' => 'required', 'email' => 'required|email', 'password' => 'required');
    	$validator = Validator::make(Input::all(), $rules);
    	if($validator->fails())
    	{
    		return  redirect()->route('auth.login')
			->withErrors($validator,'login') // send back all errors to the login form
			->withInput(Input::except('password')); 
    	}
    	else
    	{
    		//Create our user data for the authentication
    		$userdata = array(
    							'email' => Input::get('email'),
    							'password' => Input::get('password')
							 );
    		if (Auth::attempt($userdata))
    		{
    			return redirect()->intended('dashboard');
    		}
    		else
    		{
    			$login_error = 'Invalid Username or Password';
    			return redirect()->route('auth.login')
    			->withErrors(['message' => $login_error ], 'login');
    		}
    	}
    }

    public function dashboard()
    {
        return view('auth.dashboard');
    }

    public function creater()
    {
        return view('auth.creater');
    }

    public function logout()
    {
    	Auth::logout(); // log the user out of our application
    	return redirect()->route('auth.login');
    }

    public function order_forms()
    {
        return view('auth.order_forms');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $logged_in_user = Auth::user();
        $user = $this->findUserOr404($id);
        $configurations = $user->configurations;
        return view('users.account')->with(['logged_in_user' => $logged_in_user, 'configurations' => $configurations, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        $user = Auth::user();
        return view('users.edit')->with('user', $user);
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
        $user = $this->findUserOr404($id);
        return $this->validateAndSave($user, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->findUserOr404($id);
        $user->delete();
        session()->flash('success_message', 'User deleted successfully.');
        return redirect()->action('auth.login');
    }

    private function validateAndSave(User $user, Request $request) 
    {
        $request->session()->flash('error_message', 'User not saved successfully.');
        $request->session()->forget('error_message');
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        session()->flash('success_message', 'User saved successfully.');
        return redirect()->action('UserController@show', ['id' => $user->id]);
    }

    private function findUserOr404($id) 
    {
        $user = User::find($id);
        if (!$user) {
            Log::info("User with ID $id cannot be found.");
            abort(404);
        }
        return $user;
    }
}

