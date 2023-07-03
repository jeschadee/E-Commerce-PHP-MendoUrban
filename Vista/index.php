<?php
    $bandera = isset($_POST["UsuarioWeb"]);
    if($bandera)
        $UsuarioWeb = $_POST["UsuarioWeb"];
    if(isset($_POST["Contraseña"]))
        $Contraseña = $_POST["Contraseña"];
    if(!$bandera){
        include_once "../Funciones/SessionStart.php";  
    }
    else{
        include_once "../Funciones/funciones.php";
        $logueadoConExito = login($UsuarioWeb, $Contraseña);
        if ($logueadoConExito) {
            $_SESSION["Usuario"] = $UsuarioWeb;
            $_SESSION["Contraseña"] = $Contraseña;
        }
        else {
            header("Location: login.php");
            echo "Usuario o contraseña incorrecta";
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

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
            <a class="direcciones" href="#" class="seccion">Inicio</a>
            <?php
                $admin = $_SESSION["EsAdmin"];
                if($admin){
            ?>
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
            <?php
                }
            ?>
            <div class="carrito">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div class="logout">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>            
        </div>
    </nav>
    <h1 style="text-align: center;padding: 1em;color: #fff;">Ropa</h1>
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
                TiposArticulo.forEach(tipoArticulo => {
                    if (tipoArticulo.Id == articulo.IdTipoArticulo) {
                        TiposArticulosString +=tipoArticulo.Descripcion;}
                }); 
                contenedor.innerHTML += `<div class="contenedorItem">
                                            <div class="contenedorImagen">
                                                <img class="imgProducto"
                                                    src="../Imagenes/${articulo.IdArticulo}.jpg">
                                            </div>
                                            <span>${articulo.Descripcion}</span>
                                            <div style='display:flex; gap:0.5em;'>
                                                <label>Tipo:</label>
                                                    <p style='margin:0;'>${TiposArticulosString}</p>
                                            </div>
                                            <div style='margin-bottom:0.5em;'>
                                                <span>Precio </span>
                                                <input type="number" value=${articulo.Precio} disabled>
                                            </div>
                                            <div style='display:flex; gap:0.5em;'>
                                            <button data-idArticulo="${articulo.IdArticulo}" class="buttonItem">Comprar</button>
                                            </div>
                                        </div>`
            });
        }
    });
}
    $(".carrito").click(function() {
        window.location.replace("Carrito.php");

    });
    $(".logout").click(function() {
        window.location.replace("../Funciones/logout.php");
    });
    $(document).on( 'click', '.buttonItem', function() {
        Swal.fire({
            title: 'Confirmar accion.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: '¡Comprar!',
            confirmButtonColor: '#3CB043',
            cancelButtonText: 'Cancelar.',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let idArticulo = this.dataset.idarticulo;
                $.ajax({
                    method: "POST",
                    url: "../Funciones/AgregarAlCarrito.php",
                    data: {
                        "idArticulo": idArticulo
                    },
                    success: function(data) {
                        Swal.fire(
                            '¡Gracias!',
                            'Articulo añadido al carrito',
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