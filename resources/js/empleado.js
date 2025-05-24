window.validarRegistroEmpleado = function () {
  let valorlastname = document.getElementById("lastname").value;
  let valorname = document.getElementById("name").value;
  let valoremail = document.getElementById("email").value;
  var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (valoremail == "" || valorname == "" || valorlastname == "") {
    Swal.fire({
      title: "¡ERROR!",
      text: "Por favor complete el formulario.",
      showConfirmButton: true,
      confirmButtonColor: '#ff7c019a',
      backdrop: false,
      confirmButtonText: "ENTENDIDO",
      imageWidth: 100,
      imageHeight: 100,
      imageUrl: "/images/error.png",
    })
  }

  if (valorname !== "" && valorlastname !== "" && !regex.test(valoremail)) {
    Swal.fire({
      title: "¡ERROR!",
      text: "Por favor ingrese un E-MAIL valido",
      showConfirmButton: true,
      confirmButtonColor: '#ff7c019a',
      backdrop: false,
      confirmButtonText: "ENTENDIDO",
      imageWidth: 100,
      imageHeight: 100,
      imageUrl: "/images/error.png",
    })
  }

  if (valorname !== "" && valorlastname !== "" && regex.test(valoremail)) {



    fetch('/buscarempleado', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ correo: valoremail }),
    })
      .then(res => res.json())
      .then(data => {
        if (data.mensaje == "true") {
          Swal.fire({
            title: "DESEA REGISTRAR EL EMPLEADO?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "REGISTRAR",
            cancelButtonText: "CANCELAR",
            backdrop: false
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
        } else {
          Swal.fire({
            title: "¡ERROR!",
            text: "Ya hay un empleado registrado con este correo.",
            showConfirmButton: true,
            confirmButtonColor: '#ff7c019a',
            backdrop: false,
            confirmButtonText: "ENTENDIDO",
            imageWidth: 100,
            imageHeight: 100,
            imageUrl: "/images/error.png",
          })
        }

      })
  }


}