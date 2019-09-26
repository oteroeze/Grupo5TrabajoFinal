@extends('layouts.app')



@section ('content')

<div class='container'>

    <div class="row justify-content-center">

        <div class='col-md-8'>

            <div class='data-user'>

                      <div class="profile-user"> 
                        @if($user->image)
                             <div class='container-avatar'>
                                  <img src="{{route('user.avatar',['filename'=>$user->image])}}" alt='foto de avatar' class='avatar'>
                              </div>
                         @endif
                        </div>
                        
                        <div class='user-info'>
                            <h1> {{ $user->nick }} </h1>
                            <h2>{{ $user->name . ' ' . $user->surname }}</h2>
                            <p>{{ 'Se unio: '. ($user->created_at) }}</p>
                        </div>

                        <div class="clearfix"></div>

                    @foreach($user->images as $image)

                             @include('includes.image', ['image'=>$image])

                    @endforeach    
                 
             </div>

        </div>
    </div>

</div>

@endsection