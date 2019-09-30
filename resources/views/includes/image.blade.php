<div class="card pub_image">
            <div class="card-header">
        
              @include('includes.avatar', [
                    'image' => Storage::url($image->user->image)
                ])
                
                <div class="data-user">

                    <a href="{{route ('profile', ['id'=> $image->user->id]) }}"> 
                
                        {{'@'.$image->user->nick}}
               
                    </a>
                 
                
                </div>


                <div class="card-body">
                
                    <div class="image-container">
                    <a href="{{route('image.detail',['id'=>$image->id])}}">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}" alt="">
                    </a>   
                    </div>
                
                </div>
              

                <div class="description">

                <span class="nick">  {{'@'.$image->user->nick}} </span> 
                <span class='nick'> {{' | '.$image->created_at}} </span>
                <br> {{$image->description}}
                

                

                </div>

                <div class="likes">
                    

                        @if( $image->likes->contains('user_id', Auth::user()->id))
                        <img src="{{ asset ('icons/rojo.png')}}" data-id="{{$image->id}}" class="btn-like"> 
                        @else 
                        <img src="{{ asset ('icons/negro.png')}}" data-id="{{$image->id}}" class="btn-dislike">              
                        @endif

           
                
                </div>


               <div class='comments'>
                    <a href="{{route('image.detail',['id'=>$image->id])}}" class='btn btn-alert btn-sm btn-comments'>
                    
                    Ver comentarios ({{$image->comments_count}})
                    
                    </a>
                </div>
                
            </div>