<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA:REGISTRAR EMPLEADO</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/registroempleado.css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/registroempleado.css'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>
    <div class="container">
        <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <a href="<?php echo e(route('inicio')); ?>" class="flecha" title="Volver"><i class="fa-solid fa-chevron-left"></i></a>
        <div class="contain-form">
            <form class="register" id="formulario-register" action="<?php echo e(route('registro.empleado')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <p class="title-producto">REGISTRAR EMPLEADO</p>
                <div class="contenedor-botones">
                    <input type="text" name="name" id="name" placeholder="Nombre">
                <input type="lastname" name="lastname" id="lastname" placeholder="Apellido">
                <input type="text" name="email" id="email" placeholder="Correo electronico">    

                <select name="permission" id="permission" class="permission">
                    <?php $__currentLoopData = $permisos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permiso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($permiso->id); ?>"><?php echo e($permiso->permission); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>
                
                
                <button type="button" onclick="validarRegistroEmpleado()">Registrar</button>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo app('Illuminate\Foundation\Vite')('resources/js/empleado.js'); ?>
</html><?php /**PATH C:\laragon\www\Mabra-descartables\resources\views/registrarempleado.blade.php ENDPATH**/ ?>