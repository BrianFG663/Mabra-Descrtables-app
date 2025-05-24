<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>MABRA:DETALLES DE VENTAS</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/sale.css'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/sale.js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <a href="<?php echo e(route("inicio")); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="contenedor" id="contenedor">
        <h2 class="tittle-contenedor">PRODUCTOS INCLUIDOS EN LA VENTA</h2>
        <div class="contenedor-productos" id="contenedor-productos">
            <?php $__currentLoopData = $detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carta">
                    <div class="imagen-container">
                        <button class="eliminar-btn" onclick="eliminarProducto(<?php echo e($detalle->id); ?>,<?php echo e($detalle->sales_id); ?>)" title="ELIMINAR PRODUCTO DE LA COMPRA"><i class="fa-solid fa-xmark"></i></i></button>
                        <div id="imagen-producto">
                            <?php $imagenMostrada = false; ?>
                            <?php $__currentLoopData = $detalle['product']['categorias']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$imagenMostrada): ?>
                                    <?php switch($categoria['nombre']):
                                        case ('PAPEL'): ?>
                                            <img class="imagen-producto" src="<?php echo e(asset('/images/papel.png')); ?>">
                                            <?php $imagenMostrada = true; ?>
                                            <?php break; ?>
                                        <?php case ('PLASTICO'): ?>
                                            <img class="imagen-producto" src="<?php echo e(asset('/images/vasoplastico.png')); ?>">
                                            <?php $imagenMostrada = true; ?>
                                            <?php break; ?>
                                        <?php case ('ALUMINIO'): ?>
                                            <img class="imagen-producto" src="<?php echo e(asset('/images/rolloaluminio.png')); ?>">
                                            <?php $imagenMostrada = true; ?>
                                            <?php break; ?>
                                        <?php case ('COTILLON'): ?>
                                            <img class="imagen-producto" src="<?php echo e(asset('/images/globos.png')); ?>">
                                            <?php $imagenMostrada = true; ?>
                                            <?php break; ?>
                                        <?php case ('CARTON'): ?>
                                            <img class="imagen-producto" src="<?php echo e(asset('/images/carton.png')); ?>">
                                            <?php $imagenMostrada = true; ?>
                                            <?php break; ?>
                                        <?php case ('EXPANDIDO'): ?>
                                            <img class="imagen-producto" src="<?php echo e(asset('/images/envase.png')); ?>">
                                            <?php $imagenMostrada = true; ?>
                                            <?php break; ?>
                                        <?php case ('LIBRERIA'): ?>
                                            <img class="imagen-producto" src="<?php echo e(asset('/images/libros.png')); ?>">
                                            <?php $imagenMostrada = true; ?>
                                            <?php break; ?>
                                    <?php endswitch; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <strong class="precio">$<?php echo e($detalle->precio_unitario); ?></strong>
                    </div>
                    <div class="info-container">
                        <div class="nombre"><strong><?php echo e($detalle['product']['nombre']); ?></strong></div>
                        <div class="cantidad"><strong>CANTIDAD EN LA VENTA:</strong><span><?php echo e($detalle->cantidad); ?></span></div>
                        <div class="total"><strong>TOTAL VENDIDO:</strong><span>$<?php echo e($detalle->cantidad*$detalle->precio_unitario); ?></span></div>
                        <div class="categoria">
                            <strong>CATEGORIA:</strong>
                            <span>
                                <?php $__currentLoopData = $detalle['product']['categorias']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($categoria['nombre']); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</body>
</html>


<?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\sale.blade.php ENDPATH**/ ?>