<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/registroempleado.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        @include('partials.header')
        <a href="{{ route('inicio') }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
        <div class="contain-form">
            <form class="register" id="formulario-producto" action="{{ route('registro.producto') }}" method="POST">
                @csrf
                <p class="title-producto">AGREGAR ARTICULO</p>
                <input type="text" name="name" id="name" placeholder="Nombre">
                <input type="descripcion" name="descripcion" id="descripcion" placeholder="Descripcion">
                <input type="number" name="precio" id="precio" placeholder="Precio unitario">    
                <input type="number" name="stock" id="stock" placeholder="Stock disponible">    
                <select name="categoria" id="categoria" class="permission">
                    <option value="default" selected disabled hidden>Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
                
                <button type="button" onclick="validarRegistroProducto()">AGREGAR</button>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/productos.js')
</html>