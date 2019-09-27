<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// acceso a la clase de storage

use Illuminate\Support\Facades\Storage;

// acceso a la clase file
// para que me funcione el file que lo genere mediante el helper response
use Illuminate\Http\Response;

use Illuminate\Support\Facades\File;

use App\User;



class UserController extends Controller

{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($search = null){
        
        if(!empty($search)){
            $users = User::where('nick', 'LIKE' , '%'.$search.'%')
                           ->orWhere('name', 'LIKE' , '%'.$search.'%')
                           ->orderBy('id', 'desc')
                           ->paginate(5);
        }else {
            $users = User::orderBy('id', 'desc')->paginate(5);
        }

        return view('user.index' , compact('users'));

    }

    public function config(){
        
        
        return view('user.config');
        
        
    }
    
    public function update (Request $request){
        
        // Conseguir usuario identificado
        
        $user= \Auth::user();
        
        $id= $user->id;
        
        
        // Validacion del formulario
        
        $validate= $this->validate($request,[
            
            
            'name' => 'required', 'string', 'max:255',
            'surname' => 'required', 'string', 'max:255',
            'nick' => 'required', 'string', 'max:255','unique:users,nick'.$id,
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users,email'.$id,
            
            
            ]);
            
            
            // Recoger datos del mismo
            
            
            $name = $request->input('name');
            $surname = $request->input('surname');
            $nick = $request->input('nick');
            $email = $request->input('email');
            
            
            // Asignar nuevos valores
            
            
            $user->name = $name;
            $user->surname = $surname;
            $user->nick = $nick;
            $user->email = $email;
            
            
            //Subir imagees
            
            if($request->has('image')){
                $user->image = $request->file('image')->store('public/users');
            }
            
            
            // Ejecutar consulta y cambios en la base de datos
            
            $user->update();
            
            return redirect()->route('config')
            ->with(['message'=>"Su usuario ha sido actualizado correctamente"]);
            
        }


       

        // public function profile ($id){


        //     $user = User::find($id);

        //     return view('profile',compact('user'));

        // }

        public function profile ($id){

            $user = User::find($id);

            return view('profile',compact('user'));

        }



    }
    