<?php

namespace App\Http\Controllers;


use Request;
use Response;
use DB;

class UserController extends Controller
{
    public function login(){
        $data = Request::all();
        $response = \App\User::login($data);
        return response()->json($response)->setStatusCode($response->code);
    }
    public function getNotes($id){
        $response = \App\User::getNotes($id);
        return response()->json($response)->setStatusCode($response->code);
    }
    public function getGroups($id){
        $response = \App\User::getGroups($id);
        return response()->json($response)->setStatusCode($response->code);
    }
    public function register(){
        $user = Request::all();
        $name = $user['name'];
        $lastname = $user['lastname'];
        $username = $user['username'];
        $password = MD5($user['password']);
        $email = $user['email'];
        $salida = "";
        DB::statement("CALL registerUser('$name','$lastname','$username','$password','$email',@msg,@code)");
        $rows = DB::select("SELECT @msg AS msg, @code AS code");
        return response()->json($rows[0])->setStatusCode($rows[0]->code);
    }
}
