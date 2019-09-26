var url = 'http://localhost:8000';

window.addEventListener('load', function() {
    
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');
    
    // Boton de Like
    function like() {
        $('.btn-like').unbind('click').click(function(){
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/icons/rojo.png');

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response) {
                    if(response.like){
                        console.log('has dado like putete');
                    }else{
                        console.log('error de like trolazo');
                    }
                }
            });

            dislike();
        });
    }
    like();
    // Boton de Dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/icons/negro.png');

            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response) {
                    if(response.like){
                        console.log('has dado dislike putete');
                    }else{
                        console.log('error de dislike trolazo');
                    }
                }
            });

            like();
        });
    }
    dislike();


    //BUSCADOR

    $('#buscador').submit(function() {
        $(this).attr('action',url+'/gente/'+$('#buscador #search').val());
    });

});