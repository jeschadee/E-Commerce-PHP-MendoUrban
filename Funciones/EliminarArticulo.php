<?php
include_once "../Funciones/funciones.php"; 
if(isset($_POST["idArticulo"])){
    $idArticulo = $_POST["idArticulo"];
    session_start();
    EliminarArticulo($idArticulo);
}
?>