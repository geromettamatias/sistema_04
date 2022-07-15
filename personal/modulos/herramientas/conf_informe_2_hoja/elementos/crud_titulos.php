<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id_titulo = $dataFila[0];
$tituloGenera =$dataFila[1];
$opcion =$dataFila[2];



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `confi_informe_titulo_2_$cicloLectivo`(`id_titulo`, `tituloGenera`) VALUES (null,'$tituloGenera')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `id_titulo`, `tituloGenera` FROM `confi_informe_titulo_2_$cicloLectivo` ORDER BY `id_titulo` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;
    case 2: //modificación
        $consulta = "UPDATE `confi_informe_titulo_2_$cicloLectivo` SET `tituloGenera`='$tituloGenera' WHERE `id_titulo`='$id_titulo'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id_titulo`, `tituloGenera` FROM `confi_informe_titulo_2_$cicloLectivo` WHERE `id_titulo`='$id_titulo'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;        
    case 3://baja.
    
        $consulta = "DELETE FROM `confi_informe_titulo_2_$cicloLectivo` WHERE `id_titulo`='$id_titulo'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



        $consulta = "DELETE FROM `confi_informe_2_$cicloLectivo` WHERE `id_titologeneral`='$id_titulo'";        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 1;
                                
        break;        
}


$conexion = NULL;