<?php

namespace App\Http\Controllers;


//use App\Http\Requests;
use Request;
use \App\Group;

class GroupsController extends Controller
{

    public function getAll(){
        $response = \App\Group::getAll();
        return response()->json($response)->setStatusCode($response->code);
    }

    public function get($id){
        $response = \App\Group::get($id);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function create(){

        $group = Request::all();

        $response = \App\Group::createNew($group);

        return response()->json($response)->setStatusCode($response->code);

    }

    public function update($id){

        $newGroup = Request::all();

        $group = \App\Group::find($id);
        $group->title = $newGroup['title'];
        $response = \App\Group::updateGroup($group);

        return response()->json($response)->setStatusCode($response->code);

    }

    public function delete($id){

        $response = \App\Group::deleteGroup($id);

        return response()->json($response)->setStatusCode($response->code);

    }

    public function getNotes($id){

        $response = \App\Group::getNotes($id);

        return response()->json($response)->setStatusCode($response->code);

    }

}
