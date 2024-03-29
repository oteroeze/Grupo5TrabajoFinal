@extends('layouts.app')



@section ('content')

<div class='container'>

    <div class="row justify-content-center">

        <div class='col-md-8'>

            <div class='data-user'>
                @foreach($user->images as $image)


                    @if ($image == NULL)
                         
                         <h1>Aun no has posteado ninguna imagen</h1>
                        
                    @else
                        <div class='user-info'>
                            <h2>{{ $user->name . ' ' . $user->surname }}</h2>
                            <h1> {{'@'. $user->nick }} </h1>
                            
                            <p>{{ 'Se unio: '. ($user->created_at) }}</p>
                        </div>

                        <div class="clearfix"></div>


                             @include('includes.image', ['image'=>$image])
                         @endif
                    @endforeach    
               
             </div>

        </div>
    </div>

</div>

@endsection