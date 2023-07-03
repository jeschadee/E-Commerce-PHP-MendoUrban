<?php
include_once "../Funciones/funciones.php";    
$idArticulo = $_POST["idArticulo"];
session_start();
if(isset($_SESSION["carrito"])){
   $carrito = $_SESSION["carrito"];
   $carrito[] = $idArticulo;
   $_SESSION["carrito"] = $carrito;
}
else{
    $carrito = array();
    $carrito[] = $idArticulo;
    $_SESSION["carrito"] = $carrito;
}
?>