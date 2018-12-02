<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Rules\UniqueField;
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
        Validator::make(
            ["subscriber_id"=>$subscriber_id],
            ['subscriber_id' => 'required|exists:subscribers,id'],
            [
                'required' => 'The :attribute field is required.',
                'exists' => 'There is no subscriber with this id.',
            ]
        )->validate();

        return Fields::where("subscriber_id", $subscriber_id)->get();
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
        $request->validate(
            [
                'subscriber_id' => 'required|exists:subscribers,id',
                'title' => 'required|max:255',
                'value' => 'required|max:255',
                'type' => ['required', 'max:255']
            ],
            [
                'required' => 'The :attribute field is required.',
                'exists' => 'There is no subscriber with this id.',
            ]
        );

        $this->validateUniqueField($request);

        return Fields::create($request->all());
    }

    /**
     * Check if field is valid //used when creating and editting field
     *
     * @param int $email
     * @return error object || true
     */
    protected function validateUniqueField($request)
    {
        $field = Fields::where("type", "=", $request->input("type"))
        ->where("title", "=", $request->input("title"))
        ->where("subscriber_id", "=", $request->input("subscriber_id"))
        ->get();

        if(count($field) > 0){
            $this->throwValidationError(['description' => ['This field already exists']]);
        }
    }

    protected function throwValidationError($message)
    {
        $error = \Illuminate\Validation\ValidationException::withMessages($message);
        throw $error;
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
        Validator::make(
            ["id"=>$id],
            ['id' => 'required|exists:fields'],
            [
                'required' => 'The :attribute field is required.',
                'exists' => 'There is no field with this id.',
            ]
        )->validate();

        $this->validateUniqueField($request);

        if($request->subscriber_id && $field->subscriber_id == $request->subscriber_id){
            $this->throwValidationError(["description" => ["You can not change subscriber id of a field"]]);
        }

        $field = Fields::find($id);
        $field->update($request->all());
        return $field;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Validator::make(
            ["id"=>$id],
            ['id' => 'required|exists:fields'],
            [
                'required' => 'The :attribute field is required.',
                'exists' => 'There is no field with this id.',
            ]
        )->validate();
        return 422;

        Fields::find($id)->delete();
        return 204;
    }
}
