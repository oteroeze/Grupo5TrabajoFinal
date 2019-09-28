@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('includes.message')

        
             <div class="card pub_image pub_image_detail">
             <div class="card-header">

            @include('includes.avatar', [
                    'image' => Storage::url($image->user->image)
                ])
                
                <div class="data-user">{{'@'.$image->user->nick}}</div>
                
                
                </div>


                <div class="card-body">
                    <div class="image-container detail">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}" alt="">
                    </div>
                
                </div>
              

                <div class="description">

                <span class="nick">  {{'@'.$image->user->nick}} </span> 
                <span class='nick'> {{' | '.$image->created_at}} </span>

                <br>
                 {{$image->description}}
                </div>

                <div class="likes">

                    <?php $user_like = false; ?>

                    @foreach($image->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                            <?php $user_like = true; ?>
                        @endif
                    @endforeach

                        @if($user_like)
                            <a href="https://icons8.com/icon/6636/lion-statue"></a>
                            <img src="{{asset('/icons/negro.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                            @else 
                            <img src="{{asset('/icons/rojo.png')}}" data-id="{{$image->id}}" class="btn-like">                
                        @endif

                {{count($image->likes)}}
                </div>
                
                @if(Auth::user() && Auth::user()->id == $image->user->id)
                    <div class="actions">
                        <a href="{{ route('image.edit' , [ 'id' => $image->id ] )}}" class="btn btn-primary btn-sm">Actualizar</a>
                        <!-- <a href="{{ route('image.delete', ['id' => $image->id ]) }}" class="btn btn-danger">Borrar</a> -->
                
                    <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
                           Eliminar
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"> Estas seguro de eliminar? </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Esta seguro de eliminar esta imagen?
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                <a href="{{ route('image.delete', ['id' => $image->id ]) }}" class="btn btn-danger">Borrar definitivamente</a>
                            </div>

                            </div>
                        </div>
                        </div>
                        </div>
                @endif

               <div class='comments'>
                    
                    <h3>Ver comentarios ({{count($image->comments)}})</h3>
                   

                    <form method="POST" action="{{route('comment.store')}}">

                        @csrf

                        <input type="hidden" name="image_id" value="{{$image->id}}">

                        <p>


                            <textarea name="content" id="" class='form-control'>

                            </textarea>
                            
                            @if ($errors->has('content'))
                            <br>
                            <span class='alert alert-danger' role='alert'>
                                
                                 {{$errors->first('content')}} 
                                </span>    
                               @endif
                        </p>



                        <button type="sumbit" class='btn btn-success'> Enviar </button>

                    </form>    

                    @foreach ($image->comments as $comment)
                    <div class='comment'>


                        <span class='nick'> {{'@'.$comment->user->nick}} </span>

                        <span class= 'nick date'>{{$comment->created_at}}</span>

                        <p>{{$comment->content}}</p>

                        @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))

                        <a href="{{ route('comment.delete', ['id'=>$comment->id] ) }}" class='btn btn-sm btn-danger'>

                        Eliminar

                        </a>
                        @endif

                    @endforeach


                    </div>

                </div>

@endsection
