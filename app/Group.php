<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "groups";

    protected $fillable = [
        'title', 'description'
    ];

    protected $hidden = [

    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function notes(){
        return $this->hasMany('App\Note');
    }

    public static function getAll(){

        $response = new Response();

        try{
            $response->rows = self::where('active',1)->get();
            $response->code = 200;
            if(!$response->rows) {
                $reponse->msg = "No se encontró información de grupos";
            }

        }
        catch(\Exception $e){
            $response->msg = 'Se produjo un error al obtener los grupos.';
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
                $response->code = 401;
                $response->msg = "El grupo no existe";
            }
        }
        catch(\Exception $e){
            $response->msg = 'Se produjo un error al obtener el grupo.';
            $response->exception = $e->getMessage();
            $response->code = 500;
        }

        return $response;

    }
    public static function getNotes($id){

        $response = new Response();

        try{
            $query = self::where('id', $id)->where('active',1)->with('notes')->first();
            if($query){

                $response->code = 200;
                $response->rows = $query;

            }else{
                $response->code = 401;
                $response->msg = "El grupo no existe";
            }
        }
        catch(\Exception $e){
            $response->msg = 'Se produjo un error al obtener el grupo.';
            $response->exception = $e->getMessage();
            $response->code = 500;
        }

        return $response;

    }

    public static function createNew($group){

        $newGroup = new Group();
        $response = new Response();

        try{

            $newGroup->user_id = $group['user_id'];
            $newGroup->title = $group['title'];
            $newGroup->active = 1;

            $newGroup->save();

            $response->code = 200;
            $response->msg = "Grupo creado correctamente";

        }
        catch(\Exception $e){
            $response->msg = "Se produjo un error al crear el grupo";
            $response->exception = $e->getMessage();
            $response->code = 500;
        }

        return $response;

    }

    public static function updateGroup($group){

        $response = new Response();

        try{

            $group->save();
            $response->code = 200;
            $response->msg = 'Grupo modificado exitosamente';

        }
        catch(\Exception $e){

            $response->code = 500;
            $response->msg = "Hubo un error al modificar el grupo";
            $response->exception = $e->getMessage();

        }

        return $response;

    }

    public static function deleteGroup($id){
        $response = new Response();

        try{

            $group = self::find($id);
            $group->delete();
            $response->code = 200;
            $response->msg = "Grupo borrado correctamente";

        }
        catch(\Exception $e){

            $response->code = 500;
            $response->msg = "Hubo un error al borrar el grupo";
            $response->exception = $e->getMessage();

        }

        return $response;

    }
}
