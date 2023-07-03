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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Registrar Usuario</title>
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    min-height: 600px;
}

.contenedor-sombra {
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 2em;
    width: 45%;
    margin: auto;
    padding: 1em;
    border-radius: 4px;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 2px 6px 2px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
}

.contenedor-sombra form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 2em;
}

.contenedor-sombra form .input_login {
    padding: 0.2em 0.5em;
    border-radius: 6px;
    border: 3px solid rgb(159, 146, 146);
}

.contenedor-sombra form input {
    padding: 0.2em 0.5em;
    border-radius: 6px;
    border: 1px solid rgb(159, 146, 146);
}

nav {
    width: 100%;
    background: black;
    display: flex;
    justify-content: space-between;
}

nav .menues {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1em;
    margin-right: 1em;
}

.logo {
    width: 10%;
}

img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
<input type="password" name="password" autocomplete="new-password" hidden>

<body>
    <nav>
        <div class="logo">
            <img src="../Imagenes/logo.jpg" alt="logo MendoUrban" class="">
        </div>
    </nav>
    <h1 style="text-align: center;padding: 1em;">Registrar Usuario</h1>
    <div class="contenedor-sombra">
        <input id="correo" class="input_login" type="text" placeholder="Tu correo electrónico">
        <div style="display: flex; justify-content: center; gap: 0.3em;">
            <label>Telefono</label>
            <input autocomplete="off"
                style="width: 14%;background-color: grey;color: white;border: none;padding: 0.2em;" type="text"
                id="codPais" style="width: 14%;" readonly disabled value="+549">
            <input autocomplete="off" maxlength="4" minlength="2" type="text" id="codArea" class="numero_tel"
                style="width: 14%;" placeholder="11">
            <input autocomplete="off" maxlength="8" minlength="6" type="text" id="telefono" class="numero_tel"
                style="width: 20%;" placeholder="1234567">
        </div>
        <div>
            <label for="fechaN">Fecha Nacimiento</label>
            <input id="fechaN" class="input_login" type="date" value="2000-01-01" min="1950-01-01" max="2010-12-31">
        </div>
        <input id="pass" class="input_login" type="password" placeholder="Contraseña">
        <input id="pass2" class="input_login" type="password" placeholder="Confirma tu contraseña">
        <button class="btnRegistrar">Registrarme</button>
        <h5>Si ya tienes una cuenta <a href="login.php">Click Aqui</a></h5>
    </div>
</body>

</html>
<script>
$(".carrito").click(function() {
    window.location.replace("Carrito.php");
});

$(".btnRegistrar").click(function() {
    let UsuarioWeb = $("#correo").val();
    let telefono = $("#telefono").val();
    let fechaN = $("#fechaN").val();
    let pass = $("#pass").val();
    let pass2 = $("#pass2").val();
    let codPais = 549;
    let codArea = $("#codArea").val();
    if (UsuarioWeb == '' || pass == '' || pass2 == '' || fechaN == '' || telefono == '' || codArea == '') {
        Swal.fire(
            'Error',
            'Complete todos los campos',
            'error'
        );
        return false;
    }
    if (chequearValidezTelefono()) {
        return;
    }
    Swal.fire({
        title: 'Confirmar Registracion.',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Confirmar.',
        confirmButtonColor: '#3CB043',
        cancelButtonText: 'Cancelar.',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                    method: "POST",
                    url: "../Funciones/RegistrarNuevoUsuario.php",
                    data: {
                        UsuarioWeb: UsuarioWeb,
                        Contraseña: pass,
                        telefono: telefono,
                        fechaN: fechaN
                    }
                })
                .done(
                    function(result) { 
                    if (result = 1) {
                        Swal.fire({
                            title: '¡Listo!',
                            text: 'Usuario registrado',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        }).then((result) => {
                            window.location.replace("login.php");
                        });
                    } else if (result = 2) {
                        Swal.fire(
                            '¡Error!',
                            'Ya existe el usuario, por favor escoja otro nombre',
                            'error'
                        );
                    } else {
                        Swal.fire(
                            '¡Se ha producido un error!',
                            'Error al intentar registrar usuario',
                            'error'
                        );
                    } 
                });
            }
    });

});

function chequearValidezTelefono() {
    let phoneArea = document.getElementById("codArea");
    let phoneNumber = document.getElementById("telefono");
    let hayErrores = false;

    if (phoneArea.value.length < 2 || phoneArea.value.length > 4) {
        hayErrores = true;
        phoneArea.setCustomValidity("Codigo de area invalido - Debe tener entre 2 y 3 caracteres");
        phoneArea.reportValidity();
    } else {
        phoneArea.setCustomValidity('');
        hayErrores = false;
    }

    if (phoneArea.value.substring(0, 1) == "0") {
        hayErrores = true;
        phoneArea.setCustomValidity("Codigo de area invalido - No ingresar 0 delante");
        phoneArea.reportValidity();
    } else {
        phoneArea.setCustomValidity('');
        if (!hayErrores)
            hayErrores = false;
    }

    if (!hayErrores) {
        if (phoneNumber.value.substring(0, 2) == "15") {
            hayErrores = true;
            phoneNumber.setCustomValidity("Numero invalido - No ingrese 15");
            phoneNumber.reportValidity();
        } else {
            phoneNumber.setCustomValidity('');
            hayErrores = false;
        }
        if (phoneNumber.value.length > 0 && phoneNumber.value.length < 6 || phoneArea.value.length > 8) {
            hayErrores = true;
            phoneNumber.setCustomValidity("Numero invalido - Debe tener entre 6 y 8 caracteres");
            phoneNumber.reportValidity();
        } else {
            phoneNumber.setCustomValidity('');
        }

        if ((phoneArea.value.length + phoneNumber.value.length) != 10 && phoneNumber.value.length > 0) {
            phoneNumber.setCustomValidity("Telefono Invalido");
            phoneNumber.reportValidity();
        } else {
            if (!hayErrores) {
                phoneNumber.setCustomValidity('');
            }
        }
    }

    return hayErrores;
}
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</script>