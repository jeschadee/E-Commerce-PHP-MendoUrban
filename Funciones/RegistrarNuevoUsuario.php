<?php
    include_once "../Funciones/funciones.php";

    $UsuarioWeb = $_POST["UsuarioWeb"];
    $Contraseña = $_POST["Contraseña"];
    $telefono = $_POST["telefono"];
    $fechaN = $_POST["fechaN"]; 

    if(UsuarioExiste($UsuarioWeb)){
        echo 2;
        exit;
    }

    $RegistradoCoConExito = registrarUsuario($UsuarioWeb, $Contraseña,$telefono,$fechaN);
    if ($RegistradoCoConExito) {
        echo 1;
        exit;
    }
    else if(!$RegistradoCoConExito){
        echo 3;
        exit;
    }
    else {
        header("Location: login.php");
        echo "Usuario o contraseña incorrecta";
        exit;
    }

?>