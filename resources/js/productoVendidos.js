window.todasCategorias = function() {

    fetch('/productosvendidos', {
        method: 'GET',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        })
        .then(res => res.json()) 
        .then(data => {
            let contenedor = document.getElementById('contenedor-productos');
            contenedor.innerHTML = ''; // Limpia el contenido anterior si es necesario
            const productos = data.productos;
            let htmlTotal = '';

            productos.forEach(data => {
                let categoriasTexto = '';
                let imagenSrc = '';

                data.product.categorias.forEach(cat => {
                    categoriasTexto += `${cat.nombre}, `;

                    switch (cat.nombre.toLowerCase()) {
                        case "aluminio":
                            imagenSrc = '/images/rolloaluminio.png';
                            break;
                        case "papel":
                            imagenSrc = '/images/papel.png';
                            break;
                        case "cotillon":
                            imagenSrc = '/images/globos.png';
                            break;
                        case "plastico":
                            imagenSrc = '/images/vasoplastico.png';
                            break;
                        case "libreria":
                            imagenSrc = '/images/libros.png';
                            break;
                        case "expandido":
                            imagenSrc = '/images/envase.png';
                            break;
                        case "carton":
                            imagenSrc = '/images/carton.png';
                            break;
                    }
                });

                // Elimina la última coma y espacio
                categoriasTexto = categoriasTexto.replace(/,\s*$/, "");

                htmlTotal += `
                <div class="carta">
                    <div class="imagen-container">
                        <div id="imagen-producto"><img class="imagen-producto" src="${imagenSrc}" alt="Imagen producto"></div>
                        <strong class="precio">$${data.product.precio}</strong>
                    </div>
                    <div class="info-container">
                        <div class="nombre"><strong>${data.product.nombre}</strong></div>
                        <div class="vendido"><strong>TOTAL VENDIDO:</strong><span>${data.total_vendido} UNIDADES</span></div>
                        <div class="categoria"><strong>CATEGORÍA:</strong><span>${categoriasTexto}</span></div>
                        <div class="total"><strong>TOTAL RECAUDADO:</strong><span>$${data.total_recaudado}</span></div>
                    </div>
                </div>`;
            });

            // Insertamos todo junto al final
            contenedor.innerHTML = htmlTotal;

                
        })


}

window.addEventListener('DOMContentLoaded', todasCategorias);

