<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$id_PreIncrip = (isset($_POST['id_PreIncrip'])) ? $_POST['id_PreIncrip'] : '';


$consulta="SELECT `id_PreIncrip`, `dni_alumno`, `nombre_alumno`, `fecha_nacimiento`, `dni_tutor`, `nombre_tutor`, `correo`, `telefono`, `domicilio`, `localidad` FROM `inscripcion` WHERE `id_PreIncrip`='$id_PreIncrip'";       
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;