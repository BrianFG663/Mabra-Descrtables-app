<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/formularioEdicion.css')
    @vite('resources/js/articuloEdicion')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @include('partials.header')
    <a href="{{ route('formulario.edicion') }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="mensaje">
        <img src="{{ asset('/images/idea.png') }}" alt=""><strong>Recuerda:</strong><span>¡No es necesario editar todos los datos a la vez! Puedes hacer cambios de a uno y guardarlos cuando estés listo.</span>
    </div>
    <div class="contenedor">
        <div class="carta">
            <div class="imagen-container">
                <div id="imagen-producto">
                @php $imagenMostrada = false; @endphp
                    @foreach ($categorias_producto as $categoria_producto)
                        @if (!$imagenMostrada)
                            @switch($categoria_producto->nombre)
                                @case('PAPEL')
                                    <img class="img-vacio" src="{{ asset('/images/papel.png') }}">
                                    @php $imagenMostrada = true; @endphp
                                    @break
                                @case('PLASTICO')
                                    <img class="img-vacio" src="{{ asset('/images/vasoplastico.png') }}">
                                    @php $imagenMostrada = true; @endphp
                                    @break
                                @case('ALUMINIO')
                                    <img class="img-vacio" src="{{ asset('/images/rolloaluminio.png') }}">
                                    @php $imagenMostrada = true; @endphp
                                    @break
                                @case('COTILLON')
                                    <img class="img-vacio" src="{{ asset('/images/globos.png') }}">
                                    @php $imagenMostrada = true; @endphp
                                    @break
                                @case('CARTON')
                                    <img class="img-vacio" src="{{ asset('/images/carton.png') }}">
                                    @php $imagenMostrada = true; @endphp
                                    @break
                                @case('EXPANDIDO')
                                    <img class="img-vacio" src="{{ asset('/images/envase.png') }}">
                                    @php $imagenMostrada = true; @endphp
                                    @break
                                @case('LIBRERIA')
                                    <img class="img-vacio" src="{{ asset('/images/libros.png') }}">
                                    @php $imagenMostrada = true; @endphp
                                    @break
                            @endswitch
                        @endif
                    @endforeach
                </div>
                <strong class="precio">${{$producto->precio}}</strong>
            </div>
            <div class="info-container">
                <div class="nombre"><strong >{{$producto->nombre}}</strong></div>
                <div class="categoria">
                    <strong>CATEGORIA:</strong>
                    <span>
                        @foreach ($categorias_producto as $categoria_producto)
                           [ {{$categoria_producto->nombre}} ]
                        @endforeach
                    </span>
                </div>
                <div class="descripcion">
                    <strong>DESCRIPCION:</strong>
                    @if ($producto->descripcion == "" || $producto->descripcion == null)
                        <span>Este producto no contiene descripcion.</span>
                    @else
                        <span>{{$producto->descripcion}}</span>
                    @endif
                </div>
            </div>
        </div>

            <form class="register" id="formulario-edicion" action="{{ route('registro.producto') }}" method="POST">
                @csrf
                @method('PATCH')
                <p class="title-producto">EDITAR ARTICULO</p>
                <div class="inputs">
                    <input type="text" name="name" id="name" placeholder="Nombre">
                    <input type="descripcion" name="descripcion" id="descripcion" placeholder="Descripcion">
                    <input type="number" name="precio" id="precio" placeholder="Precio unitario">       
                    <select name="categoria-nueva" id="categoria_nueva" class="permission">
                        <option value="default" selected disabled hidden>AGREGAR CATEGORIA</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                    <select name="categoria" id="categoria_eliminar" class="permission">
                        <option value="default" selected disabled hidden>ELIMINAR CATEGORIA</option>
                        @foreach ($categorias_producto as $categoria_producto)
                            <option value="{{ $categoria_producto->id }}">{{$categoria_producto->nombre}}</option>
                        @endforeach
                    </select>   
                </div>  
                <button type="button" onclick="enviarDatos()">EDITAR ARTICULO</button>
            </form>
    </div>    
</body>
</html>