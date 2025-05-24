window.validarRegistroProducto = function () {
    let valorname = document.getElementById("name").value.trim();
    let precio = document.getElementById("precio").value.trim();
    let stock = document.getElementById("stock").value.trim();
    let categoria = document.getElementById("categoria").value.trim();

    if (valorname === "") {
        Swal.fire({
            imageUrl: "/images/error.png",
            imageWidth: 100,
            imageHeight: 100,
            backdrop: false, 
            title: "¡ERROR!",
            text: "El nombre del producto es obligatorio.",
            scrollbarPadding: false
        });
        return;
    }

    if (precio === "") {
        Swal.fire({
            imageUrl: "/images/error.png",
            imageWidth: 100,
            backdrop: false, 
            imageHeight: 100,
            title: "¡ERROR!",
            text: "El precio del producto es obligatorio.",
            scrollbarPadding: false
        });
        return;
    }

    if (isNaN(precio) || precio.trim() === "") {
        Swal.fire({
            imageUrl: "/images/error.png",
            imageWidth: 100,
            imageHeight: 100,
            title: "¡ERROR!",
            backdrop: false, 
            text: "El precio solo permite numeros.",
            scrollbarPadding: false
        });
        return;
    }

    if (stock.trim() !== "") { 
        if (isNaN(stock)) {
            Swal.fire({
            imageUrl: "/images/error.png",
            imageWidth: 100,
            imageHeight: 100,
            title: "¡ERROR!",
            backdrop: false, 
            text: "El stock solo permite numeros.",
            scrollbarPadding: false
        });
            return;
        }
    }

    if (categoria == "default") {
        Swal.fire({
            imageUrl: "/images/error.png",
            imageWidth: 100,
            imageHeight: 100,
            backdrop: false, 
            title: "¡ERROR!",
            text: "Debe seleccionar una categoria para el producto.",
            scrollbarPadding: false
        });
        return;
    }

    Swal.fire({
        title: "¿DESEA AGREGAR EL PRODUCTO?",
        imageUrl: "/images/advertencia.png",
        imageWidth: 100,
        imageHeight: 100,
        backdrop: false, 
        showCancelButton: true,
        confirmButtonColor: "#ffd087",
        cancelButtonColor: "#d33",
        confirmButtonText: "AGREGAR",
        cancelButtonText: "CANCELAR"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "PRODUCTO REGISTRADO",
                imageUrl: "/images/ok.png",
                imageWidth: 100,
                imageHeight: 100,
                showConfirmButton: false,
                backdrop: false, 
                timer: 1000
            });
            setTimeout(() => {
                document.getElementById("formulario-producto").submit();
            }, 1000);
        }
    });
}
