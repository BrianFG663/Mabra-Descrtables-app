<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA:REGISTRO DE VENTAS</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/registroVentas.css'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/registrosVentas.js'); ?>
</head>
<body>

    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <a href="<?php echo e(route('inicio')); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="container-total">
        <div class="left"></div>
        <div class="categorias" id="categorias">
            <div class="fecha">
                <label for="fecha_final">¿DESDE QUE FECHA DESEA BUSCAR?</label>
                <input type="date" name="fecha_final" id="fecha_final">
            </div>
            <input type="button" value="FILTRAR" onclick="ventasDia()" class="boton-buscar" id="boton-buscar">
        </div>
        <div class="right"></div>
    </div>

    <div class="contenedor" id="contenedor">
        <img src="<?php echo e(asset('images/tienda.png')); ?>" class="imagen-tienda">
        <span class="title-contenedor">VENTAS DEL DIA</span>
        <div class="contenedor-productos" id="contenedor-ventas"></div>
    </div>
    
</body>
</html><?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\registroVentas.blade.php ENDPATH**/ ?>