<?php
    include_once "../Funciones/funciones.php";    
    $descripcion  = $_POST["descripcion"];
    $tipoArticulo = $_POST["tipoArticulo"];
    $precio = $_POST["precio"];
    $idEstado = $_POST["idEstado"];
    $marca = $_POST["marca"];
    $distribuidor = $_POST["distribuidor"];
    $SubidoConExito = SubirArticulo($descripcion,$tipoArticulo,$precio,$idEstado,$marca,$distribuidor);
    if($SubidoConExito != ""){
        echo $SubidoConExito;
        exit;
    }
    else{
        echo '';
        exit;
    }

?>