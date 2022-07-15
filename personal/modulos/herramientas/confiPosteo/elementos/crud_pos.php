<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
  

$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$idFecha = $dataFila[0];
$postear =$dataFila[1];





        $consulta = "UPDATE `fechas_pos` SET `pregunta`='$postear' WHERE `idFecha`='$idFecha' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `idFecha`='$idFecha' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;