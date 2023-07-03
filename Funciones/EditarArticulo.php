<?php
include_once "../Funciones/funciones.php"; 
if(isset($_POST["idArticulo"])){
    $idArticulo = $_POST["idArticulo"];
    $TipoArticulo = $_POST["TipoArticulo"];
    $inputPrecio = $_POST["inputPrecio"];
    session_start();
    EditarArticulo($idArticulo, $TipoArticulo, $inputPrecio);
}
?>