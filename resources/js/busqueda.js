const input = document.getElementById('buscar');
let timeout = null;

input.addEventListener('input', function() {
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        const query = this.value.trim();

        if (query.length >= 2) {
            fetch(`/buscar-productos?query=${query}`)
            .then(response => response.json())
            .then(data => {
                resultados.innerHTML = '';

                data.slice(0, 3).forEach(producto => {


                    const contenedor = document.createElement('div');
                    contenedor.classList.add('producto-item');
                
                    const nombreDiv = document.createElement('div');
                    nombreDiv.classList.add('producto-nombre');
                    nombreDiv.textContent = `Producto sugerido: ${producto.nombre}`;
                
                    const precioDiv = document.createElement('div');
                    precioDiv.classList.add('producto-precio');
                    precioDiv.textContent = producto.precio !== undefined 
                        ? `Precio: $${parseFloat(producto.precio).toFixed(2)}`
                        : 'Precio no disponible';
            
                
                    contenedor.appendChild(nombreDiv);
                    contenedor.appendChild(precioDiv);

                    let id = producto.id
                    contenedor.dataset.id = producto.id;
                    contenedor.style.cursor = 'pointer';
                    contenedor.addEventListener('click', () => 
                        
                        //
                        
                        
                        fetch('/traer-producto', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ id:id }),
                        })
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById("buscar").value = "";
                            document.getElementById("resultados").innerHTML = '';
                            const imagen = document.createElement('img');
                            imagen.classList.add('img-vacio');

                        
                            if (data.producto.descripcion == "" || data.producto.descripcion == null) {
                                data.producto.descripcion = "Este producto no contiene descripcion.";
                            }
                        
                            let categoriasTexto = "";
                            for (let i = 0; i < data.categorias.length; i++) {
                                categoriasTexto += `${data.categorias[i].nombre}, `;
                        
                                switch (data.categorias[i].nombre.toLowerCase()) {
                                    case "aluminio":
                                        imagen.src = '/images/rolloaluminio.png';
                                    break;

                                    case "papel":
                                        imagen.src = '/images/papel.png';
                                    break;

                                    case "cotillon":
                                        imagen.src = '/images/globos.png';
                                    break;

                                    case "plastico":
                                        imagen.src = '/images/vasoplastico.png';
                                    break;

                                    case "libreria":
                                        imagen.src = '/images/libros.png';
                                    break;

                                    case "expandido":
                                        imagen.src = '/images/envase.png';
                                    break;

                                    case "carton":
                                        imagen.src = '/images/carton.png';
                                    break;
                                }
                            }

                            categoriasTexto = categoriasTexto.replace(/,\s*$/, "");
                            document.getElementById('contenedor').innerHTML = 
                            `<div class="carta">
                                <div class="imagen-container">
                                    <button class="eliminar-btn" onclick="botonEliminar()"><i class="fa-solid fa-xmark"></i></i></button>
                                    <div id="imagen-producto"></div>
                                    <strong class="precio">$${data.producto.precio}</strong>
                                </div>
                                <div class="info-container">
                                    <div class="nombre"><strong >${data.producto.nombre}</strong></div>
                                    <div class="stock"><strong>STOCK DISPONIBLE:</strong><span>${data.producto.stock} UNIDADES</span></div>
                                    <div class="categoria"><strong>CATEGORIA:</strong><span>${categoriasTexto}</span></div>
                                    <div class="descripcion"><strong>DESCRIPCION:</strong><span>${data.producto.descripcion}</span></div>
                                </div>
                            </div>`;

                            document.getElementById("imagen-producto").appendChild(imagen);
                        })
                        


                        //

                    );
                    resultados.appendChild(contenedor);
                });
                
            });
        } else {
            resultados.innerHTML = '';
        }
    }, 300);
});


window.botonEliminar = function () {
    document.getElementById('contenedor').innerHTML = 
    `<div id="carrito" class="carrito">
        <div id="carrito-vacio" class="carrito-vacio"></div>
    </div>`;

const imagen = document.createElement('img');
imagen.classList.add('vacio-img');
imagen.src = 'images/mosca.png';

const span = document.createElement('span');
span.textContent = 'AUN NO SE HAN SELECCIONADO PRODUCTOS';

const carritoVacio = document.getElementById("carrito-vacio");
carritoVacio.appendChild(imagen); // primero la imagen
carritoVacio.appendChild(span);   // luego el texto

document.getElementById("buscar").value = "";
}


