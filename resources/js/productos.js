window.validarRegistroProducto = function () {
    let valorname = document.getElementById("name").value.trim();
    let precio = document.getElementById("precio").value.trim();
    let stock = document.getElementById("stock").value.trim();
    let categoria = document.getElementById("categoria").value.trim();

    if (valorname === "") {
        Swal.fire({
            icon: "error",
            title: "EL NOMBRE DEL PRODUCTO ES OBLIGATORIO",
            scrollbarPadding: false
        });
        return;
    }

    if (precio === "") {
        Swal.fire({
            icon: "error",
            title: "EL PRECIO DEL PRODUCTO ES OBLIGATORIO",
            scrollbarPadding: false
        });
        return;
    }

    if (isNaN(precio) || precio.trim() === "") {
        Swal.fire({
            icon: "error",
            title: "SOLO SE PERMITEN NÚMEROS EN EL PRECIO",
            scrollbarPadding: false
        });
        return;
    }

    if (stock.trim() !== "") { // si escribió algo
        if (isNaN(stock)) {
            Swal.fire({
                icon: "error",
                title: "SOLO SE PERMITEN NÚMEROS EN EL STOCK",
                scrollbarPadding: false
            });
            return;
        }
    }

    if (categoria == "default") {
        Swal.fire({
            icon: "error",
            title: "POR FAVOR SELECCIONE UNA CATEGORIA",
            scrollbarPadding: false
        });
        return;
    }

    Swal.fire({
        title: "¿DESEA AGREGAR EL PRODUCTO?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "AGREGAR",
        cancelButtonText: "CANCELAR"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "PRODUCTO REGISTRADO",
                icon: "success",
                showConfirmButton: false,
                timer: 1000
            });
            setTimeout(() => {
                document.getElementById("formulario-producto").submit();
            }, 1000);
        }
    });
}
