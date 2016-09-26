<?php

namespace App\Http\Controllers;


//use App\Http\Requests;
use Request;
use \App\Note;

class NotesController extends Controller
{

    public function getAll(){
        $response = \App\Note::getAll();
        return response()->json($response)->setStatusCode($response->code);
    }

    public function get($id){
        $response = \App\Note::get($id);
        return response()->json($response)->setStatusCode($response->code);
    }

    public function create(){

        $id_user = Request::input('id_user');
        $description = Request::input('description');
        $limit_date = Request::input('limit_date');
        $warning_date = Request::input('warning_date');

        $note = new \stdClass();
        $note->id_user = $id_user;
        $note->description = $description;
        $note->limit_date = $limit_date;
        $note->warning_date = $warning_date;

        $response = \App\Note::createNew($note);

        return response()->json($response)->setStatusCode($response->code);

    }

}
