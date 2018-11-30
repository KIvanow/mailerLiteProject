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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if( count( Subscribers::where("email", $request->input( "email" ) )->get() ) ){
            return response()->json( ["error" => "Subscriber with this email already exist" ] );
        } else if( !filter_var( $request->input( "email" ), FILTER_VALIDATE_EMAIL ) ){
            return response()->json( ["error" => "Invalid email" ] );
        } else {
            return Subscribers::create( $request->all() );
        }
    }

    public function getAll(){
        $subscribers = Subscribers::all();
        if( $subscribers ){
            return response()->json( $this->mergeSubscriberFields( $subscribers ) );
        } else {
            return response()->json( [] );
        }
    }

    public function get($id)
    {
        $subscriber = Subscribers::find( $id );
        if( $subscriber == null ){
            return response()->json( null );
        }
        return response()->json( $this->mergeSubscriberFields( [$subscriber] ) );
    }

    protected function mergeSubscriberFields( $subscribers ){
        foreach( $subscribers as $subscriber ){
            $fields = [];
            foreach( $subscriber->fields as $field ){
                array_push( $fields, $field );
            }
            $subscriber->fields = $fields;
        }

        return $subscribers;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // I could've used findOrFail and then a return the error with the message returned from the error thrown by it, but I prefer more human readable messages
        $subscriber = Subscribers::find($id);
        if( $subscriber ){
            $subscriber->update($request->all());
            return $subscriber;
        } else {
            return response()->json( ["error" => "No such user" ] );
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
        $subscriber = Subscribers::find($id);
        if( $subscriber ){
            $subscriber->delete();
            return 204;
        } else {
            return response()->json( [ "error" => "Subscriber does not exist" ] );
        }
    }
}
