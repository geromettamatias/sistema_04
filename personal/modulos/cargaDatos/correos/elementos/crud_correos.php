<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$usuarios = (isset($_POST['usuarios'])) ? $_POST['usuarios'] : '';



$emailCopia = (isset($_POST['emailCopia'])) ? $_POST['emailCopia'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';




$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_correos = (isset($_POST['id_correos'])) ? $_POST['id_correos'] : '';



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `correos`(`id_correos`, `tipo`, `correo`, `usuario`) VALUES (null,'$tipo','$emailCopia','$usuarios')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `id_correos`, `tipo`, `correo`, `usuario` FROM `correos`  ORDER BY `id_correos` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE `correos` SET `tipo`='$tipo',`correo`='$emailCopia',`usuario`='$usuarios' WHERE  `id_correos`='$id_correos'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id_correos`, `tipo`, `correo`, `usuario` FROM `correos` WHERE `id_correos`='$id_correos'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `correos` WHERE `id_correos`='$id_correos'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;