<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id = $dataFila[0];
$usuario =$dataFila[1];
$pass =$dataFila[2];
$password= base64_encode($pass);
$opcion =$dataFila[3];



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `usuario_administrador`(`usuario`, `password`) VALUES ('$usuario','$password')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `id`, `usuario`, `password` FROM `usuario_administrador` ORDER BY `id` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;
    case 2: //modificación
        $consulta = "UPDATE `usuario_administrador` SET `usuario`='$usuario',`password`='$password' WHERE `id`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id`, `usuario`, `password` FROM `usuario_administrador` WHERE `id`='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;        
    case 3://baja
        $consulta = "DELETE FROM `usuario_administrador` WHERE `id`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 1;
                                
        break;        
}


$conexion = NULL;