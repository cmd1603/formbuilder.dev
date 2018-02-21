<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use App\Configuration;
use App\Rule;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Storage;

class TemplatesController extends Controller
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
        $templates = Template::with('user')->orderBy('updated_at', 'desc')->paginate(10);
        $configurations = Configuration::all();
        return view('templates.index')->with('templates', $templates)->with('configurations', $configurations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $templates = Template::all();
        $rules = Rule::all();
        return view('templates.create', compact('rules'))->with('rules', $rules); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = new Template();
        $template->created_by = Auth::id();
        $template->directory_label = $request->directory_label;
        $template->salesforce_product_code = $request->salesforce_product_code;
        $template->cutting_technology = $request->cutting_technology;
        $template->configuration = $request->configuration;
        $template->workarea_html = $request->workarea_html;
        $template->submitted_names = $request->submitted_names;
        $template->part_numbers = $request->part_numbers;
        $template->active = $request->has('published') ? true : false;
        $template->save();        

        $configuration = new Configuration();
        $configuration->created_by = Auth::id();
        $configuration->directory_label = $request->directory_label;
        $configuration->salesforce_product_code = $request->salesforce_product_code;
        $configuration->cutting_technology = $request->cutting_technology;
        $configuration->configuration = $request->configuration;
        $configuration->workarea_html = $request->workarea_html;
        $configuration->submitted_names = $request->submitted_names;
        $configuration->part_numbers = $request->part_numbers;
        $configuration->active = $request->has('published') ? true : false;
        $configuration->hidden = $request->hidden;
        $configuration->save();

        session()->flash('success_message', 'Template saved successfully.');
        return redirect()->action('UserController@show', ['user_id' => $template->user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $rules = Rule::all();
        $template = Template::findOrFail($id);
        return view('templates.edit')->with('template', $template)->with('rules', $rules);
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
        $template = Template::findOrFail($id);
        return $this->validateAndSave($template, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validateAndSave(Template $template, Request $request)
    {
        $request->session()->flash('error_message', 'Template was not saved successfully.');
        $this->validate($request, Template::$rules);
        $request->session()->forget('error_message');
        $template->directory_label = $request->directory_label;
        $template->salesforce_product_code = $request->salesforce_product_code;
        $template->cutting_technology = $request->cutting_technology;
        $template->configuration = $request->configuration;
        $template->workarea_html = $request->workarea_html;
        $template->submitted_names = $request->submitted_names;
        $template->part_numbers = $request->part_numbers;
        $template->active = $request->has('published') ? true : false;
        $template->save();
        session()->flash('success_message', 'Template saved successfully.');
        return redirect()->action('UserController@show', ['user_id' => $template->user->id]);
    }    
}
