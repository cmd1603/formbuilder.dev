<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Storage;

class ConfigurationsController extends Controller
{
    public $page_title = "All Configurations";
    public function __construct()
    {
    	$this->middleware('auth', ['except' => ['index', 'newest', 'show']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index(Request $request)
	{
		$configurations = Configuration::with('user')->orderBy('updated_at', 'desc')->paginate(10);
		if (Auth::user()->id == 4) {
			return view('configurations.index')->with('configurations', $configurations);
		} else {
			return redirect('/');
		}	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */	

	public function create()
	{
		return view('configurations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$configuration = new Configuration();
		$configuration->created_by = Auth::id();
		Log::info($request->all());
		return $this->validateAndSave($configuration, $request);
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function show(Request $request, $id)
	{
		$configuration = Configuration::with('user')->findOrFail($id);
		return view('configurations.show')->with('configuration', $configuration);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */	

	public function edit($id)
	{
		$configuration = Configuration::findOrFail($id);
		return view('configurations.edit')->with('configuration', $configuration);

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
		$configuration = Configuration::findOrFail($id);
		return $this->validateAndSave($configuration, $request);

	}

	/**
 	 * Remove the specified resource from storage.
 	 *
 	 * @param  int  $id
 	 * @return \Illuminate\Http\Response
 	 */

	public function deactivate($id)
	{
		$configuration = Configuration::findOrFail($id);
		$configuration->active = "0";
		$configuration->update();
		session()->flash('success_message', 'Configuration deactivated successfully.');
		return redirect()->action('UserController@show', ['user_id' => $configuration->user->id]);
	}

	public function destroy($id)
	{
		$configuration = Configuration::findOrFail($id);
		$configuration->delete();
		session()->flash('success_message', 'Configuration deleted successfully.');
		return redirect()->action('UserController@show', ['user_id' => $configuration->user->id]);
	}

	private function validateAndSave(Configuration $configuration, Request $request)
	{
		$request->session()->flash('error_message', 'Configuration was not saved successfully.');
		$this->validate($request, Configuration::$rules);
		$request->session()->forget('error_message');
		$configuration->directory_label = $request->directory_label;
		$configuration->salesforce_product_code = $request->salesforce_product_code;
		$configuration->configuration = $request->configuration;
		$configuration->workarea_html = $request->workarea_html;
		$configuration->active = $request->has('published') ? true : false;
		$configuration->save();
		session()->flash('success_message', 'Configuration saved successfully.');
		return redirect()->action('ConfigurationsController@edit', ['id' => $configuration->id]);
	}


}

?>
