<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/busqueda.css')
    @vite('resources/js/busqueda.js')
    <title>Document</title>
</head>
<body>
    @include('partials.header')
    <a href="{{ route('inicio') }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="buscador">
        <input class="input-buscador" type="text" id="buscar" placeholder="Buscar producto..." autocomplete="off">
        <div id="resultados" class="resultados"></div>
    </div>

    <div class="container-total">
        <div class="left"></div>
        <div class="categorias" id="categorias">
            <div>
                <strong class="title-categoria">FILTRAR POR CATEGORIA</strong>
                <select name="id-categoria" class="id-categoria" id="id-categoria">
                    <option value="default" selected disabled hidden>Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <input type="button" value="FILTRAR" onclick="buscarProductos()" class="boton-buscar" id="boton-buscar">
        </div>
        <div class="right"></div>
    </div>

    <div class="contenedor" id="contenedor">
        <div id="carrito" class="carrito"><div class="carrito-vacio"><img class="vacio-img" src="{{asset('images/mosca.png')}}" width="64" height="64"><span>AUN NO SE HAN SELECCIONADO PRODUCTOS</span></div></div>
    </div>
</body>

</html>