window.buscarProductos = function () {
    
    let id = document.getElementById("id-categoria").value

    if(id == "default"){
        Swal.fire({
            imageUrl: "/images/cancelar.png",
            imageWidth: 100,
            imageHeight: 100,
            title: "SELECCIONE UNA CATEGORÍA",
            showConfirmButton: true,
            confirmButtonText: 'ACEPTAR',
            allowOutsideClick: false, 
            backdrop: false, 
            confirmButtonColor: "#ffd087",
            width: 'auto',
            customClass: {
                popup: 'swposition',
            },
        });
    }

    fetch('/traer-productos', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ id:id }),
    })
    .then(res => res.json())
    .then(data => {

        console.log(data.mensaje)
        console.log(data.productos)
        document.getElementById("boton-buscar").outerHTML = `<input type="button" value="ELIMINAR FILTRO" class="eliminar-filtro" id="eliminar-filtro" onclick="cambiarBoton()">`
        document.getElementById("contenedor").innerHTML = `<div class="contenedor-productos" id="contenedor-productos"></div>`;

        if(data.mensaje == 'verdadero'){
            for (let i = 0; i < data.productos.length; i++) {

            const imagen = document.createElement('img');
            imagen.classList.add('img-vacio');
            
            switch (data.categoria.toLowerCase()) {
                case "aluminio":
                    imagen.src = '/images/rolloaluminio.png';
                    break;
                case "papel":
                    imagen.src = '/images/papel.png';
                    break;
                case "cotillon":
                    imagen.src = '/images/globos.png';
                    break;
                case "plastico":
                    imagen.src = '/images/vasoplastico.png';
                    break;
                case "libreria":
                    imagen.src = '/images/libros.png';
                    break;
                case "expandido":
                    imagen.src = '/images/envase.png';
                    break;
                case "carton":
                    imagen.src = '/images/carton.png';
                    break;
            }
        
            const idImagen = `imagen-producto-varios-${i}`;

            if (data.productos[i].descripcion == "" || data.productos[i].descripcion == null) {
                data.productos[i].descripcion = "Este producto no contiene descripcion.";
            }
        
            document.getElementById("contenedor-productos").innerHTML += 
            `<div class="varias-cartas">
                <div class="imagen-container">
                    <div id="${idImagen}" class="imagen-producto-varios"></div>
                    <strong class="precio-varios">$ ${data.productos[i].precio}</strong>
                </div>
                <div class="info-container-varios">
                    <div class="nombre-varios"><div>${data.productos[i].nombre}</div></div>
                    <div class="stock-varios"><strong>STOCK:</strong><span>${data.productos[i].stock} UNIDADES</span></div>
                    <div class="categoria-varios"><strong>CATEGORIA:</strong><span>${data.categoria}</span></div>
                    <div class="descripcion-varios"><strong>DESCRIPCION:</strong><span>${data.productos[i].descripcion}</span></div>
                </div>
            </div>`;
        
            document.getElementById(idImagen).appendChild(imagen);
            }
        }
        
        if(data.mensaje == 'falso'){
            document.getElementById('contenedor').innerHTML = 
            `<div id="carrito" class="carrito">
                <div id="carrito-vacio" class="carrito-vacio"></div>
            </div>`;

            const imagen = document.createElement('img');
            imagen.classList.add('notfound-img');
            imagen.src = 'images/notfound.png';

            const span = document.createElement('span');
            span.textContent = 'NO SE ENCONTRARON PRODUCTOS DE ESTA CATEGORIA';

            const carritoVacio = document.getElementById("carrito-vacio");
            carritoVacio.appendChild(imagen); // primero la imagen
            carritoVacio.appendChild(span);   // luego el texto
        }
        
    })
    


}

window.cambiarBoton = function (){
    
    document.getElementById("eliminar-filtro").outerHTML = `<input type="button" value="FILTRAR" onclick="buscarProductos()" class="boton-buscar" id="boton-buscar">`

    const select = document.getElementById("id-categoria");
    if (select) {
        select.value = "default";
    }


    document.getElementById('contenedor').innerHTML = 
    `<div id="carrito" class="carrito">
        <div id="carrito-vacio" class="carrito-vacio"></div>
    </div>`;

    const imagen = document.createElement('img');
    imagen.classList.add('vacio-img');
    imagen.src = 'images/mosca.png';

    const span = document.createElement('span');
    span.textContent = 'AUN NO SE HAN SELECCIONADO PRODUCTOS';

    const carritoVacio = document.getElementById("carrito-vacio");
    carritoVacio.appendChild(imagen); // primero la imagen
    carritoVacio.appendChild(span);   // luego el texto

}