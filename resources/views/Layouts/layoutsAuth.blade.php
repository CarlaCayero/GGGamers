<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/auth.css', 'resources/js/app.js','resources/css/app.scss'])
    </head>
    <body class="vertical-line d-flex img-container">
        @yield('imagen')
        <div class="container text-center content-container">
            <div class="row align-items-center">
                <div class="col-12 titulo">
                    @yield('titulo')
                </div>
                <div class="col-12 body-auth">
                    @yield('forms')
                </div>
            </div>
        </div>
    </body>
</html>
