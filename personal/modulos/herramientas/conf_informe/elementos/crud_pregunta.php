<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();


if (isset($_SESSION['cicloLectivo'])){
$cicloF=$_SESSION['cicloLectivo'];
$id_titulo=$_SESSION['id_titulo'];


$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id_informe = $dataFila[0];

$modalidad =$dataFila[1];
$tipo =$dataFila[2];
$titulo =$dataFila[3];
$pregunta =$dataFila[4];
$aclaracion =$dataFila[5];
$respuesta =$dataFila[6];

$opcion =$dataFila[7];



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `confi_informe_$cicloLectivo`(`id_informe`, `tipo`, `titulo`, `pregunta`, `aclaracion`, `respuestas_posible`, `modalidad`, `id_titologeneral`) VALUES (null,'$tipo','$titulo','$pregunta','$aclaracion','$respuesta','$modalidad','$id_titulo')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `id_informe`, `tipo`, `titulo`, `pregunta`, `aclaracion`, `respuestas_posible`, `modalidad`, `id_titologeneral` FROM `confi_informe_$cicloLectivo` ORDER BY `id_informe` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;
    case 2: //modificación
        $consulta = "UPDATE `confi_informe_$cicloLectivo` SET `tipo`='$tipo',`titulo`='$titulo',`pregunta`='$pregunta',`aclaracion`='$aclaracion',`respuestas_posible`='$respuesta',`modalidad`='$modalidad',`id_titologeneral`='$id_titulo' WHERE `id_informe`='$id_informe'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id_informe`, `tipo`, `titulo`, `pregunta`, `aclaracion`, `respuestas_posible`, `modalidad`, `id_titologeneral` FROM `confi_informe_$cicloLectivo` WHERE `id_informe`='$id_informe'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;        
    case 3://baja
        $consulta = "DELETE FROM `confi_informe_$cicloLectivo` WHERE `id_informe`='$id_informe'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 1;
                                
        break;        
}

}
$conexion = NULL;