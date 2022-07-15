<?php

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$nombreDocente = (isset($_POST['nombreDocente'])) ? $_POST['nombreDocente'] : '';
$dniDocente = (isset($_POST['dniDocente'])) ? $_POST['dniDocente'] : '';
$domicilioDocente = (isset($_POST['domicilioDocente'])) ? $_POST['domicilioDocente'] : '';
$emailDocente = (isset($_POST['emailDocente'])) ? $_POST['emailDocente'] : '';
$telefonoDocente = (isset($_POST['telefonoDocente'])) ? $_POST['telefonoDocente'] : '';

$tituloDocente = (isset($_POST['tituloDocente'])) ? $_POST['tituloDocente'] : '';

$nuevaContraseña = (isset($_POST['nuevaContraseña'])) ? $_POST['nuevaContraseña'] : '';

$nuevaPass = (isset($_POST['nuevaContraseña'])) ? $_POST['nuevaContraseña'] : '';
$hijos = (isset($_POST['hijos'])) ? $_POST['hijos'] : '';


$nuevaContraseña= base64_encode($nuevaPass);




$consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos` FROM `datos_docentes` WHERE `dni`='$dniDocente'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
 

	echo 0;
 
}else{


   $consulta = "INSERT INTO `datos_docentes`(`nombre`, `dni`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado`) VALUES ('$nombreDocente','$dniDocente','$domicilioDocente','$emailDocente','$telefonoDocente','$tituloDocente','$nuevaContraseña','$hijos','DESACTIVO')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


echo 1;
$conexion=null;



}








