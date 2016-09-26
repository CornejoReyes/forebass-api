<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Note extends Model{

    protected $table = "notes";

    public static function getAll(){

        $response = new Response();

        try{
            $query = self::where('active',1)->get();
            if(empty($query[0])){

                $response->code = 500;
                $response->msg = "Se produjo un error al obtener las notas";

            }else{
                $response->code = 200;
                $response->rows = $query;
            }
        }
        catch(\Exception $e){
            $response->msg = 'Se produjo un error al obtener las notas.';
            $response->exception = $e->getMessage();
            $response->code = 500;
        }

        return $response;

    }

    public static function get($id){

        $response = new Response();

        try{
            $query = self::where('id', $id)->where('active',1)->first();
            if($query){

                $response->code = 200;
                $response->rows = $query;

            }else{
                $response->code = 500;
                $response->msg = "La nota no existe";
            }
        }
        catch(\Exception $e){
            $response->msg = 'Se produjo un error al obtener la nota.';
            $response->exception = $e->getMessage();
            $response->code = 500;
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

    public static function updateNote($note){

        $response = new Response();

        try{

            $note->save();
            $response->code = 200;
            $response->msg = 'Nota modificada exitosamente';

        }
        catch(\Exception $e){

            $response->code = 500;
            $response->msg = "Hubo un error al modificar la nota";
            $response->exception = $e->getMessage();

        }

        return $response;

    }

    public static function deleteNote($id){
        $response = new Response();

        try{

            $note = self::find($id);
            $note->active = 0;
            $note->save();
            $response->code = 200;
            $response->msg = "Nota borrada correctamente";

        }
        catch(\Exception $e){

            $response->code = 500;
            $response->msg = "Hubo un error al borrar la nota";
            $response->exception = $e->getMessage();

        }

        return $response;

    }

}
