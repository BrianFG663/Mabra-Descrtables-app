window.ventasDia = function() {
    let fecha = document.getElementById("fecha_final").value
    if(fecha == ""){
        let hoy = new Date();
        let año = hoy.getFullYear();
        let mes = String(hoy.getMonth() + 1).padStart(2, '0');
        let dia = String(hoy.getDate()).padStart(2, '0');
        document.getElementById('fecha_final').value = `${año}-${mes}-${dia}`;

        fecha = `${año}-${mes}-${dia}`
    }

    console.log(fecha)

    fetch('/ventasdia', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ fecha:fecha }),
        })
        .then(res => res.json()) 
        .then(data => {
            document.getElementById("contenedor-ventas").innerHTML = ""


            console.log(data)
            let vendedor = "";

            data.ventas.forEach((venta, i) => {

                data.vendedor.forEach((user) =>{

                    if(user.id == venta.user_id){
                        vendedor = user.name + " " + user.lastname 
                    }

                    
                })
                console.log(vendedor)
                document.getElementById("contenedor-ventas").innerHTML += 
                `<div class="articulo">
                    <span class="numero-articulo">#${i + 1}</span> 
                    <span class="nombre-articulo">
                        <span>VENDEDORA: ${vendedor.toUpperCase()}</span>
                    </span> 
                    <div class="precio">
                        <span class="pt">CANTIDAD DE ARTICULOS: ${venta.sales_details_count}</span>
                        <span class="pt">TOTAL: $${venta.total}</span>
                    </div>
                    <button class="eliminar-btn" id="eliminar-btn" title="ELIMINAR VENTA" onclick="eliminarVenta(${venta.id})">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                    <button class="ver-btn" id="ver-btn" title="DETALLES DE VENTA" onclick="detalleVenta(${venta.id})">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>`;
            });

            
        })
            


}

window.addEventListener('DOMContentLoaded', ventasDia);


window.eliminarVenta = function(id) {
    Swal.fire({
        imageWidth: 100,
        imageHeight: 100,
        imageUrl: "/images/advertencia.png",
        title: "¿DESEA ELIMINAR ESTA VENTA?",
        text: "¡ESTA ACCION NO SE PUEDE REVERTIR!",
        showCancelButton: true,
        cancelButtonText: "CANCELAR",
        confirmButtonText: "ELIMINAR",
        confirmButtonColor: '#e74938',
        cancelButtonColor: '#ffd087',
         backdrop: false, 
     }).then((result) => {
        if (result.isConfirmed) {
            fetch('/eliminar/venta', {
            method: 'DELETE',
            credentials: 'same-origin',
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
                    title: "VENTA ELIMINADA",
                    imageUrl: "/images/ok.png",
                    imageWidth: 100,
                    imageHeight: 100,
                    showConfirmButton: false,
                    backdrop: false, 
                    timer: 1500
                    });
                    setTimeout(() => {
                        ventasDia()
                    }, 1500);
                }
            })
        }
    })

}

window.detalleVenta = function(id) {
    
    window.location.href = `/detalle/venta?id=${id}`

}

