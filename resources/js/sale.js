window.eliminarProducto = function(id,sale_id){
    console.log(sale_id)

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
            if (result.isConfirmed){


                fetch('/eliminar/producto/venta', {
                method: 'DELETE',
                credentials: 'same-origin',
                body: JSON.stringify({id:id,sale_id:sale_id}),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
                })
                .then(res => res.json()) 
                .then(data => {
                    console.log(data)
                     Swal.fire({
                        title: "ARTICULO ELIMINADO CON EXITO",
                        showConfirmButton: false,
                        timer: 1500,
                        backdrop: false, 
                        imageWidth: 100,
                        imageHeight: 100,
                        imageUrl: "/images/ok.png",
                        didClose: () => {
                            if (data.detalles === "true") {
                                location.reload();
                            } else {
                                window.location.href = '/regristroventas';
                            }
                        }
                    })
                })


            }
        })

    
}