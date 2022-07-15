<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nota = (isset($_POST['nota'])) ? $_POST['nota'] : '';
$notaEscr = (isset($_POST['notaEscr'])) ? $_POST['notaEscr'] : '';

$fechaMes = (isset($_POST['fechaMes'])) ? $_POST['fechaMes'] : '';
$fechaAño = (isset($_POST['fechaAño'])) ? $_POST['fechaAño'] : '';

$condicion = (isset($_POST['condicion'])) ? $_POST['condicion'] : '';

$analitico = (isset($_POST['analitico'])) ? $_POST['analitico'] : '';

$establecimiento = (isset($_POST['establecimiento'])) ? $_POST['establecimiento'] : '';



   $consulta = "UPDATE `analitico` SET `nota`='$nota', `notaEscr`='$notaEscr', `fechaMes`='$fechaMes', `fechaAño`='$fechaAño', `condicion`='$condicion', `establecimiento`='$establecimiento' WHERE `idAnalitico`='$analitico'";  
     
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 


echo $analitico;
$conexion = NULL;