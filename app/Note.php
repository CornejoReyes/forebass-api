<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Note extends Model{

    protected $table = "notes";

    protected $fillable = [
        'title', 'description'
    ];

    protected $hidden = [

    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function group(){
        return $this->belongsTo('App\Group');
    }

    public static function getAll(){

        $response = new Response();

        try{
            $response->rows = self::where('active',1)->get();
            $response->code = 200;
            if(!$response->rows) {
                $reponse->msg = "No se encontró información de notas";
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

            $newNote->user_id = $note['user_id'];
            $newNote->title = $note['title'];
            if(isset($note['group_id'])){
                $newNote->group_id = $note['group_id'];
            }
            $newNote->description = $note['description'];
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
            $note->delete();
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
