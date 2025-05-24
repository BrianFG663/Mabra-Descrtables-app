<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>MABRA: CONTROL DE STOCK</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/sale.css'); ?>
</head>
<body>
    

 <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <a href="<?php echo e(route("inicio")); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="contenedor" id="contenedor">
        <h2 class="tittle-contenedor">PRODUCTOS CON FALTA DE STOCK</h2>
        <div class="contenedor-productos" id="contenedor-productos">
            <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carta">
                    <div class="imagen-container">
                        <div id="imagen-producto">
                            <?php $imagenMostrada = false; ?>
                            <?php $__currentLoopData = $producto['categorias']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <strong class="precio">$<?php echo e($producto->precio); ?></strong>
                                </div>
                    <div class="info-container">
                    <div class="nombre"><strong ><?php echo e($producto->nombre); ?></strong></div>
                    <div class="stock"><strong>STOCK DISPONIBLE:</strong><span><?php echo e($producto->stock); ?> UNIDADES</span></div>
                    <div class="categoria">
                    <strong>CATEGORIA:</strong>
                        <span>
                            <?php $__currentLoopData = $producto['categorias']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($categoria['nombre']); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                    </div>
                    <div class="descripcion"><strong>DESCRIPCION:</strong><span><?php echo e($producto->descripcion); ?></span></div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
</body>
</html>


<?php /**PATH C:\laragon\www\Mabra-descartables\resources\views/controlStock.blade.php ENDPATH**/ ?>