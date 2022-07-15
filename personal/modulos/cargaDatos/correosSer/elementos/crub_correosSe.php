<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id_correoSer = $dataFila[0];
$correo =$dataFila[1];
$password =$dataFila[2];
$pass= base64_encode($password);
$app =$dataFila[3];
$password =$dataFila[4];
$pass_app= base64_encode($password);
$opcion =$dataFila[5];


$host =$dataFila[6];
$port =$dataFila[7];





switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `correoservidor`(`id_correoSer`, `correo`, `pass`, `app`, `pass_app`, `host`, `port`) VALUES (null,'$correo','$pass','$app','$pass_app','$host','$port')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `id_correoSer`, `correo`, `pass`, `app`, `pass_app`, `host`, `port` FROM `correoservidor` ORDER BY `id_correoSer` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;
    case 2: //modificación
        $consulta = "UPDATE `correoservidor` SET `correo`='$correo',`pass`='$pass',`app`='$app',`pass_app`='$pass_app',`host`='$host',`port`='$port' WHERE `id_correoSer`='$id_correoSer'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id_correoSer`, `correo`, `pass`, `app`, `pass_app`, `host`, `port` FROM `correoservidor` WHERE `id_correoSer`='$id_correoSer'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;        
    case 3://baja
        $consulta = "DELETE FROM `correoservidor` WHERE `id_correoSer`='$id_correoSer'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 1;
                                
        break;        
}


$conexion = NULL;