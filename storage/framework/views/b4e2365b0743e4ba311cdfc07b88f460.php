<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA:EDITAR PRODUCTO</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/formularioEdicion.css'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/articuloEdicion'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <a href="<?php echo e(route('formulario.edicion')); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
    <div class="mensaje">
        <img src="<?php echo e(asset('/images/idea.png')); ?>" alt=""><strong>Recuerda:</strong><span>¡No es necesario editar todos los datos a la vez! Puedes hacer cambios de a uno y guardarlos cuando estés listo.</span>
    </div>
    <div class="contenedor">
        <div class="carta">
            <div class="imagen-container">
                <div id="imagen-producto">
                <?php $imagenMostrada = false; ?>
                    <?php $__currentLoopData = $categorias_producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria_producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!$imagenMostrada): ?>
                            <?php switch($categoria_producto->nombre):
                                case ('PAPEL'): ?>
                                    <img class="img-vacio" src="<?php echo e(asset('/images/papel.png')); ?>">
                                    <?php $imagenMostrada = true; ?>
                                    <?php break; ?>
                                <?php case ('PLASTICO'): ?>
                                    <img class="img-vacio" src="<?php echo e(asset('/images/vasoplastico.png')); ?>">
                                    <?php $imagenMostrada = true; ?>
                                    <?php break; ?>
                                <?php case ('ALUMINIO'): ?>
                                    <img class="img-vacio" src="<?php echo e(asset('/images/rolloaluminio.png')); ?>">
                                    <?php $imagenMostrada = true; ?>
                                    <?php break; ?>
                                <?php case ('COTILLON'): ?>
                                    <img class="img-vacio" src="<?php echo e(asset('/images/globos.png')); ?>">
                                    <?php $imagenMostrada = true; ?>
                                    <?php break; ?>
                                <?php case ('CARTON'): ?>
                                    <img class="img-vacio" src="<?php echo e(asset('/images/carton.png')); ?>">
                                    <?php $imagenMostrada = true; ?>
                                    <?php break; ?>
                                <?php case ('EXPANDIDO'): ?>
                                    <img class="img-vacio" src="<?php echo e(asset('/images/envase.png')); ?>">
                                    <?php $imagenMostrada = true; ?>
                                    <?php break; ?>
                                <?php case ('LIBRERIA'): ?>
                                    <img class="img-vacio" src="<?php echo e(asset('/images/libros.png')); ?>">
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
                <div class="categoria">
                    <strong>CATEGORIA:</strong>
                    <span>
                        <?php $__currentLoopData = $categorias_producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria_producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           [ <?php echo e($categoria_producto->nombre); ?> ]
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </span>
                </div>
                <div class="descripcion">
                    <strong>DESCRIPCION:</strong>
                    <?php if($producto->descripcion == "" || $producto->descripcion == null): ?>
                        <span>Este producto no contiene descripcion.</span>
                    <?php else: ?>
                        <span><?php echo e($producto->descripcion); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

            <form class="register" id="formulario-edicion" action="<?php echo e(route('registro.producto')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <p class="title-producto">EDITAR ARTICULO</p>
                <div class="inputs">
                    <input type="text" name="name" id="name" placeholder="Nombre">
                    <input type="descripcion" name="descripcion" id="descripcion" placeholder="Descripcion">
                    <input type="number" name="precio" id="precio" placeholder="Precio unitario">       
                    <select name="categoria-nueva" id="categoria_nueva" class="permission">
                        <option value="default" selected disabled hidden>AGREGAR CATEGORIA</option>
                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select name="categoria" id="categoria_eliminar" class="permission">
                        <option value="default" selected disabled hidden>ELIMINAR CATEGORIA</option>
                        <?php $__currentLoopData = $categorias_producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria_producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($categoria_producto->id); ?>"><?php echo e($categoria_producto->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>   
                </div>  
                <button type="button" onclick="enviarDatos()">EDITAR ARTICULO</button>
            </form>
    </div>    
</body>
</html><?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\formularioEditarProducto.blade.php ENDPATH**/ ?>