window.validarEdicionPrecio = function() {
    let [id, nombre] = document.getElementById("categoria").value.split('|');
    let porcentaje = document.getElementById("porcentaje").value
    let accion = document.getElementById("accion").value.toUpperCase();


    if(porcentaje == ""){
        Swal.fire({
            title: "POR FAVOR INGRESE UN VALOR",
            showConfirmButton: true,
            confirmButtonColor: '#ff7c019a',
            backdrop: false, 
            imageWidth: 100,
            imageHeight: 100,
            imageUrl: "/images/cancelar.png",
        })
        return;
    }

    if(porcentaje <= 0){
        Swal.fire({
            title: "EL VALOR INGRESADO DEBE SER MAYOR A CERO",
            showConfirmButton: true,
            confirmButtonColor: '#ff7c019a',
            backdrop: false, 
            imageWidth: 100,
            imageHeight: 100,
            imageUrl: "/images/cancelar.png",
        })
        return;
    }

    if(accion == "default"){
        Swal.fire({
            title: "POR FAVOR SELECCIONE UN VALOR",
            showConfirmButton: true,
            confirmButtonColor: '#ff7c019a',
            backdrop: false, 
            imageWidth: 100,
            imageHeight: 100,
            imageUrl: "/images/cancelar.png",
        })
        return;
    }

    if(nombre == undefined){
        
        Swal.fire({
            title: "POR FAVOR SELECCIONE UNA CATEGORIA",
            showConfirmButton: true,
            confirmButtonColor: '#ff7c019a',
            backdrop: false, 
            imageWidth: 100,
            imageHeight: 100,
            imageUrl: "/images/cancelar.png",
        })
        return;
    }

    Swal.fire({
        imageWidth: 100,
        imageHeight: 100,
        imageUrl: "/images/advertencia.png",
        title: `¿DESEA REALIZAR UNA ${accion} DEL ${porcentaje}% EN LOS PRECIO DE LA CATEGORIA ${nombre.toUpperCase()}?`,
        text:"¡Esta acciones irreversible!",
        showCancelButton: true,
        cancelButtonText: "CANCELAR",
        confirmButtonText: "ACTUALIZAR",
        confirmButtonColor: '#ffd087',
        cancelButtonColor: '#e74938',
        backdrop: false, 
    }).then((result) => {
        if(result.isConfirmed){
            console.log("aaaaaaa")
            document.getElementById("formulario-precio").submit()
        }
    })

    



}