<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rule;
use App\Rule_Id;
use App\User;
use App\Configuration;
use App\Http\Requests;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Storage;

class RulesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index(Request $request)
	{
        $rule_ids = Rule_Id::with('user')->orderBy('updated_at', 'desc')->paginate(10);
        $configurations = Configuration::all();  
        return view('rule_ids.index')->with('rule_ids', $rule_ids)->with('configurations', $configurations);        
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */	

	public function create(Request $request)
	{
		$rules = Rule::all();
		$configurations = Configuration::all();
		return view('rules.create', compact('rules'))->with('rules', $rules)->with('configurations', $configurations);
	}

	public function findProductName(Request $request)
	{
		$data = Configuration::select('id', 'directory_label', 'salesforce_product_code', 'submitted_names', 'part_numbers')->get();

		return response()->json($data);
	}

    // --------------- AJAX GET REQUEST ------------------ //
    public function fetchRuleIds(Request $request)
    {
        $data = Rule_Id::select('id', 'directory_label', 'rule_name', 'created_at', 'updated_at')->get();
        return response()->json($data);
    }

    // --------------- AJAX GET REQUEST ------------------ //
	public function getRulesData(Request $request)
	{
		$data = Rule::select('id', 'directory_label', 'rule_name', 'submitted_name_1', 'submitted_name_2', 'submitted_name_3', 'submitted_output', 'input_1', 'input_2', 'input_3', 'output')->get();

		return response()->json($data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request)
	{
		$sub1_count = $request->get('submitted_name_1');
		if (count($sub1_count) > 0) 
		{
			foreach($sub1_count as $key => $value)
			{
				$rule = new Rule;
				$rule->created_by = Auth::id();
				$rule->directory_label = $request->directory_label;
				$rule->rule_name = $request->rule_name;
				$rule->salesforce_product_code = $request->salesforce_product_code;
				$rule->submitted_name_1 = $request->submitted_name_1[$key];
				$rule->input_1 = $request->input_1[$key];
				$rule->submitted_name_2 = $request->submitted_name_2[$key];
				$rule->input_2 = $request->input_2[$key];
				$rule->submitted_name_3 = $request->submitted_name_3[$key];
				$rule->input_3 = $request->input_3[$key];
				$rule->submitted_output = $request->submitted_output[$key];
				$rule->output = $request->output[$key];
				$rule->save();
			}	
			
		} else {
			$rule = new Rule();
			$rule->created_by = Auth::id();
			Log::info($request->all());
			return $this->validateAndSave($rule, $request);
		}
		session()->flash('success_message', 'Rule saved successfully.');
		return redirect()->action('UserController@show', Auth::user()->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function show(Request $request, $id)
	{
		$rule = Rule::with('user')->findOrFail($id);
		return view('rules.show')->with('rule', $rule);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */	

	public function edit(Request $request, $id)
	{
		$rule = Rule::findOrFail($id);
		return view('rules.edit')->with('rule', $rule);
	}

	public function editItem(Request $request)
	{
		$rule = Rule::find($request->id);
		$rule->directory_label = $request->directory_label;
		$rule->rule_name = $request->rule_name;
		$rule->submitted_name_1 = $request->submitted_name_1;
		$rule->input_1 = $request->input_1;
		$rule->submitted_name_2 = $request->submitted_name_2;
		$rule->input_2 = $request->input_2;
		$rule->submitted_name_3 = $request->submitted_name_3;
		$rule->input_3 = $request->input_3;
		$rule->submitted_output = $request->submitted_output;
		$rule->output = $request->output;
		$rule->save();
		return response()->json($rule);
	}

	/**
 	 * Update the specified resource in storage.
 	 *
 	 * @param  \Illuminate\Http\Request  $request
 	 * @param  int  $id
 	 * @return \Illuminate\Http\Response

 	 */	

	public function updateThroughAjax(Request $request)
	{
		$rule = new Rule;
		$rule->created_by = Auth::id();
		$rule->directory_label = $request->directory_label;
		$rule->rule_name = $request->rule_name;
		$rule->submitted_name_1 = $request->submitted_name_1;
		$rule->input_1 = $request->input_1;
		$rule->submitted_name_2 = $request->submitted_name_2;
		$rule->input_2 = $request->input_2;
		$rule->submitted_name_3 = $request->submitted_name_3;
		$rule->input_3 = $request->input_3;
		$rule->submitted_output = $request->submitted_output;
		$rule->output = $request->output;
		$rule->save();
		return response()->json($rule);
	}

	/**
 	 * Remove the specified resource from storage.
 	 *
 	 * @param  int  $id
 	 * @return \Illuminate\Http\Response
 	 */

	public function destroy($id)
	{
		$rule = Rule::findOrFail($id);
		$rule->delete();
		session()->flash('success_message', 'Rule deleted successfully.');
		return redirect()->action('UserController@show', Auth::user()->id);
	}

	public function deleteRecordAjax(Request $request)
	{
		Rule::find($request->id)->delete();
		return response()->json();
	}

	private function validateAndSave(Rule $rule, Request $request)
	{
		$request->session()->flash('error_message', 'Rule was not saved successfully.');
		$this->validate($request, Rule::$rules);
		$request->session()->forget('error_message');
		$rule->directory_label = $request->directory_label;
		$rule->rule_name = $request->rule_name;
		$rule->submitted_name_1 = $request->submitted_name_1;
		$rule->input_1 = $request->input_1;
		$rule->submitted_name_2 = $request->submitted_name_2;
		$rule->input_2 = $request->input_2;
		$rule->submitted_name_3 = $request->submitted_name_3;
		$rule->input_3 = $request->input_3;
		$rule->submitted_output = $request->submitted_output;
		$rule->output = $request->output;
		$rule->save();
		return response()->json($rule);
	}
			
}
