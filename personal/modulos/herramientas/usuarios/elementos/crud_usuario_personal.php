<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$idUsu = $dataFila[0];
$cargo =$dataFila[1];
$nombre =$dataFila[2];
$dni =$dataFila[3];
$correo =$dataFila[4];
$nivelCurso =$dataFila[5];
$operacion =$dataFila[6];
$password =$dataFila[7];
$pass= base64_encode($password);
$opcion =$dataFila[8];



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `personal_eet16`(`idUsu`, `cargo`, `nombre`, `dni`, `correo`, `nivelCurso`, `operacion`, `pass`) VALUES (null,'$cargo','$nombre','$dni','$correo','$nivelCurso','$operacion','$pass')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `idUsu`, `cargo`, `nombre`, `dni`, `correo`, `nivelCurso`, `operacion`, `pass` FROM `personal_eet16` ORDER BY `idUsu` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS

        break;
    case 2: //modificación
        $consulta = "UPDATE `personal_eet16` SET `cargo`='$cargo',`nombre`='$nombre',`dni`='$dni',`correo`='$correo',`nivelCurso`='$nivelCurso',`operacion`='$operacion',`pass`='$pass' WHERE `idUsu`='$idUsu'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `idUsu`, `cargo`, `nombre`, `dni`, `correo`, `nivelCurso`, `operacion`, `pass` FROM `personal_eet16`  WHERE `idUsu`='$idUsu'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;        
    case 3://baja
        $consulta = "DELETE FROM `personal_eet16` WHERE `idUsu`='$idUsu'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 1;
                                
        break;
  
}


$conexion = NULL;