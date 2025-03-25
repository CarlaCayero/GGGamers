<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/auth.css', 'resources/js/app.js','resources/css/app.scss', 'resources/js/authBgAnimation.js'])
    </head>
    <body class="d-flex aling-items-center justify-content-center">
        <div class="bgAnimation" id="bgAnimation">
            <div class="backgroundAmim">

            </div>
        </div>
        <div class="container text-center content-container">
            <div class="row align-items-center justify-content-center">
                <div class="col-9 titulo">
                    @yield('titulo')
                </div>
                <div class="col-12 body-auth">
                    @yield('forms')
                </div>
            </div>
        </div>
    </body>
</html>
