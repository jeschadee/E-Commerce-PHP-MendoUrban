<?php

include_once "baseDeDatos.php";

function Comprar($totalPesos){// totalpesos int
    $usuario = obtenerUsuarioPorCorreo($_SESSION["NombreUsuario"]); //usuario es objeto usuario db
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("INSERT INTO facturas(IdUsuario, Monto, TS, IdTipoOperacion)
     values(?, ?, ?, ?);");
    $sentencia->execute([$usuario->idUsuario,$totalPesos,date("yyyy/d/m"),2]);
    $ultimoId = $base_de_datos->lastInsertId();
    $carrito = $_SESSION["carrito"];
    $Articulos = TraerArticulosPorIdArray($carrito);        
    $idsAgrupados = array_count_values($carrito);
    foreach($Articulos as $Articulo){
        $cantidad = $idsAgrupados[$Articulo->idArticulo];
        $sentencia = $base_de_datos->prepare("INSERT INTO facturadetalle(IdFactura, IdArticulo, Cantidad) values(?, ?, ?);");
        $SubioArticulo = $sentencia->execute([$ultimoId,$Articulo->idArticulo,$cantidad]);
    }        
    $_SESSION["carrito"] = array();
    return;
}
function EditarArticulo($idArticulo, $TipoArticulo, $inputPrecio){
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("update articulos set IdTipoArticulo = ?, Precio = ? where idArticulo = $idArticulo");
    $sentencia->execute([$TipoArticulo,$inputPrecio]);
}
function EliminarArticulo($idArticulo){
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("Update articulos set Inhabilitado = 1 where idArticulo = $idArticulo");
    $sentencia->execute([]);
}
function traerCarritoSession(){
    if(isset($_SESSION["carrito"])){
        $carrito = $_SESSION["carrito"];
        $Articulos = TraerArticulosPorIdArray($carrito);
        return $Articulos;
    } 
}
function TraerArticulosId(){
    if(isset($_SESSION["carrito"])){
        $carrito = $_SESSION["carrito"];
        return $carrito;
    } 
}
function TraerArticulosPorIdArray($carrito){
    //Array para concatenar los id a filtrar
    $variables = array();
    
    foreach ($carrito as $valor){
        $variables[] = $valor;        
    }
    $query_ids = implode(',', $variables);
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("SELECT  a.idArticulo, t.Descripcion as TipoArticulo, a.Descripcion, m.Nombre, a.Precio FROM articulos a inner join tiposarticulos t on t.id = a.IdTipoArticulo inner join marcas m on m.id = a.idmarca  where Inhabilitado = 0 and a.idArticulo in ($query_ids)");
    $sentencia->execute([]);
    $Articulos = $sentencia->fetchAll();
    return $Articulos;
}
function TraerArticulos(){
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("SELECT IdArticulo, IdTipoArticulo, Descripcion, IdMarca, Precio, IdEstado, IdDistribuidor FROM articulos where Inhabilitado = 0");
    $sentencia->execute([]);
    return $sentencia->fetchAll();
}
function SubirArticulo($descripcion,$tipoArticulo,$precio,$idEstado,$marca,$distribuidor){
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("INSERT INTO Articulos(IdTipoArticulo, Descripcion, IdMarca, Precio, IdEstado, IdDistribuidor) values(?, ?, ?, ?, ?, ?);");
    $SubioArticulo = $sentencia->execute([$tipoArticulo,$descripcion,$marca,$precio,$idEstado,$distribuidor]);
    return $base_de_datos->lastInsertId();
}
function traerTiposArticulos(){
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("SELECT Id,Descripcion FROM tiposarticulos");
    $sentencia->execute([]);
    return $sentencia->fetchAll();
}
function traerMarcas(){
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("SELECT Id,Nombre FROM marcas");
    $sentencia->execute([]);
    return $sentencia->fetchAll();
}
function traerDistribuidores(){
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("SELECT Id, RazonSocial FROM distribuidores");
    $sentencia->execute([]);
    return $sentencia->fetchAll();
}
function obtenerUsuarioPorCorreo($NombreUsuario)
{
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("SELECT NombreUsuario, Contraseña, IdTipoUsuario FROM usuarios WHERE NombreUsuario = ? LIMIT 1;");
    $sentencia->execute([$NombreUsuario]);
    return $sentencia->fetchObject();
}

function UsuarioExiste($NombreUsuario){
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("SELECT NombreUsuario, Contraseña FROM usuarios WHERE NombreUsuario = ? LIMIT 1;");
    $sentencia->execute([$NombreUsuario]);
    if ($sentencia->fetchObject() === false) {
        return false;
    }
    else return true;
}

function registrarUsuario($correo, $palabraSecreta,$telefono,$fechaN)
{
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("INSERT INTO usuarios(NombreUsuario, Telefono, FechaNacimiento, IdTipoUsuario, Ts_Alta, Contraseña) values(?, ?, ?, ?, ?, ?)");
    return $sentencia->execute([$correo,$telefono,date('Y-m-d', strtotime($fechaN)),2,date("Y/m/d"), $palabraSecreta]);
}

function ChequearAdmin(){
    session_start();
    $admin = $_SESSION["EsAdmin"];
    if(!$admin){
        header("Location: ../Vista/login.php");
    }
}

function login($UsuarioWeb, $Contraseña)
{
    $posibleUsuarioRegistrado = obtenerUsuarioPorCorreo($UsuarioWeb);
    if ($posibleUsuarioRegistrado === false) {
        return false;
    }
    $palabraSecretaDeBaseDeDatos = $posibleUsuarioRegistrado->Contraseña;
    if($Contraseña === $palabraSecretaDeBaseDeDatos)
        $coinciden = true;
    $coinciden = coincidenPalabrasSecretas($Contraseña, $palabraSecretaDeBaseDeDatos);
    if (!$coinciden) {
        return false;
    }
    iniciarSesion($posibleUsuarioRegistrado);
    return true;
}

function iniciarSesion($usuario)
{
    session_start();
    $_SESSION["NombreUsuario"] = $usuario->NombreUsuario;
    $_SESSION["EsAdmin"] = $usuario->IdTipoUsuario === 1 ? true : false;
}

function coincidenPalabrasSecretas($palabraSecreta, $palabraSecretaDeBaseDeDatos)
{
    return $palabraSecreta == $palabraSecretaDeBaseDeDatos;
}