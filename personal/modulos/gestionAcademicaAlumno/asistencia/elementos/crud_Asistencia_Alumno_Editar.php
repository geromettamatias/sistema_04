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
$id = (isset($_POST['id'])) ? $_POST['id'] : '';


        $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado`  FROM `asistenciaalumno_$cicloLectivo` WHERE `id_Asistencia`='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

}else{

    echo "error";
}