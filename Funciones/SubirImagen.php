<?php
$id = $_POST["id"];
$image_file = $_FILES["archivo"];
$extension = pathinfo($_FILES["archivo"]["name"],PATHINFO_EXTENSION);
//Nombre con el ID
$NuevoNombre = $id . "." . $extension;
// Image not defined, let's exit
if (!isset($image_file)) {
    die('No file uploaded.');
}
$resultado = move_uploaded_file($image_file["tmp_name"],__DIR__ . "/../Imagenes/" . $NuevoNombre);
if ($resultado) {
    echo 1;
} else {
    echo 2;
}
?>