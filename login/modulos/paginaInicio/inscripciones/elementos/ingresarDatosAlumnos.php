<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

// Recepción de los datos enviados mediante POST desde el JS   

$dni_alumno = (isset($_POST['dni_alumno'])) ? $_POST['dni_alumno'] : '';


$nombre_alumno = (isset($_POST['nombre_alumno'])) ? $_POST['nombre_alumno'] : '';
$fecha_nacimiento = (isset($_POST['fecha_nacimiento'])) ? $_POST['fecha_nacimiento'] : '';
$dni_tutor = (isset($_POST['nombre_tutor'])) ? $_POST['dni_tutor'] : '';
$nombre_tutor = (isset($_POST['nombre_tutor'])) ? $_POST['nombre_tutor'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';

$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$domicilio = (isset($_POST['domicilio'])) ? $_POST['domicilio'] : '';
$localidad = (isset($_POST['localidad'])) ? $_POST['localidad'] : '';



$inscrp = 0;

$c1onsulta = "SELECT `id_PreIncrip`, `dni_alumno`, `nombre_alumno`, `fecha_nacimiento`, `dni_tutor`, `nombre_tutor`, `correo`, `telefono`, `domicilio`, `localidad` FROM `inscripcion` WHERE `dni_alumno`='$dni_alumno'";
$r1esultado = $conexion->prepare($c1onsulta);
$r1esultado->execute();
$d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
foreach($d1ata as $d1at) {

    $inscrp = 1;
 
}


if ($inscrp == 0 ) {
      
         $consulta = "INSERT INTO `inscripcion`(`id_PreIncrip`, `dni_alumno`, `nombre_alumno`, `fecha_nacimiento`, `dni_tutor`, `nombre_tutor`, `correo`, `telefono`, `domicilio`, `localidad`) VALUES (null,'$dni_alumno','$nombre_alumno','$fecha_nacimiento','$dni_tutor','$nombre_tutor','$correo','$telefono','$domicilio','$localidad')";                      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        echo 1;


}else{


        echo 0;




}


$conexion = NULL;