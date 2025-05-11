<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/busqueda.css')
    @vite('resources/js/edicionArticulo.js')
</head>
<body>
    @include('partials.header')
    <a href="{{ route('inicio') }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="buscador">
        <input class="input-buscador" type="text" id="buscar" placeholder="Buscar producto..." autocomplete="off">
        <div id="resultados" class="resultados"></div>
    </div>



    <div class="contenedor-edicion" id="contenedor">
        <div id="carrito" class="carrito-edicion"><div class="carrito-vacio-edicion"><img class="vacio-img" src="{{asset('images/mosca.png')}}" width="64" height="64"><span>AUN NO SE HAN SELECCIONADO PRODUCTOS PARA SU EDICION</span></div></div>
    </div>
</body>
</html>