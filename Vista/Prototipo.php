<?php
include_once "../Funciones/SessionStart.php";
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

<body>
    <nav>
        <div class="logo">
            <img src="../Imagenes/logo.jpg" alt="logo MendoUrban" class="">
        </div>
        <div class="menues">
            <a class="direcciones" href="#" class="seccion">Inicio</a>
            <a class="direcciones" href="DashBoards.html" class="seccion">DashBoards</a>
            <div class="dropdown-center">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-user-gear"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="" configuracion.html>Configuracion</a></li>
                    <li><a class="dropdown-item" href="configurarItems.php">Configurar Items</a></li>
                    <li><a class="dropdown-item" href="../Funciones/logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
            <div class="carrito">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>
    </nav>
    <h1 style="text-align: center;padding: 1em;">Carrito</h1>
    <div class="contenedor-sombra ContenedorDeProductos">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div><button>Finalizar compra</button></div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script>
    $(".carrito").click(function() {
        window.location.replace("/Carrito.php");
    });
    $(".buttonItem").click(function() {
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
                Swal.fire(
                    '¡Listo!',
                    'Articulo Editado.',
                    'success'
                );
            }
        });
    });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>