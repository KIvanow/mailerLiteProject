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
        if(!$request->email || !$request->name){
            return response()->json(["error" => "Missing fields"]);
        }

        $subscriberValid = $this->validateSubscriber($request->input("email"));
        if($subscriberValid["error"]){
            return $subscriberValid;
        } else {
            return Subscribers::create($request->all());
        }

    }

    /**
     * Return json with all subscribers and their fields
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $subscribers = Subscribers::all();
        if($subscribers){
            return response()->json($this->mergeSubscriberFields($subscribers));
        } else {
            return response()->json([]);
        }
    }

    /**
     * Return json with subscribers and his fields
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $subscriber = Subscribers::find($id);
        if($subscriber == null){
            return response()->json(null);
        }
        return response()->json($this->mergeSubscriberFields([$subscriber])[0]);
    }

    /**
     * Check if subscriber is valid //used when creating and editting subscribers
     *
     * @param int $email
     * @param boolean $withEmail
     * @return error object || true
     */
    protected function validateSubscriber($email, $withEmail = true)
    {
        if($withEmail && count(Subscribers::where("email", $email)->get())){
            return ["error" => "Subscriber with this email already exist" ];
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return ["error" => "Invalid email" ];
        }

        $domain = explode("@",$email)[1];

        if(!$this->pingDomain($domain)){
            return ["error" => "Inactive domain" ];
        }

        return true;
    }

     /**
     * Merge and return subscribers and their fields
     *
     * @param  array $subscribers
     * @return array
     */

    protected function mergeSubscriberFields($subscribers)
    {
        foreach($subscribers as $subscriber){
            $fields = [];
            foreach($subscriber->fields as $field){
                array_push($fields, $field);
            }
            $subscriber->fields = $fields;
        }

        return $subscribers;
    }

     /**
     * Check if the domain provided is active
     *
     * @param  string $domain
     * @return boolean
     */
    protected function pingDomain($domain)
    {
        $ch = curl_init($domain);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if($httpcode>=200 && $httpcode<300){
            return true;
        } else {
            return false;
        }
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
        if($subscriber){
            if($subscriber->email != $request->input("email")){
                $subscriberValid = $this->validateSubscriber($request->input("email"));
            } else {
                $subscriberValid = $this->validateSubscriber($request->input("email"), false); //the subscriber email will exist, because its the same
            }

            if($subscriberValid["error"]){
                return response()->json($subscriberValid);
            } else {
                $subscriber->update($request->all());
                return $subscriber;
            }

        } else {
            return response()->json(["error" => "Invalid subscriber" ]);
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
        if($subscriber){
            $subscriber->delete();
            return 204;
        } else {
            return response()->json([ "error" => "Invalid subscriber" ]);
        }
    }
}
