<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$idActa = (isset($_POST['idActa'])) ? $_POST['idActa'] : '';
$idAlu = (isset($_POST['idAlu'])) ? $_POST['idAlu'] : '';

        $consulta = "INSERT INTO `acta_examen_inscrip`(`idInscripcion`, `idActa`, `idAlumno`, `notaEsc`, `notaOral`, `promNumérico`, `promLetra`) VALUES (null,'$idActa','$idAlu','','','','')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        echo 'BIEN';
 

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;