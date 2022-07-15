<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "DELETE FROM `ingreso_sistema_alumno`";      
$resultado = $conexion->prepare($consulta);
$resultado->execute();

$consulta = "DELETE FROM `ingreso_sistema_docente`";      
$resultado = $conexion->prepare($consulta);
$resultado->execute();


$consulta = "DELETE FROM `ingreso_sistema_personal`";      
$resultado = $conexion->prepare($consulta);
$resultado->execute();


          echo 1;



$conexion = NULL;