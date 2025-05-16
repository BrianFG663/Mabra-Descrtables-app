<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/js/ventas.js')
    @vite('resources/css/ventas.css')
</head>
<body>
    @include('partials.header')
    <a href="{{ route('inicio') }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="buscador">
        <input class="input-buscador" type="text" id="buscar" placeholder="Buscar producto..." autocomplete="off">
        <div id="resultados" class="resultados"></div>
    </div>

    <div class="contenedor">
        <div class="contenedor-productos">
            <span class="title-contenedor">PRODUCTOS INCLUIDOS EN LA VENTA</span>
            <div id="carrito" class="carrito"><div class="carrito-vacio"><img class="img-vacio" src="{{asset('images/caja-vacia.png')}}" width="64" height="64"><span>AUN NO SE HAN SELECCIONADO PRODUCTOS</span></div></div>
        </div>
        <div class="container-total">
            <div class="left"></div>
            <div id="total-carrito" class="total-carrito"><span>TOTAL: $0.00</span></div>
            <div class="right"></div>
        </div>
        <button id="enviar-carrito" class="registrar"><span>REGISTRAR VENTA</span></button>
    </div>
</body>


</html>