<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$idAlumno = (isset($_POST['idAlumno'])) ? $_POST['idAlumno'] : '';
$cuilAlumnos = (isset($_POST['cuilAlumnos'])) ? $_POST['cuilAlumnos'] : '';
$nombreAlumno = (isset($_POST['nombreAlumno'])) ? $_POST['nombreAlumno'] : '';
$domicilioAlumno = (isset($_POST['domicilioAlumno'])) ? $_POST['domicilioAlumno'] : '';
$emailAlumno = (isset($_POST['emailAlumno'])) ? $_POST['emailAlumno'] : '';
$telefonoAlumno = (isset($_POST['telefonoAlumno'])) ? $_POST['telefonoAlumno'] : '';

$discapasidadAlumnos = (isset($_POST['discapasidadAlumnos'])) ? $_POST['discapasidadAlumnos'] : '';
$nombreTutor = (isset($_POST['nombreTutor'])) ? $_POST['nombreTutor'] : '';
$dniTutor = (isset($_POST['dniTutor'])) ? $_POST['dniTutor'] : '';
$TelefonoTutor = (isset($_POST['TelefonoTutor'])) ? $_POST['TelefonoTutor'] : '';

$pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';

$pass_verificacion = (isset($_POST['pass_verificacion'])) ? $_POST['pass_verificacion'] : '';
$pass_verificacion2=base64_decode ($pass_verificacion);


$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumno' AND `pass`='$pass_verificacion2'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
  
   $pass_2=base64_decode ($pass);

    $consulta = "UPDATE `datosalumnos` SET `nombreAlumnos`='$nombreAlumno ',`cuilAlumnos`='$cuilAlumnos',`domicilioAlumnos`='$domicilioAlumno',`emailAlumnos`='$emailAlumno',`telefonoAlumnos`='$telefonoAlumno',`discapasidadAlumnos`='$discapasidadAlumnos',`nombreTutor`='$nombreTutor',`dniTutor`='$dniTutor',`TelefonoTutor`='$TelefonoTutor',`pass`='$pass_2' WHERE `idAlumnos`='$idAlumno'";  
     
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 

  


echo 1;
  
      
}else{

   echo 2;
}





 
$conexion = NULL;