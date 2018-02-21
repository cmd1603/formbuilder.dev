<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Distributor;
use App\Salesforce_Product_Code;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Storage;

class ProductAccessController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $distributors = Distributor::all();
        $sfpcs = Salesforce_Product_Code::all();
        return view('productaccess.index')->with('distributors', $distributors)->with('sfpcs', $sfpcs);
    }


    // --------------- AJAX GET REQUEST ------------------ //
    public function getDistributorData(Request $request)
    {
        $data = Product::select('id', 'did', 'code')->get();
        return response()->json($data);
    }

    public function fetchDistributorData(Request $request)
    {
        $data = Distributor::select('id', 'distributor')->get();
        return response()->json($data);
    }

    public function createDistAccessAjax(Request $request)
    {
        $product = new Product();
        $product->did = $request->did;
        $product->code = $request->code;
        $product->save();
        return response()->json($product);
    }

    // --------------- AJAX POST REQUEST ------------------ //
    public function deleteDistAccess(Request $request)
    {
        Product::find($request->id)->delete();
        return response()->json();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $distributors = Distributor::all();
        $sfpcs = Salesforce_Product_Code::all();        
        return view('productaccess.create')->with('distributors', $distributors)->with('sfpcs', $sfpcs);
    }

    public function sfpc_access(Request $request) {
        $distributors = Distributor::all();
        $sfpcs = Salesforce_Product_Code::all();        
        return view('sfpc_access')->with('distributors', $distributors)->with('sfpcs', $sfpcs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $distributors = Distributor::all();
        $sfpcs = Salesforce_Product_Code::all();
        $this->validate($request, Product::$rules);          
        $product = new Product();
        $product->did = $request->did;
        $product->code = $request->code;
        $product->save();
        session()->flash('success_message', 'Distributor access saved successfully.');
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
