<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$id_ciclo = (isset($_POST['id_ciclo'])) ? $_POST['id_ciclo'] : '';
$pregunta = (isset($_POST['pregunta'])) ? $_POST['pregunta'] : '';


$consulta = "UPDATE `ciclo_lectivo` SET `edicion`='$pregunta' WHERE `id_ciclo`='$id_ciclo'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

$consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` WHERE `id_ciclo`='$id_ciclo'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
   