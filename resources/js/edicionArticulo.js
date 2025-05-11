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
                            `<div class="contenedor-carta">
                                <div class="carta-edicion">
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
                                </div>
                                <div class="botones-edicion">
                                    <button id="btn-editar" onclick="" class="btn-editar">EDITAR</button>
                                    <button id="btn-eliminar" onclick="" class="btn-eliminar">ELIMINAR</button>
                                </div>
                            </div>`;

                            document.getElementById("imagen-producto").appendChild(imagen);




                            document.getElementById("btn-editar").addEventListener('click', function() {
                                window.location.href = `/edicion/producto?id=${id}`
                            })
                            
                        })
                    );
                    resultados.appendChild(contenedor);
                });
                
            });
        } else {
            resultados.innerHTML = '';
        }
    }, 300);
});