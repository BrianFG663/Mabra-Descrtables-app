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
                            document.getElementById('imagen-container').innerHTML = '';
                            document.getElementById('imagen-container').innerHTML += 
                            `<button class="eliminar-btn" onclick="botonEliminar()"><i class="fa-solid fa-xmark"></i></i></button>
                            <div id="imagen-producto"></div>
                            <strong class="precio">$ ${data.producto.precio}</strong>`;

                            document.getElementById('nombre').innerHTML = `<strong >${data.producto.nombre}</strong>`;
                            document.getElementById('strong-stock').innerHTML = `STOCK DISPONIBLE: ${data.producto.stock}`;
                            document.getElementById('strong-categoria').innerHTML = `CATEGORIA: ${categoriasTexto}`;
                            document.getElementById('strong-descripcion').innerHTML = `DESCRIPCION: ${data.producto.descripcion}`;;
                            document.getElementById("imagen-producto").appendChild(imagen);


                            document.getElementById("btn-editar").addEventListener('click', function() {
                                window.location.href = `/edicion/producto?id=${id}`
                            })

                            document.getElementById("btn-eliminar").addEventListener('click', function() {
                                

                                Swal.fire({
                                imageWidth: 100,
                                imageHeight: 100,
                                imageUrl: "/images/advertencia.png",
                                title: "¿DESEA ELIMINAR ESTE PRODUCTO?",
                                text: "¡ESTA ACCION NO SE PUEDE REVERTIR!",
                                showCancelButton: true,
                                cancelButtonText: "CANCELAR",
                                confirmButtonText: "ELIMINAR",
                                confirmButtonColor: '#e74938',
                                cancelButtonColor: '#ffd087',
                                backdrop: false, 
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    console.log(id)
                                    fetch('/eliminarProducto', {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: JSON.stringify({ id:id }),
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        if(data.mensaje == "verdadero"){
                                            Swal.fire({
                                                title: "ARTICULO ELIMINADO CON EXITO",
                                                showConfirmButton: false,
                                                timer: 1500,
                                                backdrop: false, 
                                                imageWidth: 100,
                                                imageHeight: 100,
                                                imageUrl: "/images/ok.png",
                                            }).then(() => {
                                                location.reload(); 
                                            });
                                        }
                                    }) //

                                }});


                                        
                                                
                                    })
                            

                        })//
                        
                        

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

window.botonEliminar = function() {
    document.getElementById("contenedor-carta").innerHTML = 
    `<div class="carta-edicion">
        <div class="imagen-container" id="imagen-container"></div>
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
    </div>`;

    const imagen = document.createElement('img');
    imagen.classList.add('img-vacio-prueba');
    imagen.src = '/images/mosca.png';
    document.getElementById("imagen-container").appendChild(imagen)
}