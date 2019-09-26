@extends('layouts.app')

@section ('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <div class='card'>
        <div class='card-header'>
        
            Editar imagen
        
        </div>

        <div class="card-body">

                     <form action="{{route('image.update')}}" method="POST" enctype="multipart/form-data">
        
                        @csrf

                        <input type="hidden" name="image_id" value="{{ $image->id }}">

                        <div class="form-group row">

                            <label class='col-md-4 col-form-label text-md-right' for="image_path">Imagen</label>

                            <div class="col-md-6">

                            @if($image->user->image)
                            <div class='container-avatar'>

                                <img src="{{route('image.file',['filename'=>$image->image_path])}}" alt='foto de avatar' class='avatar'>

                            </div>
                            @endif
                                <input type="file"  name='image_path' id='image_path' class="form-control"/>
        
                            @if($errors->has('image_path'))

                            <span class='invalid-feedback' role='alert'> 
                            
                            <strong>{{ $errors->first('image_path')}} </strong>   

                            

                            </span>


                            @endif
        
                            </div>

                            </div>

                            <div class="form-group row">

                            <label class='col-md-4 col-form-label text-md-right' for="description">Descripcion</label>

                            <div class="col-md-6">

                                <textarea  rows=4 name='description' id='description' class="form-control" required/>{{ $image->description }}</textarea> 
        
                            @if($errors->has('description'))

                            <span class='invalid-feedback' role='alert'> 
                            
                            <strong>{{ $errors->first('description')}} </strong>   

                            </span>


                            @endif
        
                            </div>

                            </div>

                            <div class="form-group row">

                            <div class='col-md-6 offset-md-4'>


                            <input type="submit" class='btn btn-primary' value='Actualizar Imagen'>
        
                            </div>





    
                            </form>        
        
                         </div>

             </div>
            </div>  
        </div>
    </div>
</div>

@endsection