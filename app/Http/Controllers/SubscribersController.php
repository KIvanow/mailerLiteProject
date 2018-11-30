<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscribers;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){

    }

    public function getAll(){
        return response()->json( Subscribers::all() );
    }

    public function get(Request $request)
    {
        if ($request->isMethod('get')) {
            return response()->json(["error" => "Please access this endpoint with POST"]);
        }
        $subscriber = Subscribers::find( $request->input("id") );
        if( $subscriber == null ){
            return response()->json( ["error" => "Subscriber not found", "id"=>$request->input("id")] );
        }

        $fields = [];
        foreach( $subscriber->fields as $field ){
            array_push( $fields, $field );
        }
        $subscriber->fields = $fields;
        return response()->json($subscriber);
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
