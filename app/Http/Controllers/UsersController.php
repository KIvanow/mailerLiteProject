<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Auth;

class UsersController extends Controller
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
     * Return json with all users and their subscribers
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $users = User::all();
        if($users){
            return $users;
        } else {
            return response()->json([]);
        }
    }

    /**
     * Return json with a user and his subscribers
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return User::find($id)->subscribers;
    }
}
