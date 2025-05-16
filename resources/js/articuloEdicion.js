window.enviarDatos = function (){
    let parametro = new URLSearchParams(window.location.search);
    let id = parametro.get('id');
    let nombre = document.getElementById("name").value
    let descripcion = document.getElementById("descripcion").value
    let precio = document.getElementById("precio").value
    let categoria_nueva = document.getElementById("categoria_nueva").value
    let categoria_eliminar = document.getElementById("categoria_eliminar").value

    let datos_id = {id:id}

    fetch('/traer-producto', {
        method: 'POST',
        credentials: 'same-origin',
        body: JSON.stringify(datos_id),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
        })
        .then(res => res.json()) 
        .then(data => {

            for(let i=0; i<data.categorias.length; i++ ){
                
                if(data.categorias[i].id == categoria_nueva){
                    Swal.fire({
                        imageUrl: "/images/cancelar.png",
                        imageWidth: 100,
                        imageHeight: 100,
                        confirmButtonText: "ENTENDIDO",
                        confirmButtonColor: '#ff7a01',
                        text: "ESTE PRODUCTO YA CONTIENE ESTA CATEGORIA",
                        backdrop: false, 
                    })

                    return
                    
                }else{

                    let datos = {
                    id:id,
                    nombre: nombre,
                    descripcion:descripcion,
                    precio:precio,
                    categoria_nueva:categoria_nueva,
                    categoria_eliminar:categoria_eliminar
                    };

                    if(nombre == "" && descripcion == "" && precio == "" && categoria_nueva == "default" && categoria_eliminar =="default"){
                        Swal.fire({
                        imageUrl: "/images/cancelar.png",
                        imageWidth: 100,
                        imageHeight: 100,
                        confirmButtonColor: '#ff7a01',
                        confirmButtonText: "ENTENDIDO",
                        text: "DEBE INGRESAR AL MENOS UN DATO A EDITAR",
                        backdrop: false, 
                        })

                        return
                    }
                    
                    if(categoria_eliminar != "default" && data.categorias.length == 1){
                        Swal.fire({
                            imageUrl: "/images/cancelar.png",
                            imageWidth: 100,
                            imageHeight: 100,
                            confirmButtonColor: '#ff7a01',
                            confirmButtonText: "ENTENDIDO",
                            text: "EL PRODUCTO DEBE TENER AL MENOS UNA CATEGORIA",
                            backdrop: false, 
                        })

                        document.getElementById("categoria_eliminar").value = "default"
                    }else{
                        console.log("aaaaaa")

                        Swal.fire({
                        title: "¿DESEA EDITAR ESTE ARTICULO?",
                        showDenyButton: true,
                        imageUrl: "/images/edicion.png",
                        imageWidth: 100,
                        imageHeight: 100,
                        confirmButtonColor: '#ffd087',
                        confirmButtonText: "SI, EDITAR",
                        denyButtonText: "CANCELAR",
                        backdrop: false, 
                        }).then((result) => {
                        if (result.isConfirmed) {
                            
                            //

                            fetch('/edicion/productoeditado', {
                            method: 'PATCH',
                            credentials: 'same-origin',
                            body: JSON.stringify(datos),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Incluir CSRF Token
                            }
                            })
                            .then(res => res.json()) 
                            .then(data => {
                                Swal.fire({
                                    title: "ARTICULO EDITADO CON EXITO",
                                    showConfirmButton: false,
                                    timer: 1500,
                                    backdrop: false, 
                                    imageWidth: 100,
                                    imageHeight: 100,
                                    imageUrl: "/images/ok.png",
                                }).then(() => {
                                    location.reload(); 
                                });

                            })

                            //
                        }});


                    }

                    

                    console.log(datos)

                }
            }
    })

}

