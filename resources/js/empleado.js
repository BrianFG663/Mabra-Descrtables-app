window.validarRegistroEmpleado = function () {
    let valorlastname = document.getElementById("lastname").value;
    let valorname = document.getElementById("name").value;
    let valoremail = document.getElementById("email").value;
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(valoremail == "" || valorname == "" || valorlastname == ""){
        Swal.fire({
            icon: "error",
            title: "POR FAVOR COMPLETE TODOS LOS DATOS",
            scrollbarPadding: false
        }); 
    }

    if(valorname !== "" && valorlastname !== "" && !regex.test(valoremail)){
        Swal.fire({
            icon: "error",
            title: "POR FAVOR INTRODUZCA UN MAIL VALIDO",
            scrollbarPadding: false
        }); 
    }

    if(valorname !== "" && valorlastname !== "" && regex.test(valoremail)){
        
        Swal.fire({
            title: "DESEA REGISTRAR EL EMPLEADO?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "REGISTRAR",
            cancelButtonText: "CANCELAR"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "EMPLEADO REGISTRADO",
                icon: "success"
              });
              setTimeout(() => {
                document.getElementById("formulario-register").submit();
              }, "1000");
            }
          });
    }
    

}