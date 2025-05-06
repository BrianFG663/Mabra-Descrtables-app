window.validarLogin = function () {

    let valoremail = document.getElementById("email").value;
    let valorpass = document.getElementById("password").value;
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (valoremail !== "") {
        if (regex.test(valoremail)) {
            if (valorpass !== "") {
                // Crear un objeto con los datos del formulario
                let datos = {
                    email: valoremail,
                    password: valorpass
                };

                fetch('/logincontroller', {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: JSON.stringify(datos), // Enviar los datos como JSON
                    headers: {
                        'Content-Type': 'application/json', // Especifica que el contenido es JSON
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Incluir CSRF Token
                    }
                })
                .then(res => res.json()) 
                .then(data => {
                    if (data.mensaje === "verdadero") {
                        window.location.href = data.url;
                    }

                    if (data.mensaje === "falso") {
                        Swal.fire({
                            icon: "error",
                            title: "Email o contraseña incorrecta",
                            scrollbarPadding: false
                        });
                    }
                })
                .catch(err => {
                    console.error("Error al enviar solicitud:", err);
                });
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Por favor ingrese la contraseña",
                    scrollbarPadding: false
                });
            }
        } else {
            Swal.fire({
                icon: "warning",
                title: "Correo electrónico inválido",
                scrollbarPadding: false
            });
        }
    } else {
        Swal.fire({
            icon: "warning",
            title: "Por favor ingrese su correo electrónico",
            scrollbarPadding: false
        });
    }
}

