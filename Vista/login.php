<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Css/general.css">
    <title>Login</title>
</head>

<body>
    <nav>
        <div class="logo">
            <img src="../Imagenes/logo.jpg" alt="logo MendoUrban" class="">
        </div>
    </nav>
    <h1 style="text-align: center;padding: 1em;">Login</h1>
    <div class="contenedor-sombra">
        <form action="index.php" method="post">
            <input type="password" name="password" autocomplete="new-password" hidden/>
            <input type="text" name="foo" autocomplete="off" hidden/>
            <input name="UsuarioWeb" class="input_login" autocomplete="off" type="text" placeholder="Escribe tu Usuario" required>
            <input name="Contraseña" class="input_login" autocomplete="off" type="password" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar sesión">
        </form>
        <h5>¿No tienes cuenta?<a href="registro.php">Registrarme</a></h5>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>    
</body>
</html>