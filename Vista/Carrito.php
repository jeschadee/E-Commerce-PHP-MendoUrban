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

<body id="Inicio">
    <nav>
        <div class="logo">
            <img src="../Imagenes/logo.jpg" alt="logo MendoUrban" class="">
        </div>
        <div class="menues">
            <a class="direcciones" href="index.php" class="seccion">Inicio</a>
            <?php
                include_once "../Funciones/funciones.php";
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
    <h1 style="text-align: center;padding: 1em;">Carrito</h1>
    <div class="contenedor-sombra ContenedorDeProductos">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Tipo de Articulo</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php include_once "../Funciones/funciones.php";
                    $data = traerCarritoSession();
                    $ids = TraerArticulosId();
                    $total = 0;
                    $cantidad = 0;
                    if(isset($data))
                    foreach ($data as $valor)
                    {   
                        $i = 0;
                        foreach ($ids as $id){
                        if($valor->idArticulo == $id )
                            $cantidad++;
                    }
                        $total += $valor->Precio;
                    ?>
                <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td> <?php echo $valor->Descripcion; ?></td>
                    <td><?php echo $valor->TipoArticulo; ?></td>
                    <td><div class="contenedorImagen">
                            <img class="imgProducto"src="../Imagenes/<?php echo $valor->idArticulo;?>.jpg">
                        </div>
                    </td>
                    <td><?php echo $valor->Nombre; ?></td>
                    <td><?php echo $valor->Precio; ?></td>
                    <td><?php echo $cantidad;?></td>
                </tr>
                <?php
                    $i = $i+1;} 
                ?>
            </tbody>
        </table>
    </div>
    <div style="display: flex;flex-direction: column;align-items: end;justify-content: center;margin: 13px 135px">
        <p style="color: white;">Total: <span id="idTotal"><?php echo $total ?></span></p>
        <button class="buttonComprar">Finalizar compra</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script>
    $(".carrito").click(function() {
        window.location.replace("Carrito.php");
    });
    $(".logout").click(function() {
        window.location.replace("../Funciones/logout.php");
    });
    $(".buttonComprar").click(function() {
        Swal.fire({
            title: 'Confirmar Acción.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: '¡Comprar!',
            confirmButtonColor: '#3CB043',
            cancelButtonText: 'Cancelar.',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let totalPesos = document.getElementById('idTotal');
                $.ajax({
                    method: "POST",
                    url: "../Funciones/Comprar.php",
                    data: {
                        "totalPesos": totalPesos
                    },
                    success: function(data) {                        
                        ActualizarArticulos();
                        Swal.fire(
                            '¡Listo!',
                            'Compra realizada.',
                            'success'
                        ); 
                    }                                
                });                               
            }
            window.location.replace("index.php");
        });
    });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>