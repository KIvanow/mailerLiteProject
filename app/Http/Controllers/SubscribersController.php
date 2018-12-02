<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
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
        $request->validate([
            'email' => 'required|unique:subscribers|max:255',
            'name' => 'required'
        ]);

        $this->validateSubscriber($request->input("email"));

        return Subscribers::create($request->all());
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
     * Check if subscriber is valid and throw error if validation fails //used when creating and editting subscribers
     *
     * @param int $email
     * @return void
     */
    protected function validateSubscriber($email)
    {
        if($withEmail && count(Subscribers::where("email", $email)->get())){
            $error = \Illuminate\Validation\ValidationException::withMessages(
                ['description' => ['Subscriber with this email already exist']]
            );
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = \Illuminate\Validation\ValidationException::withMessages(
                ['description' => ['Invalid email']]
            );
            throw $error;
        }

        if(!$this->pingDomain(explode("@",$email)[1])){
            $error = \Illuminate\Validation\ValidationException::withMessages(
                ['description' => ['Invalid email domain']]
            );
            throw $error;
        }
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
            foreach($subscriber->fields as $field){
                $value = $field["value"];
                switch ($field["type"]) {
                    case 'boolean':
                        $value = boolval( $value );
                        break;

                    case 'number':
                        $value = intval( $value ); //or floatval depends on the use cases
                        break;

                    // case 'date':
                    //     $value = strtotime($value); //potentionally convert to timestamp depending on the use cases
                    //     break;
                }

                $subscriber[ $field["title"] ] = $value;
            }
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
                $subscriberValid = $this->validateSubscriber($request->input("email")); //the subscriber email will exist, because its the same
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
        Validator::make(
            ["id"=>$id],
            ['id' => 'required|exists:subscribers'],
            [
                'required' => 'The :attribute field is required.',
                'exists' => 'There is no subscriber with this id.',
            ]
        )->validate();

        $subscriber = Subscribers::find($id);
        $subscriber->delete();
        return 204;
    }
}
