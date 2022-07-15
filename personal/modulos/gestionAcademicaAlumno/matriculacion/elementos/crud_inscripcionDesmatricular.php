<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
  if ((isset($_SESSION['cursoSe']))){


        $cursoSe=$_SESSION['cursoSe'];
     
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



        $arrayContieneLosElementosAEliminar = (isset($_POST['arrayContieneLosElementosAEliminar'])) ? $_POST['arrayContieneLosElementosAEliminar'] : '';

        foreach ($arrayContieneLosElementosAEliminar as $matriculados) {


            $consulta = "DELETE FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `idIns`='$matriculados' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            
            $consulta = "DELETE FROM `libreta_digital_$cicloLectivo` WHERE `idIns`='$matriculados' ";      
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
             
        }
        

       
        echo 1;
        
       

}
$conexion = NULL;



   
                    
                  