<div class="card pub_image">
            <div class="card-header">
                @if($image->user->image)
                <div class='container-avatar'>

                    <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" alt='foto de avatar' class='avatar'>

                </div>
                @endif

                
                <div class="data-user">

                    <a href="{{route ('profile', ['id'=> $image->user->id]) }}"> 
                
                        {{$image->user->nick}}
               
                    </a>
                 
                
                </div>


                <div class="card-body">
                
                    <div class="image-container">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}" alt="">
                    </div>
                
                </div>
              

                <div class="description">

                <span class="nick">  {{'@'.$image->user->nick}} </span> 
                <span class='nick'> {{' | '.$image->created_at}} </span>
                <br> {{$image->description}}
                

                

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
                            <img src="{{ asset ('icons/negro.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                        @else 
                            <img src="{{ asset ('icons/rojo.png')}}" data-id="{{$image->id}}" class="btn-like">                
                        @endif

                {{count($image->likes)}}
                </div>


               <div class='comments'>
                    <a href="{{route('image.detail',['id'=>$image->id])}}" class='btn btn-alert btn-sm btn-comments'>
                     Ver comentarios ({{count($image->comments)}})
                    </a>
                </div>
                
            </div>