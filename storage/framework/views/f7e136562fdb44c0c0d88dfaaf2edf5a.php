<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA:AGREGAR ARTICULO</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/registroempleado.css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <a href="<?php echo e(route('inicio')); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
        <div class="contain-form">
            <form class="register" id="formulario-producto" action="<?php echo e(route('registro.producto')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <p class="title-producto">AGREGAR ARTICULO</p>
                <div class="contenedor-botones">
                    <input type="text" name="name" id="name" placeholder="Nombre">
                    <input type="descripcion" name="descripcion" id="descripcion" placeholder="Descripcion">
                    <input type="number" name="precio" id="precio" placeholder="Precio unitario">    
                    <input type="number" name="stock" id="stock" placeholder="Stock disponible">    
                    <select name="categoria" id="categoria" class="permission">
                        <option value="default" selected disabled hidden>Selecciona una categoría</option>
                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <button type="button" onclick="validarRegistroProducto()">AGREGAR</button>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo app('Illuminate\Foundation\Vite')('resources/js/productos.js'); ?>
</html><?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\agregararticulo.blade.php ENDPATH**/ ?>