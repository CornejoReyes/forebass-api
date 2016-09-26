<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Note extends Model{

    protected $table = "notes";

    public static function getAll(){

        $response = new Response();

        try{
            $response->rows = self::all();
            $response->code = 200;
        }
        catch(\Exception $e){
            $response->msg = 'Se produjo un error al obtener las notas.';
            $response->exception = $e->getMessage();
        }

        return $response;

    }

    public static function get($id){

        $response = new Response();

        try{
            $response->rows = self::where('id', $id)->get();
            $response->code = 200;
        }
        catch(\Exception $e){
            $response->msg = 'Se produjo un error al obtener la nota.';
            $response->exception = $e->getMessage();
        }

        return $response;

    }

    public static function createNew($note){

        $newNote = new Note();
        $response = new Response();

        try{

            $newNote->id_user = $note->id_user;
            $newNote->description = $note->description;
            $newNote->limit_date = $note->limit_date;
            $newNote->warning_date = $note->warning_date;
            $newNote->active = 1;

            $newNote->save();

            $response->code = 200;
            $response->msg = "Nota creada correctamente";

        }
        catch(\Exception $e){
            $response->msg = "Se produjo un error al crear la nota";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }

        return $response;

    }

}
