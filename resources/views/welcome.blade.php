<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hosthelper</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                
                background-image:url('/images/fondo-projecto.jpeg');
                background-position:center;
                color: white;
                font-family: 'nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }
            
            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" style="color:white">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    HostHelper
                </div>

                <div class='content'>

                <p>HostHelper nace como el proyecto integrador final para el curso de Full Stack en Digital house de Ezequiel Otero, Enzo Amarilla y Santiago de la Fuente. Si bien a futuro el proyecto lo que pretende es integrar las partes entre ofertantes de alojamiento con demanda de trabajo, en este primer MVP la finalidad buscada fue lograr la interaccion entre las partes mediante: Comentarios, Likes y visualizacion de perfil. Asimismo cada usuario, el cual se identifica con un alias, podra realizar posteos e interactuar con otros usuarios dentro de la misma web en tiempo real</p>


                </div>

              
            </div>
        </div>
    </body>
</html>
