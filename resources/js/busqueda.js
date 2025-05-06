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

                data.slice(0, 6).forEach(producto => {


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
                            document.getElementById('producto').innerHTML = 
                            `<span class="nombre">${data.producto.nombre}</span>
                            <span class="descripcion">${data.producto.descripcion}</span>
                            <span class="precio">${data.producto.precio}</span>
                            <span class="stock">${data.producto.stock}</span>
                            <span id="categorias">Categoria/s: </span>`

                            for(let i=0; i<data.categorias.length; i++){
                                document.getElementById('categorias').innerHTML += 
                            `${data.categorias[i].nombre},`
                            }
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