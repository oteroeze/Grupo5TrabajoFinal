@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <h1>What's New <img src="https://img.icons8.com/officel/80/000000/binoculars.png"></h1>

        @include('includes.message')

        @foreach ($images as $image)
            @include('includes.image', compact('image'))
         @endforeach
         
         
            <div class="clearfix">
                {{$images->links()}}
            </div>
        </div>

        

    </div>
    
</div>
@endsection
