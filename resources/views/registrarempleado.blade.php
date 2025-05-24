<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA:REGISTRAR EMPLEADO</title>
    <link rel="icon" href="{{ asset('images/iconos/letra-m.png') }}" type="image/png">
    @vite('resources/css/registroempleado.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/registroempleado.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        @include('partials.header')
        <a href="{{ route('inicio') }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
        <div class="contain-form">
            <form class="register" id="formulario-register" action="{{ route('registro.empleado') }}" method="POST">
                @csrf

                <p class="title-producto">REGISTRAR EMPLEADO</p>
                <div class="contenedor-botones">
                    <input type="text" name="name" id="name" placeholder="Nombre">
                <input type="lastname" name="lastname" id="lastname" placeholder="Apellido">
                <input type="text" name="email" id="email" placeholder="Correo electronico">    

                <select name="permission" id="permission" class="permission">
                    @foreach ($permisos as $permiso)
                        <option value="{{ $permiso->id }}">{{$permiso->permission}}</option>
                    @endforeach
                </select>
                </div>
                
                
                <button type="button" onclick="validarRegistroEmpleado()">Registrar</button>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/empleado.js')
</html>