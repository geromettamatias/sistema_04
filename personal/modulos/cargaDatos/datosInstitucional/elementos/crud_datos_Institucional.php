<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$cue = (isset($_POST['cue'])) ? $_POST['cue'] : '';
$domicilio = (isset($_POST['domicilio'])) ? $_POST['domicilio'] : '';
$tel = (isset($_POST['tel'])) ? $_POST['tel'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idInstitucion = (isset($_POST['idInstitucion'])) ? $_POST['idInstitucion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO institucion_datos (nombre, cue, domicilio, tel, email) VALUES('$nombre', '$cue', '$domicilio', '$tel', '$email') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT idInstitucion, nombre, cue, domicilio, tel, email FROM institucion_datos ORDER BY idInstitucion DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE institucion_datos SET nombre='$nombre', cue='$cue', domicilio='$domicilio', tel='$tel', email='$email' WHERE idInstitucion='$idInstitucion' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT idInstitucion, nombre, cue, domicilio, tel, email FROM institucion_datos WHERE idInstitucion='$idInstitucion' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM institucion_datos WHERE idInstitucion='$idInstitucion' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