window.buscarProductosCategoria = function () {
    let id = document.getElementById("id-categoria").value
    let fecha = document.getElementById("fecha_final").value

    function esFechaPosteriorAHoy(fechaStr) {
    const hoy = new Date();
    hoy.setHours(0, 0, 0, 0); // Reseteamos la hora a medianoche

    // Descomponemos fecha ingresada
    const [anio, mes, dia] = fechaStr.split('-').map(Number);
    const fechaIngresada = new Date(anio, mes - 1, dia); // Mes empieza en 0
    fechaIngresada.setHours(0, 0, 0, 0);

    return fechaIngresada > hoy;
    }

// Validación en tu función principal
if (esFechaPosteriorAHoy(fecha)) {
    Swal.fire({
            imageUrl: "/images/error.png",
            imageWidth: 100,
            imageHeight: 100,
            confirmButtonColor: '#ffd087',
            confirmButtonText: "ENTENDIDO",
            title:"¡ERROR!",
            text: "¡ESA FECHA AUN NO HA PASADO!",
            backdrop: false, 
        })
    return;
}


    if(fecha == ""){
        fecha = "2020-01-01"
    }

    if(id == "default"){
        Swal.fire({
            title: "POR FAVOR SELECCIONE UNA CATEGORIA PARA FILTRAR",
            showConfirmButton: true,
            confirmButtonColor: '#ff7c019a',
            backdrop: false,
            confirmButtonText:"ENTENDIDO",
            imageWidth: 100,
            imageHeight: 100,
            imageUrl: "/images/cancelar.png",
        })
        return;
    }

    document.getElementById("boton-buscar").outerHTML = `<input type="button" value="ELIMINAR FILTRO" class="eliminar-filtro" id="eliminar-filtro" onclick="cambiarBoton()">`
    console.log(fecha)

    fetch('/categoriasvendidos', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(
            {id:id,
            fecha:fecha}
        )
        })
        .then(res => res.json()) 
        .then(data => {
            console.log(data)

            let contenedor = document.getElementById('contenedor-productos');
            if (data.productos.length === 0) {
                console.log("aaaaa");

                contenedor.innerHTML = `<div id="carrito" class="carrito"><div class="carrito-vacio" id="carrito-vacio"></div></div>`;

                const vacio = document.getElementById('carrito-vacio');
                if (vacio) {
                    const imagen = document.createElement('img');
                    imagen.classList.add('img-vacio');
                    imagen.src = '/images/mosca.png';

                    const texto = document.createElement('span');
                    texto.textContent = 'NO SE ENCONTRARON PRODUCTOS DE ESA CATEGORIA';

                    vacio.appendChild(imagen);
                    vacio.appendChild(texto);
                } else {
                    console.error("No se encontró #carrito-vacio");
                }

                return;
            }

            const productos = data.productos;
            let htmlTotal = '';

            productos.forEach(data => {
                let categoriasTexto = '';
                let imagenSrc = '';

                data.product.categorias.forEach(cat => {
                    categoriasTexto += `${cat.nombre}, `;

                    switch (cat.nombre.toLowerCase()) {
                        case "aluminio":
                            imagenSrc = '/images/rolloaluminio.png';
                            break;
                        case "papel":
                            imagenSrc = '/images/papel.png';
                            break;
                        case "cotillon":
                            imagenSrc = '/images/globos.png';
                            break;
                        case "plastico":
                            imagenSrc = '/images/vasoplastico.png';
                            break;
                        case "libreria":
                            imagenSrc = '/images/libros.png';
                            break;
                        case "expandido":
                            imagenSrc = '/images/envase.png';
                            break;
                        case "carton":
                            imagenSrc = '/images/carton.png';
                            break;
                    }
                });

                // Elimina la última coma y espacio
                categoriasTexto = categoriasTexto.replace(/,\s*$/, "");

                htmlTotal += `
                <div class="carta">
                    <div class="imagen-container">
                        <div id="imagen-producto"><img class="imagen-producto" src="${imagenSrc}" alt="Imagen producto"></div>
                        <strong class="precio">$${data.product.precio}</strong>
                    </div>
                    <div class="info-container">
                        <div class="nombre"><strong>${data.product.nombre}</strong></div>
                        <div class="vendido"><strong>TOTAL VENDIDO:</strong><span>${data.total_vendido} UNIDADES</span></div>
                        <div class="categoria"><strong>CATEGORÍA:</strong><span>${categoriasTexto}</span></div>
                        <div class="total"><strong>TOTAL RECAUDADO:</strong><span>$${data.total_recaudado}</span></div>
                    </div>
                </div>`;
            });

            // Insertamos todo junto al final
            contenedor.innerHTML = htmlTotal;

                




            //
        })

}

window.cambiarBoton = function(){
    document.getElementById("eliminar-filtro").outerHTML = `<input type="button" value="FILTRAR" onclick="buscarProductosCategoria()" class="boton-buscar" id="boton-buscar">`
    todasCategorias()

    const select = document.getElementById('id-categoria');

    const opcionDefault = document.createElement('option');
    opcionDefault.value = 'default';
    opcionDefault.selected = true;
    opcionDefault.disabled = true;
    opcionDefault.hidden = true;
    opcionDefault.textContent = 'Selecciona una categoría';
    select.insertBefore(opcionDefault, select.firstChild);

    document.getElementById('fecha_final').value = '';

}