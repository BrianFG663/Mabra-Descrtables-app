<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MABRA:INICIO SESION</title>
    <link rel="icon" href="<?php echo e(asset('images/iconos/letra-m.png')); ?>" type="image/png">
</head>
<body>

    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> 
    <div class="wrapper">
        <div class="contain-form">
            <form class="login" id="formulario-login" action="<?php echo e(route('route.login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="text" name="email" id="email" placeholder="Correo electronico">
                <input type="password" name="password" id="password" placeholder="Contraseña">
                <button type="button" onclick="validarLogin()">Iniciar sesión</button>
            </form>
        </div>
    </div>


    
    
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo app('Illuminate\Foundation\Vite')('resources/js/login.js'); ?>
<?php echo app('Illuminate\Foundation\Vite')('resources/css/login.css'); ?>
</html>
<?php /**PATH C:\laragon\www\Mabra-descartables\resources\views\login.blade.php ENDPATH**/ ?>