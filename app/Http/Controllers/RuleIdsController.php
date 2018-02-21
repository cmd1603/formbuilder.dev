<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rule_Id;
use App\Rule;
use App\Configuration;
use App\Http\Requests;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Storage;

class RuleIdsController extends Controller
{

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
        $rule_ids = Rule_Id::with('user')->orderBy('updated_at', 'desc')->paginate(10);
        return view('rule_ids.index')->with('rule_ids', $rule_ids);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = Rule::all();
        $configurations = configuration::all();
        return view('rule_ids.create', compact('rules'))->with('rules', $rules)->with('configurations', $configurations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeByAjax(Request $request)
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

    public function store(Request $request)
    {
        $rule_id = new Rule_Id;
        $rule_id->created_by = Auth::id();
        $rule_id->directory_label = $request->directory_label;
        $rule_id->rule_name = $request->rule_name;
        $rule_id->save();
        session()->flash('success_message', 'Rule saved successfully.');
        // return redirect()->action('UserController@show', Auth::user()->id);
        return redirect()->action('RulesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $rule_id = Rule_Id::with('user')->findOrFail($id);
        return view('rule_ids.show')->with('rule_id', $rule_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $rule_id = Rule_Id::findOrFail($id);
        return view('rule_ids.edit')->with('rule_id', $rule_id);
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
        $rule_id = Rule_Id::findOrFail($id);
        return $this->validateAndSave($rule_id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $rule_id = Rule_Id::findOrFail($id);
        $selected_name = $rule_id->rule_name;
        $all_sub_rules = Rule::all();
        foreach ($all_sub_rules as $key => $value) {
            if($selected_name == $value->rule_name) {
                Rule::find($value->id)->delete();
            }
        }
        
        $rule_id->delete();

        session()->flash('success_message', 'Rule deleted successfully.');
        return redirect()->action('UserController@show', Auth::user()->id);
    }

    private function validateAndSave(Rule_id $rule_id, Request $request)
    {
        $request->session()->flash('error_message', 'Rule was not saved successfully.');
        $this->validate($request, Rule_Id::$rules);
        $request->session()->forget('error_message');
        $rule_id->directory_label = $request->directory_label;
        $rule_id->rule_name = $request->rule_name;
        $rule_id->save();
        session()->flash('success_message', 'Rule saved successfully.');
        return redirect()->action('UserController@show', Auth::user()->id);
    }    
}
