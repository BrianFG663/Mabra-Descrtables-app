<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/busqueda.css'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/busqueda.js'); ?>
    <title>MABRA:BUSQUEDA ARTICULOS</title>
</head>
<body>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <a href="<?php echo e(route('inicio')); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="buscador">
        <input class="input-buscador" type="text" id="buscar" placeholder="Buscar producto..." autocomplete="off">
        <div id="resultados" class="resultados"></div>
    </div>

    <div class="container-total">
        <div class="left"></div>
        <div class="categorias" id="categorias">
            <div>
                <strong class="title-categoria">FILTRAR POR CATEGORIA</strong>
                <select name="id-categoria" class="id-categoria" id="id-categoria">
                    <option value="default" selected disabled hidden>Selecciona una categoría</option>
                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <input type="button" value="FILTRAR" onclick="buscarProductos()" class="boton-buscar" id="boton-buscar">
        </div>
        <div class="right"></div>
    </div>

    <div class="contenedor" id="contenedor">
        <div id="carrito" class="carrito"><div class="carrito-vacio"><img class="vacio-img" src="<?php echo e(asset('images/mosca.png')); ?>" width="64" height="64"><span>AUN NO SE HAN SELECCIONADO PRODUCTOS</span></div></div>
    </div>
</body>

</html>



<?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\busquedaarticulos.blade.php ENDPATH**/ ?>