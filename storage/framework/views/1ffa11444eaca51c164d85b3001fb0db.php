<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA:VENTAS</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/ventas.js'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/ventas.css'); ?>
</head>
<body>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <a href="<?php echo e(route('inicio')); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="buscador">
        <input class="input-buscador" type="text" id="buscar" placeholder="Buscar producto..." autocomplete="off">
        <div id="resultados" class="resultados"></div>
    </div>

    <div class="contenedor">
        <div class="contenedor-productos">
            <span class="title-contenedor">PRODUCTOS INCLUIDOS EN LA VENTA</span>
            <div id="carrito" class="carrito"><div class="carrito-vacio"><img class="img-vacio" src="<?php echo e(asset('images/caja-vacia.png')); ?>" width="64" height="64"><span>AUN NO SE HAN SELECCIONADO PRODUCTOS</span></div></div>
        </div>
        <div class="container-total">
            <div class="left"></div>
            <div id="total-carrito" class="total-carrito"><span>TOTAL: $0.00</span></div>
            <div class="right"></div>
        </div>
        <button id="enviar-carrito" class="registrar"><span>REGISTRAR VENTA</span></button>
    </div>
</body>


</html><?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\ventas.blade.php ENDPATH**/ ?>