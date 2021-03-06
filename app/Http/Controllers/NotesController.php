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

        $note = Request::all();

        $response = \App\Note::createNew($note);

        return response()->json($response)->setStatusCode($response->code);

    }

    public function update($id){

        $newNote = Request::all();

        $note = \App\Note::find($id);
        $note->title = $newNote['title'];
        if(isset($newNote['group_id'])){
            $note->group_id = $newNote['group_id'];
        }
        $note->description = $newNote['description'];
        $response = \App\Note::updateNote($note);

        return response()->json($response)->setStatusCode($response->code);

    }

    public function delete($id){

        $response = \App\Note::deleteNote($id);

        return response()->json($response)->setStatusCode($response->code);

    }

}
