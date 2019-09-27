<?php

namespace App;



use Illuminate\Database\Eloquent\Model;



class Image extends Model
{
    protected $table = 'images';

    protected $withCount = ['comments', 'likes'];

    //Relacion uno  a muchos

    public function comments(){

        return $this->hasMany('\App\Comment')->orderBy('id','desc');

    }

    // Relacion uno a muchos

    public function likes(){

        return $this->hasMany('\App\Like');


    } 


    // Relacion  muchos a uno

    public function user(){

        return $this->belongsTo('\App\User','user_id');


    }
 

}
