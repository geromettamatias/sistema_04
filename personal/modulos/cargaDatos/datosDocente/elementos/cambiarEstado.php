<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS 


$idDocente = (isset($_POST['idDocente'])) ? $_POST['idDocente'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';


 $consulta = "UPDATE `datos_docentes` SET `estado`='$estado' WHERE `idDocente`='$idDocente'";        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `idDocente`, `nombre`, `dni`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado`  FROM `datos_docentes` WHERE `idDocente`='$idDocente'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;