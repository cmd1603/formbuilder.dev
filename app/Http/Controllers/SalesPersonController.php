<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesPerson;
use App\User;
use App\Distributor;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Storage;

class SalesPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $distributors = Distributor::all();
        return view('sales_people.index')->with('distributors', $distributors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $distributors = Distributor::all();
        return view('sales_people.create')->with('distributors', $distributors);
    }

    public function fetchSalesPeopleData(Request $request)
    {
        $data = SalesPerson::select('id', 'did', 'sales_person')->get();
        return response()->json($data);
    }

    // --------------- AJAX POST REQUEST ------------------ //
    public function deleteSalesPerson(Request $request)
    {
        SalesPerson::find($request->id)->delete();
        return response()->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->validate($request, SalesPerson::$rules);

            // if($validator->fails()) {
            //     return Redirect::back()->withErrors($validator);
            // }

            $sales_person = new SalesPerson;
            $sales_person->did = $request->did;
            $sales_person->sales_person = $request->sales_person;
            $sales_person->save();
            session()->flash('success_message', 'Salesperson saved successfully.');
            return redirect()->action('ProductAccessController@index');
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
        //
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
}
