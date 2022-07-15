<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$institucionPlan = (isset($_POST['institucionPlan'])) ? $_POST['institucionPlan'] : '';
$nombrePlan = (isset($_POST['nombrePlan'])) ? $_POST['nombrePlan'] : '';
$numeroPlan = (isset($_POST['numeroPlan'])) ? $_POST['numeroPlan'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idPlan = (isset($_POST['idPlan'])) ? $_POST['idPlan'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `plan_datos`(`idPlan`, `idInstitucion`, `nombre`, `numero`) VALUES (null,'$institucionPlan','$nombrePlan','$numeroPlan')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT idPlan, idInstitucion, nombre, numero FROM plan_datos ORDER BY idPlan DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación

        $consulta = "UPDATE `plan_datos` SET `idInstitucion`='$institucionPlan',`nombre`='$nombrePlan',`numero`='$numeroPlan' WHERE `idPlan`='$idPlan'";  
     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM `plan_datos` WHERE `idPlan`='$idPlan'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM plan_datos WHERE idPlan='$idPlan' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
