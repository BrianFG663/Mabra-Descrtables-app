<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA: PRODUCTOS MAS VENDIDOS</title>
    <link rel="icon" href="{{ asset('images/iconos/letra-m.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/productosVendidos.css')
    @vite('resources/js/productoVendidos.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    @include('partials.header')
    <a href="{{ route('inicio') }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="container-total">
        <div class="left"></div>
        <div class="categorias" id="categorias">
            <div class="select">
                <strong class="title-categoria">FILTRAR POR CATEGORIA</strong>
                <select name="id-categoria" class="id-categoria" id="id-categoria">
                    <option value="default" selected disabled hidden>Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                    <option value="all">TODAS LAS CATEGORIAS</option>
                </select>
                
            </div>
            <div class="fecha">
                <label for="fecha_final">¿DESDE QUE FECHA DESEA BUSCAR?</label>
                <input type="date" name="fecha_final" id="fecha_final">
            </div>
            <input type="button" value="FILTRAR" onclick="buscarProductosCategoria()" class="boton-buscar" id="boton-buscar">
        </div>
        <div class="right"></div>
    </div>

    <div class="contenedor" id="contenedor">
        <div class="contenedor-productos" id="contenedor-productos">

        </div>
    </div>
    
</body>
</html>