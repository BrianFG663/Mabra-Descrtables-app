<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MABRA DESCARTABLES</title>
<link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/inicio.css'); ?>
</head>
<body>
    <div class="container">
        <div class="container-top">
            <div class="titulo">
                <?php if(Auth::check()): ?>
                <p>Bienvenida, <?php echo e(Auth::user()->name); ?></p>
                <?php endif; ?>
            </div>
            <div class="registro">
                <form action="<?php echo e(route('formulario.empleado')); ?>" method="post"><?php echo csrf_field(); ?> <input class="boton-registro" type="submit" value="REGISTRAR EMPLEADO"></form>
                <img class="img-cajera" src="<?php echo e(asset('images/vendedora.png')); ?>" alt="">
            </div>    
        </div>
 

        <div class="container-botones">
        <?php if(Auth::user()->permission_id == 1): ?>
            <div>
                <form class="form" action="<?php echo e(route('ventas.inicio')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="VENTAS" class="boton-registro"></form>
                <form class="form" action="<?php echo e(route('busqueda.inicio')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="BUSQUEDA DE ARTICULO"></form>
                <form class="form" action="<?php echo e(route('formulario.producto')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="AGREGAR ARTICULO"></form>
                <form class="form" action="<?php echo e(route('formulario.edicion')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="EDICION DE ARTICULOS"></form>
                <form class="form" action="<?php echo e(route('formulario.precio')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="CAMBIO DE PRECIOS"></form>
            </div>
            <div>
                <form class="form" action="<?php echo e(route('productos.vendidos')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="PRODUCTOS VENDIDOS"></form>
                <form class="form" action="<?php echo e(route('registro.ventas')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="REGISTRO DE VENTAS"></form>
                <form class="form" action="<?php echo e(route('control.stock')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="CONTROL DE STOCK"></form>
                <form class="form-sesion" action="<?php echo e(route('route.logout')); ?>" method="POST"><?php echo csrf_field(); ?> <input class="boton-sesion" type="submit" value="CERRAR SESION"></form>
            </div>
            
            
        <?php else: ?>
            <form class="form" action="<?php echo e(route('ventas.inicio')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="VENTAS"></form>
            <form class="form" action="<?php echo e(route('busqueda.inicio')); ?>" method="get"><?php echo csrf_field(); ?> <input class="boton" type="submit" value="BUSQUEDA DE ARTICULOS"></form>
            <form action="<?php echo e(route('route.logout')); ?>" method="POST"><?php echo csrf_field(); ?> <input class="boton-sesion" type="submit" value="CERRAR SESION"></form>
        <?php endif; ?>
        </div>

        <div class="footer">
            <h1><span>Mabra</span> Descartables</h1>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\inicio.blade.php ENDPATH**/ ?>