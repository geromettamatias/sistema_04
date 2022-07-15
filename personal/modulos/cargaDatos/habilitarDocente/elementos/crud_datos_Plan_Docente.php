<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$arrayContieneLosElementosAEliminar = (isset($_POST['arrayContieneLosElementosAEliminar'])) ? $_POST['arrayContieneLosElementosAEliminar'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
  
    case 1: //modificación


          foreach ($arrayContieneLosElementosAEliminar as $matriculados) {

            $consulta = "UPDATE `datos_docentes` SET `estado`='ACTIVO' WHERE `idDocente`='$matriculados'";        
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 
                     
          }


          echo 1;
               
       
        break;

    case 2://baja


           foreach ($arrayContieneLosElementosAEliminar as $matriculados) {

            $consulta = "DELETE FROM `datos_docentes` WHERE `idDocente`='$matriculados'";      
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
                     
          }


          echo 2;
                                
        break;        
}




$conexion = NULL;