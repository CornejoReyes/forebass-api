<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Response;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username', 'lastname','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    public function notes(){
        return $this->hasMany('App\Note');
    }
    public function groups(){
        return $this->hasMany('App\Group');
    }

    public static function login(array $user = []){

        $query = new self();
        $response = new Response();
        try{
            $tryuser = $query->where('username',$user['username'])->first();
            if($tryuser){
                if($tryuser->password == md5($user['password'])){
                    $response->code = 200;
                    $response->msg = 'Login con éxito';
                    $response->rows = $tryuser;
                }else{
                    $response->code = 500;
                    $response->msg = 'Usuario o contraseña incorrectos';
                }
            }else{
                $response->code = 500;
                $response->msg = 'Usuario o contraseña incorrectos';
            }
        }
        catch(\Exception $e){
            $response->code=500;
            $response->msg = "Se produjo un error al loguear";
            $response->exception = $e->getMessage();
        }

        return $response;

    }

    public static function getNotes($id){
        $response = new Response();
        try{
            $user = self::where('id',$id)->with('notes')->get();
            if($user){
                $response->code = 200;
                $response->rows = $user;
            }else{
                $response->code = 404;
                $response->msg = "Usuario inexistente";
            }
        }
        catch (\Exception $e){
            $response->code = 500;
            $response->exception = $e->getMEssage();
            $response->msg = "Se produjo un error";
        }
        return $response;
    }
    public static function getGroups($id){
        $response = new Response();
        try{
            $user = self::where('id',$id)->with('groups')->get();
            if($user){
                $response->code = 200;
                $response->rows = $user;
            }else{
                $response->code = 404;
                $response->msg = "Usuario inexistente";
            }
        }
        catch (\Exception $e){
            $response->code = 500;
            $response->exception = $e->getMEssage();
            $response->msg = "Se produjo un error";
        }
        return $response;
    }
}
