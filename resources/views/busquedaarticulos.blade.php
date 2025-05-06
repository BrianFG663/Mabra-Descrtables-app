<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="buscador">
        <input class="input-buscador" type="text" id="buscar" placeholder="Buscar producto..." autocomplete="off">
        <div id="resultados" class="resultados"></div>
    </div>

    <div id="producto">

    </div>
</body>
@vite('resources/js/busqueda.js')
</html>