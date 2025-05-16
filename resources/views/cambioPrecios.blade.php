<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/cambioPrecios.css')
    @vite('resources/js/cambioPrecio.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <div class="container">
        @include('partials.header')
        <a href="{{ route('inicio') }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
        <div class="contain-form">
            <form class="register" id="formulario-precio" action="{{ route('editar.precio') }}" method="POST">
                @csrf
                @method('patch')
                <p class="title-form">CAMBIO DE PRECIO</p>
                <input type="number" name="porcentaje" id="porcentaje" placeholder="Porcentaje de aumento">
                <select name="accion" id="accion" class="accion">
                    <option value="default" selected disabled hidden>SELECCIONE ACCION</option>
                    <option value="suba">SUBA DE PRECIOS</option>
                    <option value="baja">BAJA DE PRECIOS</option>
                </select>
                <select name="categoria" id="categoria" class="permission">
                    <option value="default" selected disabled hidden>SELECCIONE CATEGORIA</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}|{{ $categoria->nombre }}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
                
                <button type="button" onclick="validarEdicionPrecio()">ACTUALIZAR</button>
            </form>
        </div>
    </div>
</body>
</html>