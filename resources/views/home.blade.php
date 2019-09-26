@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <form id="buscador" method="GET" action="{{ route('user.index')}}">
            <div class="row">
                <div class="form-group col-8">
                    <input type="text" id="search" class="form-control">
                </div>
                <div class="form-group col btn-search">
                    <input type="submit" value="Buscar" class="btn btn-success">
                </div>
            </div>
            </form>

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
