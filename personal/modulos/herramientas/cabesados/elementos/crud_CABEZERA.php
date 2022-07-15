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



if ($edicion=='SI') {
    

$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$idCabezera = $dataFila[0];
$cabezera =$dataFila[1];
$descrip =$dataFila[2];
$editarDocente =$dataFila[3];
$corresponde =$dataFila[4];
$tipo =$dataFila[5];
$cabezeraViejo =$dataFila[6];
$opcion =$dataFila[7];




switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `cabezera_libreta_digital_$cicloLectivo`(`idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde`, `tipo`) VALUES (null,'$cabezera','$descrip','$editarDocente','$corresponde','$tipo')";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 


        $consulta = "ALTER TABLE `libreta_digital_$cicloLectivo` ADD `$cabezera` TEXT NULL AFTER `idAsig`";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



        $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde`, `tipo` FROM `cabezera_libreta_digital_$cicloLectivo` ORDER BY `idCabezera` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación


        $consulta = "UPDATE `cabezera_libreta_digital_$cicloLectivo` SET `nombre`='$cabezera',`descri`='$descrip',`editarDocente`='$editarDocente',`corresponde`='$corresponde',`tipo`='$tipo' WHERE `idCabezera`='$idCabezera'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "ALTER TABLE `libreta_digital_$cicloLectivo` CHANGE `$cabezeraViejo` `$cabezera` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde`, `tipo`  FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `idCabezera`='$idCabezera'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `idCabezera`='$idCabezera'";        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `libreta_digital_$cicloLectivo` DROP `$cabezera`";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
     

        $data=1;

        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
}else{


    echo 0;
}




}

