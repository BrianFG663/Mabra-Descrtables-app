const input = document.getElementById('buscar');
const resultados = document.getElementById('resultados');
const carrito = document.getElementById('carrito');
const enviarBtn = document.getElementById('enviar-carrito');
var contador =0

let timeout = null;
let productosCarrito = [];
var total = 0;

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
                    nombreDiv.textContent = producto.nombre;
                
                    const precioDiv = document.createElement('div');
                    precioDiv.classList.add('producto-precio');
                    precioDiv.textContent = producto.precio !== undefined 
                        ? `PRECIO: $${parseFloat(producto.precio).toFixed(2)}`
                        : 'Precio no disponible';
                
                
                    contenedor.appendChild(nombreDiv);
                    contenedor.appendChild(precioDiv);
                
                    contenedor.dataset.id = producto.id;
                    contenedor.style.cursor = 'pointer';
                    contenedor.addEventListener('click', () => agregarAlCarrito(producto));
                
                    resultados.appendChild(contenedor);
                });
                
            });
        } else {
            resultados.innerHTML = '';
        }
    }, 300);
});


function agregarAlCarrito(producto) {
    const encontrado = productosCarrito.find(p => p.id === producto.id);
    if (encontrado) {
        encontrado.cantidad++;
    } else {
        productosCarrito.push({ id: producto.id, nombre: producto.nombre, cantidad: 1 ,precio: producto.precio});
    }

    console.log('Productos en carrito después de agregar:', productosCarrito); // Mostrar array actualizado
    renderizarCarrito();
    resultados.innerHTML = '';
    input.value = '';
}

function sumarCantidad(id) {
    const producto = productosCarrito.find(p => p.id === id);
    if (producto) {
        producto.cantidad++;
        console.log('Productos en carrito después de sumar:', productosCarrito); // Mostrar array actualizado
        renderizarCarrito();
    }
}

function restarCantidad(id) {
    const producto = productosCarrito.find(p => p.id === id);
    if (producto) {
        if (producto.cantidad > 1) {
            producto.cantidad--;
        } else {
            productosCarrito = productosCarrito.filter(p => p.id !== id);
        }
        console.log('Productos en carrito después de restar o eliminar:', productosCarrito); // Mostrar array actualizado
        renderizarCarrito();
    }
}

function eliminarProducto(id) {
    productosCarrito = productosCarrito.filter(p => p.id !== id);
    console.log('Productos en carrito después de eliminar:', productosCarrito); // Mostrar array actualizado
    renderizarCarrito();
}

function renderizarCarrito() {
    carrito.innerHTML = '';
    let totalCalculado = 0;

    if (productosCarrito.length === 0) {
        
        const mensajeVacio = document.createElement('div');
        mensajeVacio.classList.add('carrito-vacio');

        const imagen = document.createElement('img');
        imagen.src = '/images/caja-vacia.png';
        imagen.classList.add('img-vacio');
        imagen.width = 64;
        imagen.height = 64;

        const texto = document.createElement('span');
        texto.textContent = 'AUN NO SE HAN SELECCIONADO PRODUCTOS';

        mensajeVacio.appendChild(imagen);
        mensajeVacio.appendChild(texto);
        carrito.appendChild(mensajeVacio);


        // También limpiamos el total
        const totalDiv = document.getElementById('total-carrito');
        totalDiv.innerHTML = '<span>TOTAL: $0.00</span>';
        return;
    }


    productosCarrito.forEach((producto,index) => {
        totalCalculado += producto.precio * producto.cantidad;
        contador++
        const li = document.createElement('div');
        li.innerHTML = `<div class="articulo">
            <span class="numero-articulo">#${index + 1}</span> 
            <span class="nombre-articulo">${producto.nombre}</span> 
            <div class="botones">
                <button class="restar-btn" data-id="${producto.id}"><i class="fa-regular fa-square-minus"></i></button>
                <div class="cantidad">${producto.cantidad}</div>
                <button class="sumar-btn" data-id="${producto.id}"><i class="fa-regular fa-square-plus"></i></button>
            </div>
            <div class="precio">
                <span class="pu">PRECION UNITARIO: $ ${producto.precio}</span>
                <span class="pt">TOTAL: $ ${(parseFloat(producto.precio) * producto.cantidad).toFixed(2)}</span>
            </div>
            <button class="eliminar-btn" data-id="${producto.id}"><i class="fa-regular fa-trash-can"></i></button>
        </div>`;
        carrito.appendChild(li);
    });

    // Mostrar el total en pantalla
    const totalDiv = document.getElementById('total-carrito');
    totalDiv.innerHTML = `<span>TOTAL: $${totalCalculado.toFixed(2)}</span>`;

    // Actualizar la variable total
    total = totalCalculado;

    // Eventos de botones
    document.querySelectorAll('.sumar-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            const id = e.currentTarget.dataset.id;
            sumarCantidad(parseInt(id));
        });
    });
    
    document.querySelectorAll('.restar-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            const id = e.currentTarget.dataset.id;
            restarCantidad(parseInt(id));
        });
    });
    
    document.querySelectorAll('.eliminar-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            const id = e.currentTarget.dataset.id;
            Swal.fire({
                imageWidth: 100,
                imageHeight: 100,
                imageUrl: "/images/advertencia.png",
                title: "¿QUITAR ESTE PRODUCTO DE LA VENTA?",
                showCancelButton: true,
                cancelButtonText: "CONSERVAR",
                confirmButtonText: "QUITAR PRODUCTO",
                confirmButtonColor: '#e74938',
                cancelButtonColor: '#ffd087',
                backdrop: false, 
            }).then((result) => {
                if (result.isConfirmed) {
                eliminarProducto(parseInt(id));
            }
            })
            
        });
    });
    

    console.log('Estado final del carrito después de renderizar:', productosCarrito);
}


enviarBtn.addEventListener('click', function() {
    if (productosCarrito.length === 0) {
        Swal.fire({
            title: "CARRITO DE VENTA VACIO",
            text:"Por favor agregue un producto",
            showConfirmButton: true,
            confirmButtonColor: '#ff7c019a',
            backdrop: false, 
            imageWidth: 100,
            imageHeight: 100,
            imageUrl: "/images/carro-vacio.png",
        })
        return;
    }

    Swal.fire({
        imageWidth: 100,
        imageHeight: 100,
        imageUrl: "/images/venta.png",
        title: "¿DESEA REGISTRAR ESTA VENTA?",
        showCancelButton: true,
        cancelButtonText: "CANCELAR",
        confirmButtonText: "REGISTRAR",
        confirmButtonColor: '#e74938',
        cancelButtonColor: '#ffd087',
        backdrop: false, 
    }).then((result) => {
        if (result.isConfirmed) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/ventasregistrar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ 
                    total:total,
                    productos: productosCarrito })
            })
            .then(response => {
                console.log(response); 
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    title: "VENTA REAGISTRRADA",
                    showConfirmButton: false,
                    timer: 1500,
                    backdrop: false, 
                    imageWidth: 100,
                    imageHeight: 100,
                    imageUrl: "/images/venta-ok.png",
                })
                productosCarrito = [];
                renderizarCarrito();
            }).catch(error => {
                console.error('Error registrando la venta:', error);
                alert('Error al registrar la venta.');
            });
        }
    })
});

