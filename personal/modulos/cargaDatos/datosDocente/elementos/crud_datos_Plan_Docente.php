<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS 


$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$idDocente = $dataFila[0];
$estado =$dataFila[1];
$dni =$dataFila[2];
$nombre =$dataFila[3];
$passwordDocente =$dataFila[4];
$password= base64_encode($passwordDocente);

$domicilio =$dataFila[5];
$email =$dataFila[6];
$telefono =$dataFila[7];
$titulo =$dataFila[8];
$hijos =$dataFila[9];
$opcion =$dataFila[10];



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `datos_docentes`(`nombre`, `dni`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado`) VALUES ('$nombre','$dni','$domicilio','$email','$telefono','$titulo','$password','$hijos','$estado')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `idDocente`, `nombre`, `dni`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` ORDER BY `idDocente` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE `datos_docentes` SET `nombre`='$nombre',`dni`='$dni',`domicilio`='$domicilio',`email`='$email',`telefono`='$telefono',`titulo`='$titulo',`passwordDocente`='$password',`hijos`='$hijos' ,`estado`='$estado' WHERE `idDocente`='$idDocente'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `idDocente`, `nombre`, `dni`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado`  FROM `datos_docentes` WHERE `idDocente`='$idDocente'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `datos_docentes` WHERE `idDocente`='$idDocente'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=1;
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;