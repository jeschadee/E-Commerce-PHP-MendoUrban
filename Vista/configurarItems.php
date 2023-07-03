<?php
include_once "../Funciones/funciones.php";
ChequearAdmin();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Css/general.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>MendoUrban - Usuario Logueado</title>
</head>

<body id="Inicio">
    <nav>
        <div class="logo">
            <img src="../Imagenes/logo.jpg" alt="logo MendoUrban" class="">
        </div>
        <div class="menues">
            <a class="direcciones" href="Index.php" class="seccion">Inicio</a>
            <a class="direcciones" href="DashBoards.html" class="seccion">DashBoards</a>
            <div class="dropdown-center">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-user-gear"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="" configuracion.html>Configuracion</a></li>
                    <li><a class="dropdown-item" href="configurarItems.php">Configurar Items</a></li>
                </ul>
            </div>
            <div class="carrito">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div class="logout">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
        </div>
    </nav>
    <h1 style="text-align: center;padding: 1em;color:white;">Editar Items</h1>
    <div class="contenedorBotones">
        <button id="agregarItems">Agregar Nuevo Item</button>
    </div>
    <div class="contenedor-sombra ContenedorDeProductos" id="ContenedorDeProductos">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script>
    ActualizarArticulos();

    function ActualizarArticulos() {
        let TiposArticulo = JSON.parse('<?php include_once "../Funciones/funciones.php";
        echo json_encode(traerTiposArticulos());?>');        
        $.ajax({
            method: "GET",
            url: "../Funciones/TraerArticulos.php",
            success: function(data) {
                let articulos
                if (data != "") {
                    articulos = JSON.parse(data);
                }
                contenedor = document.getElementById("ContenedorDeProductos");
                contenedor.innerHTML = "";
                articulos.forEach(articulo => {
                    let TiposArticulosString = "";
                    contenedor.innerHTML += `<div class="contenedorItem">
                                                <div class="contenedorImagen">
                                                    <img class="imgProducto"
                                                        src="../Imagenes/${articulo.IdArticulo}.jpg">
                                                </div>
                                                <span>${articulo.Descripcion}</span>
                                                <div>
                                                    <label for="tipoArticulo">Tipo</label>
                                                    <select name="tipoArticulo" id="tipoArticulo-${articulo.IdArticulo}">
                                                        <option selected="true" disabled="disabled">Tipo Articulo</option> 
                                                        ` +
                                                        TiposArticulo.forEach(tipoArticulo => {
                                                            if (tipoArticulo.Id == articulo.IdTipoArticulo) {
                                                                TiposArticulosString +=
                                                                    `<option selected="true" value=${tipoArticulo.Id}>${tipoArticulo.Descripcion}</option>`;
                                                            } else {
                                                                TiposArticulosString +=
                                                                    `<option value=${tipoArticulo.Id}>${tipoArticulo.Descripcion}</option>`;
                                                            }
                                                        }) + `${TiposArticulosString}                                 
                                                    </select>
                                                </div>
                                                <div>
                                                    <span>Precio </span>
                                                    <input type="number" id="inputPrecio-${articulo.IdArticulo}" value=${articulo.Precio}>
                                                </div>
                                                <button data-IdArticulo="${articulo.IdArticulo}" class="buttonItemEditar">Editar</button>
                                                <button data-IdArticulo="${articulo.IdArticulo}"  class="buttonItemEliminar">Eliminar</button>
                                            </div>`
                });
            }
        });
    }
    $("#agregarItems").click(function() {
        Swal.fire({
            title: 'Nuevo Item',
            iconHtml: '<i class="fa-solid fa-shirt"></i>',
            inputAttributes: {
                autocapitalize: 'off'
            },
            html: `<div>
                        <div>
                            <label for="input_descripcion">Descripcion</label>
                            <input type="text" id="input_descripcion">
                        </div>

                        <div>
                            <label for="tipoArticulo">Tipo</label>
                            <select name="tipoArticulo" id="tipoArticulo1">
                                <option selected="true" disabled="disabled">Tipo Articulo</option> 
                                <?php include_once "../Funciones/funciones.php";
                                $data = traerTiposArticulos();
                                foreach ($data as $valor){ ?>
                                    "<option value=<?php echo $valor->Id ?> > <?php echo $valor->Descripcion ?> </option>"
                                    <?php } ?>                                      
                            </select>
                        </div>

                        <div>
                            <label for="input_precio">Precio</label>
                            <div style="margin: 0px;">
                                <span style="position: absolute;margin: 1px 2px;">$</span>
                                <input style="padding-left: 12px;" type="text" id="input_precio">
                            </div>
                        </div>

                        <div>
                            <label for="input_idEstado">Estado</label>
                            <select name="input_idEstado" id="input_idEstado">
                                <option selected="true" disabled="disabled">Estado</option>
                                <option value=1>Con Stock</option>
                                <option value=2>Sin Stock</option>
                            </select>
                        </div>

                        <div>
                            <label for="marca">Marca</label>
                            <select name="marca" id="marca">
                                <option selected="true" disabled="disabled">Marca</option> 
                                <?php include_once "../Funciones/funciones.php";
                                $data = traerMarcas();
                                foreach ($data as $valor){ ?>
                                    "<option value=<?php echo $valor->Id ?> > <?php echo $valor->Nombre ?> </option>" ?>
                                    <?php } ?>                                      
                            </select>
                        </div>

                        <div>
                            <label for="distribuidor">Distribuidor</label>
                            <select name="distribuidor" id="distribuidor">
                                <option selected="true" disabled="disabled">Distribuidor</option> 
                                <?php include_once "../Funciones/funciones.php";
                                $data = traerDistribuidores();
                                foreach ($data as $valor){ ?>
                                    "<option value=<?php echo $valor->Id ?> > <?php echo $valor->RazonSocial ?> </option>" ?>
                                    <?php } ?>                                      
                            </select>
                        </div>

                        <div>
                            <label for="input_foto">Foto</label>
                            <input style="max-width:65%;" type="file" id="input_foto">
                        </div>
                    </div>`,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonColor: "#16A829",
            confirmButtonText: 'Agregar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed == true) {
                let descripcion = $("#input_descripcion").val();
                let tipoArticulo = $("#tipoArticulo1").val();
                let precio = $("#input_precio").val();
                let idEstado = $("#input_idEstado").val();
                let marca = $("#marca").val();
                let distribuidor = $("#distribuidor").val();
                let foto = document.getElementById("input_foto");
                if (foto.files.length == '') {
                    Swal.fire({
                        icon: 'info',
                        title: "Suba una foto del articulo",
                        showConfirmButton: false,
                        timer: 6000
                    });
                    return;
                }
                $.ajax({
                    method: "POST",
                    url: "../Funciones/SubirArticulo.php",
                    data: {
                        "descripcion": descripcion,
                        "tipoArticulo": tipoArticulo,
                        "precio": precio,
                        "idEstado": idEstado,
                        "marca": marca,
                        "distribuidor": distribuidor
                    },
                    success: function(data) {
                        if (data != "") {
                            let formData = new FormData();
                            formData.append("archivo", foto.files[0]);
                            formData.append("id", data);
                            $.ajax({
                                method: 'POST',
                                url: "../Funciones/SubirImagen.php",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(resultado) {
                                    if (resultado == 1) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: "Ariculo guardado con éxito.",
                                            showConfirmButton: false,
                                            timer: 6000
                                        });
                                        ActualizarArticulos();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: "No puede subir articulo.",
                                            showConfirmButton: false,
                                            timer: 6000
                                        });
                                    }
                                }
                            });
                        }
                    }

                });
            }
        });
    });
    $(".carrito").click(function() {
        window.location.replace("Carrito.php");
    });
    $(document).on( 'click', '.buttonItemEliminar', function() {
        Swal.fire({
            title: 'Confirmar Acción.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar.',
            confirmButtonColor: '#3CB043',
            cancelButtonText: 'Cancelar.',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let idArticulo = this.dataset.idarticulo;
                $.ajax({
                    method: "POST",
                    url: "../Funciones/EliminarArticulo.php",
                    data: {
                        "idArticulo": idArticulo
                    },
                    success: function(data) {
                        ActualizarArticulos();
                        Swal.fire(
                            '¡Listo!',
                            'Articulo Eliminado',
                            'success'
                        );
                    }                                
                });
            }
        });
    });
    $(".logout").click(function() {
        window.location.replace("../Funciones/logout.php");
    });
    $(document).on( 'click', '.buttonItemEditar', function() {
        Swal.fire({
            title: 'Confirmar Acción.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Editar.',
            confirmButtonColor: '#3CB043',
            cancelButtonText: 'Cancelar.',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let idArticulo = this.dataset.idarticulo;
                let TipoArticulo = document.getElementById("tipoArticulo-"+ idArticulo+"").value;
                let inputPrecio = document.getElementById("inputPrecio-"+ idArticulo+"").value;                
                $.ajax({
                    method: "POST",
                    url: "../Funciones/EditarArticulo.php",
                    data: {
                        "idArticulo": idArticulo,
                        "TipoArticulo": TipoArticulo,
                        "inputPrecio": inputPrecio
                    },
                    success: function(data) {
                        ActualizarArticulos();
                        Swal.fire(
                            '¡Listo!',
                            'Articulo Editado',
                            'success'
                        );
                    }                                
                });
            }
        });
    });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>