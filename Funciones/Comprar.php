<?php
    include_once "../Funciones/funciones.php";    
    $totalPesos  = $_POST["totalPesos"];
    $CompraExitosa = Comprar($totalPesos);
    if($SubidoConExito != ""){
        echo $SubidoConExito;
        exit;
    }
    else{
        echo '';
        exit;
    }

?>