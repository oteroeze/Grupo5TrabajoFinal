<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;

class LikeController extends Controller
{







    public function __construct()
    {
        $this->middleware('auth');
    }



    public function like($image_id){



        $user = \Auth::user();

        $isset_like = Like::where('user_id',$user->id)
                       ->where('image_id',$image_id)
                       ->count();

        if($isset_like ==0 ){

        $like = new Like();

        $like->user_id = $user->id;

        $like->image_id = (int)$image_id;

        // guardar

        $like->save();

        return response()->json([

            'like' => $like,
        ]);

        }
        else{
            return response()->json([
            'message' =>'El like ya existe',
            ]);
        }

        
            
    

    }



    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $likes = Like::where('user_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->paginate(5);

        return view('likes.index', compact('likes'));
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
        //
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
    public function dislike($image_id)
    {

    // recoger datos del usuario y la imagen
        $user = \Auth::user();

        // condicion para ver si ya eciste el like y no publicarlo
        $like = Like::where('user_id',$user->id)
                       ->where('image_id',$image_id)
                       ->first();

        if($like){

            // eliminar like
        $like->delete();

        return response()->json([
            'like' => $like,
            'message' => 'has dado dislike correctamente'
        ]);

        }
        else{
            return response()->json([
            'message' =>'El like no existe',
            ]);
        }
    }

}
