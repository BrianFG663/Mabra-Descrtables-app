<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA:EDITAR PRODUCTO</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/editarProducto.css'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/edicionArticulo.js'); ?>
</head>
<body>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <a href="<?php echo e(route('inicio')); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>



    <div class="contenedor-edicion" id="contenedor">
        <div class="contenedor-input">
            <div class="buscador-edicion">
                <input class="input-buscador" type="text" id="buscar" placeholder="Buscar producto..." autocomplete="off">
                <div id="resultados" class="resultados"></div></div>
                <img src="<?php echo e(asset('images/papeleria.png')); ?>" class="imagen-contenedor-input">
        </div>
        <div class="contenedor-carta">
            <div class="carta-edicion">
                <div class="imagen-container" id="imagen-container"><img class="img-vacio-prueba" src="<?php echo e(asset('images/mosca.png')); ?>"></div>
                <div class="info-container">
                    <div class="nombre" id="nombre">*NOMBRE*</div>
                        <div class="stock"><strong id="strong-stock">*STOCK DISPONIBLE*</strong><span></span></div>
                        <div class="categoria"><strong id="strong-categoria">*CATEGORIA*</strong><span></span></div>
                        <div class="descripcion"><strong id="strong-descripcion">*DESCRIPCION*</strong><span></span></div>
                    </div>
                </div>
                <div class="botones-edicion">
                    <button id="btn-editar" onclick="" class="btn-editar">EDITAR</button>
                    <button id="btn-eliminar" onclick="" class="btn-eliminar">ELIMINAR</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\editarProducto.blade.php ENDPATH**/ ?>