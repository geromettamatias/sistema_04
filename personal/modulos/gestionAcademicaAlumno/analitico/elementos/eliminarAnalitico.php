<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$idAlumnos = (isset($_POST['idAlumnos'])) ? $_POST['idAlumnos'] : '';

$pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';

if ($pass=='ESCUELA16') {
     $consulta = "DELETE FROM `analitico` WHERE `idAlumno`='$idAlumnos'";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 1;

}else{

 echo 0;

}
$conexion = NULL;