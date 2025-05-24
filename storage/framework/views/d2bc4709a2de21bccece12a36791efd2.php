<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA:CAMBIO  DE PRECIOS</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/cambioPrecios.css'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/cambioPrecio.js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <div class="container">
        <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <a href="<?php echo e(route('inicio')); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
        <div class="contain-form">
            <form class="register" id="formulario-precio" action="<?php echo e(route('editar.precio')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('patch'); ?>
                <p class="title-form">CAMBIO DE PRECIO</p>
                <input type="number" name="porcentaje" id="porcentaje" placeholder="Porcentaje de aumento">
                <select name="accion" id="accion" class="accion">
                    <option value="default" selected disabled hidden>SELECCIONE ACCION</option>
                    <option value="suba">SUBA DE PRECIOS</option>
                    <option value="baja">BAJA DE PRECIOS</option>
                </select>
                <select name="categoria" id="categoria" class="permission">
                    <option value="default" selected disabled hidden>SELECCIONE CATEGORIA</option>
                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($categoria->id); ?>|<?php echo e($categoria->nombre); ?>"><?php echo e($categoria->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                <button type="button" onclick="validarEdicionPrecio()">ACTUALIZAR</button>
            </form>
        </div>
    </div>

    <div class="imagenes">        
        <img class="img-izquierda" src="<?php echo e(asset('images/tienda.png')); ?>">
        <img class="img-derecha" src="<?php echo e(asset('images/papeleria.png')); ?>">
    </div>
</body>
</html><?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\cambioPrecios.blade.php ENDPATH**/ ?>