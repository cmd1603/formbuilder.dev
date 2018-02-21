<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
use App\Distributor;
use App\Salesforce_Product_Code;
use App\User;
use App\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Storage;

class PagesController extends Controller
{
    public function adminPage()
    {
        $users = User::all();
        return view('auth.admin', ['users' => $users]);
    }

    public function postAdminAssignRoles(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        if($request['role_user']) {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if($request['role_admin']){
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect()->back();
    }

	public function dev()
	{
		return view('dev');
	}

	public function latest() 
    {
		return view('latest');
	}

    public function creater()
    {
        return view('auth.creater');
    }

    public function cutting_technologies()
    {
        return view('auth.cutting_technologies');
    }    	

    public function router(Request $request)
    {
    	$configurations = Configuration::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('auth.router')->with('configurations', $configurations);
    } 

    public function fabrication(Request $request)
    {
    	$configurations = Configuration::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('auth.fabrication')->with('configurations', $configurations);
    }       

    public function digital_finishing(Request $request)
    {
    	$configurations = Configuration::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('auth.digital_finishing')->with('configurations', $configurations);
    }  

}