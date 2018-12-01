<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscribers;
use App\Fields;

class FieldsController extends Controller
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
     * Return json with all fields for given subscriber
     *
     * @param int $subscriber_id
     * @return JSON
     */
    public function getSubscriberFields($subscriber_id)
    {
            $subscriber = Subscribers::find($subscriber_id);
            if($subscriber){
                return Fields::where("subscriber_id", $subscriber_id)->get();
            }
            return response()->json(["error" => "Invalid subscriber id"]);
    }

    /**
     * Return json with field
     *
     * @param int $id
     * @return JSON
     */
    public function get($id)
    {
        return response()->json(Fields::find($id));
    }

    /**
     * Store a newly create resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->title || !$request->type){
            return response()->json(["error" => "Missing fields"]);
        }

        if(!Subscribers::find($request->input("subscriber_id"))){
            return ["error" => "Invalid subscriber id"];
        }

        $fieldValid = $this->validateField($request);
        if($fieldValid["error"]){
            return $fieldValid;
        } else {
            return Fields::create($request->all());
        }

    }

    /**
     * Check if field is valid //used when creating and editting field
     *
     * @param int $email
     * @return error object || true
     */
    protected function validateField($request)
    {
        $field = Fields::where("type", "=", $request->input("type"))
        ->where("title", "=", $request->input("title"))
        ->where("subscriber_id", "=", $request->input("subscriber_id"))
        ->get();

        if(count($field) > 0){
            return ["error"=> "Field already exists"];
        }
        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $field = Fields::find($id);
        if($field){
            $fieldValid = $this->validateField($request);

            if($request->subscriber_id && $field->subscriber_id == $request->subscriber_id){
                return response()->json(["error" => "You can not change subscriber id of a field" ]);
            }

            if($fieldValid["error"]){
                return response()->json($fieldValid);
            }

            $field->update($request->all());
            return $field;
        } else {
            return response()->json(["error" => "Invalid field" ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $field = Fields::find($id);
        if($field){
            $field->delete();
            return 204;
        } else {
            return response()->json([ "error" => "Invalid field" ]);
        }
    }
}
