<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validar    

        $validate = $this->validate($request,[

            'image_id'=>'integer|required',

            'content'=>'string | required',



        ]);


        // recoger

        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');


        //Asigno los valores a mi nuevo objeto a guardar

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        // Guardar
        $comment->save();    

        // Redirect

        return redirect()->route('image.detail',compact('image_id'))->with(['message'=>'Su comentario ha sido publicado exitosamente']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //Consegui datos

        $user=\Auth::user();

        //conseguir objetos del cometario

        $comment= Comment::find($id);

        //Verificaion de quien es el dueno del comentario

        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){

            $route=

            $comment->delete();


            return redirect()->route('image.detail',['id' => $comment->image->id])->with(['message'=>'Comentario eliminado de forma correcta']);
        }
        else{
            return redirect()->route('image.detail',['id' => $comment->image->id])->with(['message'=>'Su comentario se pudo eliminar']);

        }


        
    }
}
