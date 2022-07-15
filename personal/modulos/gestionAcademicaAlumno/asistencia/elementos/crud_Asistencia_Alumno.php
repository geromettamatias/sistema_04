<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 session_start();
  
 if (isset($_SESSION['cicloLectivo'])){

                  $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$id_alumnos = (isset($_POST['id_alumnos'])) ? $_POST['id_alumnos'] : '';
$fecha_Alumno = (isset($_POST['fecha_Alumno'])) ? $_POST['fecha_Alumno'] : '';
$cantidad_Alumno = (isset($_POST['cantidad_Alumno'])) ? $_POST['cantidad_Alumno'] : '';
$justifico_Alumno = (isset($_POST['justifico_Alumno'])) ? $_POST['justifico_Alumno'] : '';
$osb_Alumno = (isset($_POST['osb_Alumno'])) ? $_POST['osb_Alumno'] : '';
$encabezado = (isset($_POST['encabezado'])) ? $_POST['encabezado'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


 

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `asistenciaalumno_$cicloLectivo`(`id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado`) VALUES (null,'$id_alumnos','$fecha_Alumno','$cantidad_Alumno','$justifico_Alumno','$osb_Alumno','$encabezado')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado` FROM `asistenciaalumno_$cicloLectivo` ORDER BY `id_Asistencia` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE `asistenciaalumno_$cicloLectivo` SET `id_Asistencia`='$id',`idAlumno`='$id_alumnos',`fecha`='$fecha_Alumno',`cantidad`='$cantidad_Alumno',`justificado`='$justifico_Alumno',`observacion`='$osb_Alumno',`encabezado`='$encabezado' WHERE `id_Asistencia`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado` FROM `asistenciaalumno_$cicloLectivo` WHERE `id_Asistencia`='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `asistenciaalumno_$cicloLectivo` WHERE `id_Asistencia`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

}else{

    echo "error";
}