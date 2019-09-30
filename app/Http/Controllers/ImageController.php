<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File; 

use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
          
    
    
    
    /**
     * 
     
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




        return view('image.create');

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
        $validate=$this->validate($request, [
            'description'=>'required',
            'image_path'=> 'required|image' 
        ]);

        $image_path = $request->file('image_path');

        $description = $request->input('description');

        // asignar valores al objeto

        $user = \AUTH::user();

        $image= new Image();

        $image->user_id = $user->id;


        $image->description = $description;

        //subir imagen 

        if($image_path){

            $image_path_name = time(). $image_path->getClientOriginalName();

            Storage::disk('images')->put($image_path_name,File::get($image_path));

            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')->with([
            'message'=> 'Su archivo se ha subido exitosamente'
        ]);

        
        
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    public function getImage($filename){

        $file=Storage::disk('images')->get($filename);
        return new Response ($file,200);


    }

    public function detail($id){

        $image = Image::findOrFail($id);

        return view('image.detail', compact('image'));

    }

    public function delete($id)
    { 
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes= Like::where('image_id', $id)->get();

        if($user && $image && $image->user->id == $user->id) {
            //Eliminar comentarios
            if($comments && count($comments) >= 1 ){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }

            //Eliminar los likes
            if($likes && count($likes) >= 1 ){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            //Eliminar ficheros de imagen
            Storage::disk('images')->delete($image->image_path);

            //Eliminar registro imagen
            $image->delete();

            $message = array ('message' => 'La imagen se ha borrado correctamente.');
        } else   { 
            $message = array ('message' => 'La imagen no se ha borrado.');
        }

        return redirect()->route('home')->with($message);

    }

    /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $user = \Auth::user();
            $image = Image::find($id);

            if($user && $image && $image->user->id == $user->id){
                return view('image.edit' , [
                    'image' => $image
                ]);
            }else {
                return redirect()->route('home');
            }
        }

            /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request)
        {
            $validate=$this->validate($request, [
                'description'=>'required',
                'image_path'=> 'image' 
            ]);
    
            //recoger datos
            $image_id = $request->input('image_id');
            $image_path = $request->file('image_path');
            $description = $request->input('description');

            // buscar objeto image
            $image = Image::find($image_id);
            $image->description = $description;

            //subir imagen

            // if($request->has('image_path')){
            //     $image->image_path = $request->file('image_path')->store('public/images');
            // }

            if($image_path){

                $image_path_name = time(). $image_path->getClientOriginalName();

                Storage::disk('images')->put($image_path_name,File::get($image_path));

                $image->image_path = $image_path_name;
            }
    
            // actualizar registro
            $image->update();

            return redirect()->route('image.detail' , ['id' => $image_id])
                             ->with(['message' => 'Imagen actualizada con exito.']);
            
        }


}
