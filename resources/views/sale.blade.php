<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MABRA:DETALLES DE VENTAS</title>
    <link rel="icon" href="{{ asset('images/iconos/letra-m.png') }}" type="image/png">
    @vite('resources/css/sale.css')
    @vite('resources/js/sale.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @include('partials.header')
    <a href="{{ route("inicio") }}" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="contenedor" id="contenedor">
        <h2 class="tittle-contenedor">PRODUCTOS INCLUIDOS EN LA VENTA</h2>
        <div class="contenedor-productos" id="contenedor-productos">
            @foreach ($detalles as $detalle)
                <div class="carta">
                    <div class="imagen-container">
                        <button class="eliminar-btn" onclick="eliminarProducto({{ $detalle->id }},{{$detalle->sales_id}})" title="ELIMINAR PRODUCTO DE LA COMPRA"><i class="fa-solid fa-xmark"></i></i></button>
                        <div id="imagen-producto">
                            @php $imagenMostrada = false; @endphp
                            @foreach ($detalle['product']['categorias'] as $categoria)
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
                        <strong class="precio">${{$detalle->precio_unitario}}</strong>
                    </div>
                    <div class="info-container">
                        <div class="nombre"><strong>{{ $detalle['product']['nombre'] }}</strong></div>
                        <div class="cantidad"><strong>CANTIDAD EN LA VENTA:</strong><span>{{$detalle->cantidad}}</span></div>
                        <div class="total"><strong>TOTAL VENDIDO:</strong><span>${{$detalle->cantidad*$detalle->precio_unitario}}</span></div>
                        <div class="categoria">
                            <strong>CATEGORIA:</strong>
                            <span>
                                @foreach ($detalle['product']['categorias'] as $categoria)
                                    {{ $categoria['nombre'] }}
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>


