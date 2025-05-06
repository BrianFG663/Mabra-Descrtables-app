<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div class="wrapper">
        @include('partials.header')

        <div class="contain-form">
            <form class="login" id="formulario-login" action="{{ route('route.login') }}" method="POST">
                @csrf
                <input type="text" name="email" id="email" placeholder="Correo electronico">
                <input type="password" name="password" id="password" placeholder="Contraseña">
                <button type="button" onclick="validarLogin()">Iniciar sesión</button>
            </form>
        </div>
    </div>


    
    
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/login.js')
@vite('resources/css/login.css')
</html>
