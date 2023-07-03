<?php
function obtenerBaseDeDatos()
{
    $nombre_base_de_datos = "mendourban";
    $usuario = "root";
    $contraseña = "";
    try {
        $base_de_datos = new PDO('mysql:host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
        $base_de_datos->query("set names utf8;");
        $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $base_de_datos;
    } catch (Exception $e) {
        echo "Error obteniendo BD: " . $e->getMessage();
        return null;
    }
}