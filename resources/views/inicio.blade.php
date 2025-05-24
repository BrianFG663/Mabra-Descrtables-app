<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MABRA DESCARTABLES</title>
<link rel="icon" href="{{ asset('images/iconos/letra-m.png') }}" type="image/png">
  @vite('resources/css/inicio.css')
</head>
<body>
    <div class="container">
        <div class="container-top">
            <div class="titulo">
                @if(Auth::check())
                <p>Bienvenida, {{ Auth::user()->name }}</p>
                @endif
            </div>
            <div class="registro">
                <form action="{{route('formulario.empleado')}}" method="post">@csrf <input class="boton-registro" type="submit" value="REGISTRAR EMPLEADO"></form>
                <img class="img-cajera" src="{{ asset('images/vendedora.png') }}" alt="">
            </div>    
        </div>
 

        <div class="container-botones">
        @if (Auth::user()->permission_id == 1)
            <div>
                <form class="form" action="{{route('ventas.inicio')}}" method="get">@csrf <input class="boton" type="submit" value="VENTAS" class="boton-registro"></form>
                <form class="form" action="{{route('busqueda.inicio')}}" method="get">@csrf <input class="boton" type="submit" value="BUSQUEDA DE ARTICULO"></form>
                <form class="form" action="{{route('formulario.producto')}}" method="get">@csrf <input class="boton" type="submit" value="AGREGAR ARTICULO"></form>
                <form class="form" action="{{route('formulario.edicion')}}" method="get">@csrf <input class="boton" type="submit" value="EDICION DE ARTICULOS"></form>
                <form class="form" action="{{route('formulario.precio')}}" method="get">@csrf <input class="boton" type="submit" value="CAMBIO DE PRECIOS"></form>
            </div>
            <div>
                <form class="form" action="{{route('productos.vendidos')}}" method="get">@csrf <input class="boton" type="submit" value="PRODUCTOS VENDIDOS"></form>
                <form class="form" action="{{route('registro.ventas')}}" method="get">@csrf <input class="boton" type="submit" value="REGISTRO DE VENTAS"></form>
                <form class="form" action="{{route('control.stock')}}" method="get">@csrf <input class="boton" type="submit" value="CONTROL DE STOCK"></form>
                <form class="form-sesion" action="{{route('route.logout')}}" method="POST">@csrf <input class="boton-sesion" type="submit" value="CERRAR SESION"></form>
            </div>
            
            
        @else
            <form class="form" action="{{route('ventas.inicio')}}" method="get">@csrf <input class="boton" type="submit" value="VENTAS"></form>
            <form class="form" action="{{route('busqueda.inicio')}}" method="get">@csrf <input class="boton" type="submit" value="BUSQUEDA DE ARTICULOS"></form>
            <form action="{{route('route.logout')}}" method="POST">@csrf <input class="boton-sesion" type="submit" value="CERRAR SESION"></form>
        @endif
        </div>

        <div class="footer">
            <h1><span>Mabra</span> Descartables</h1>
        </div>
    </div>
</body>
</html>
