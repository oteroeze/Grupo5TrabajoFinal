@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
        <h1>Comunidad <img src="https://img.icons8.com/bubbles/100/000000/conference-call.png"></h1>
        <form id="buscador" method="GET" action="{{ route('user.index')}}">
            <div class="row">
                <div class="form-group col">
                    <input type="text" id="search" class="form-control">
                </div>
                <div class="form-group col btn-search">
                    <input type="submit" value="Buscar" class="btn btn-success">
                </div>
            </div>
            </form>
        <hr>
        
        @foreach ($users as $user)
            
        @include('includes.avatar', [
                    'image' => Storage::url($user->image)
                ])
                
             


                        
             <div class='user-info'>
                  <h2> {{'@'.$user->nick }} </h2>
                 <h3>{{ $user->name . ' ' . $user->surname }}</h3>
                  <p>{{ 'Se unio: '. ($user->created_at) }}</p>
                  <a href="{{ route('profile' , ['id' => $user->id])}}" class="btn btn-success">Ver perfil</a>
            </div>
         @endforeach
         
         
            <div class="clearfix">
                {{$users->links()}}
            </div>
        </div>

        

    </div>
</div>
@endsection