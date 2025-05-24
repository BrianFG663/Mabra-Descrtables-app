<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>MABRA: CONTROL DE STOCK</title>
    <link rel="icon" href="{{ asset('images/iconos/letra-m.png') }}" type="image/png">
    @vite('resources/css/sale.css')
</head>
<body>
    

 @include('partials.header')
    <a href="{{ route("inicio") }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="contenedor" id="contenedor">
        <h2 class="tittle-contenedor">PRODUCTOS CON FALTA DE STOCK</h2>
        <div class="contenedor-productos" id="contenedor-productos">
            @foreach ($productos as $producto)
                <div class="carta">
                    <div class="imagen-container">
                        <div id="imagen-producto">
                            @php $imagenMostrada = false; @endphp
                            @foreach ($producto['categorias'] as $categoria)
                                @if (!$imagenMostrada)
                                    @switch($categoria['nombre'])
                                        @case('PAPEL')
                                            <img class="imagen-producto" src="{{ asset('/images/papel.png') }}">
                                            @php $imagenMostrada = true; @endphp
                                            @break
                                        @case('PLASTICO')
                                            <img class="imagen-producto" src="{{ asset('/images/vasoplastico.png') }}">
                                                @php $imagenMostrada = true; @endphp
                                                @break
                                        @case('ALUMINIO')
                                            <img class="imagen-producto" src="{{ asset('/images/rolloaluminio.png') }}">
                                            @php $imagenMostrada = true; @endphp
                                            @break
                                        @case('COTILLON')
                                            <img class="imagen-producto" src="{{ asset('/images/globos.png') }}">
                                            @php $imagenMostrada = true; @endphp
                                            @break
                                        @case('CARTON')
                                            <img class="imagen-producto" src="{{ asset('/images/carton.png') }}">
                                            @php $imagenMostrada = true; @endphp
                                            @break
                                        @case('EXPANDIDO')
                                            <img class="imagen-producto" src="{{ asset('/images/envase.png') }}">
                                            @php $imagenMostrada = true; @endphp
                                            @break
                                        @case('LIBRERIA')
                                            <img class="imagen-producto" src="{{ asset('/images/libros.png') }}">
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
                    <div class="stock"><strong>STOCK DISPONIBLE:</strong><span>{{$producto->stock}} UNIDADES</span></div>
                    <div class="categoria">
                    <strong>CATEGORIA:</strong>
                        <span>
                            @foreach ($producto['categorias'] as $categoria)
                                {{ $categoria['nombre'] }}
                            @endforeach
                        </span>
                    </div>
                    <div class="descripcion"><strong>DESCRIPCION:</strong><span>{{$producto->descripcion}}</span></div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
</body>
</html>


