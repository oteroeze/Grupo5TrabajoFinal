<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Use\App\Image;

Route::get('/', function () {



    // $images=Image::all();
    // foreach ($images as $image){
    //     echo $image->image_path."<br/>";
    //     echo $image->description."<br/>";
    //     echo $image->user->name.' '.$image->user->surname;


    //     if(count($image->comments)>=1){
    //     echo "<h4>Comentarios</h4>";
    //     foreach ($image->comments as $comment){
    //         echo $comment->$user->first_name .' '.$comment->$user->last_name;
    //         echo $comment->content."</br>";
    //     }

    //     }

    //     echo 'LIKES: '.count($image->likes);
    //     echo "<hr/>";
    // }


    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

ROUTE::get('/configuration','UserController@config')->name('config');


ROUTE::post('/user/update','UserController@update')->name('user.update');


ROUTE::post('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');

ROUTE::get('/image/create','ImageController@create')->name('image.create');

ROUTE::post('/image/store', 'ImageController@store')->name('image.store');

ROUTE::get('image/file/{filename}', 'ImageController@getImage')->name('image.file');

ROUTE::get('image/{id}', 'ImageController@detail')->name('image.detail');

ROUTE::post('/comment/store', 'CommentController@store')->name('comment.store');

ROUTE::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

ROUTE::get('/like/{image_id}','LikeController@like')->name('like.save');

ROUTE::get('/dislike/{image_id}','LikeController@dislike')->name('like.delete');

ROUTE::get('/profile/{id}',        'UserController@profile')->name('profile');

ROUTE::get('/likes', 'LikeController@index')->name('likes');

ROUTE::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');

ROUTE::get('imagen/editar/{id}', 'ImageController@edit')->name('image.edit');

ROUTE::post('image/update', 'ImageController@update')->name('image.update');

ROUTE::get('/gente/{search?}', 'UserController@index')->name('user.index');