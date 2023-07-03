<?php
$correo = $_POST["correo"];
$palabra_secreta = $_POST["palabra_secreta"];
$palabra_secreta_confirmar = $_POST["palabra_secreta_confirmar"];

if ($palabra_secreta !== $palabra_secreta_confirmar) {
    echo "Las contraseñas no coinciden, intente de nuevo";
    exit;
}

# Incluimos las funciones, mira funciones.php para una mejor idea
include_once "funciones.php";

# Primero debemos saber si existe o no
$existe = usuarioExiste($correo);
if ($existe) {
    echo "Lo siento, ya existe alguien registrado con ese correo";
    exit; # Salir para no ejecutar el siguiente código
}

# Si no existe, se ejecuta esta parte
# Ahora intentamos registrarlo
$registradoCorrectamente = registrarUsuario($correo, $palabra_secreta);
if ($registradoCorrectamente) {
    echo "Registrado correctamente. Ahora puedes iniciar sesión";
} else {
    echo "Error al registrarte. Intenta más tarde";
}
?>