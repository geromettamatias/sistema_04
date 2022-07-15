<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();



$idCurso = (isset($_POST['idCurso'])) ? $_POST['idCurso'] : '';
$cicloLectivo = (isset($_POST['cicloLectivo'])) ? $_POST['cicloLectivo'] : '';
$cursoSeleB = (isset($_POST['cursoSeleB'])) ? $_POST['cursoSeleB'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';



// Recepción de los datos enviados mediante POST desde el JS   
    
$idDescrip = (isset($_POST['idDescrip'])) ? $_POST['idDescrip'] : '';
$idAsig = (isset($_POST['idAsig'])) ? $_POST['idAsig'] : '';
$dia = (isset($_POST['dia'])) ? $_POST['dia'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$horario = (isset($_POST['horario'])) ? $_POST['horario'] : '';


switch($opcion){
    case 1: //alta
       $condicion=0;

      $consulta = "SELECT `idDescrip` FROM `descripasig_$cicloLectivo` WHERE  `idCurso`='$idCurso' AND `dia`='$dia' AND `horario`='$horario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      foreach($data as $dat) { 

        
        $condicion=1;


      }



        if ($condicion==0) {
            
       

        $consulta = "INSERT INTO `descripasig_$cicloLectivo`(`idDescrip`, `idAsignatura`, `dia`, `horario`, `corresponde`, `curso`, `idCurso`) VALUES (null,'$idAsig','$dia','$horario','$cursoSeleB','$nombre','$idCurso')";

      

        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `descripasig_$cicloLectivo`.`idDescrip`, `descripasig_$cicloLectivo`.`idAsignatura`, `descripasig_$cicloLectivo`.`dia`, `descripasig_$cicloLectivo`.`horario`, `descripasig_$cicloLectivo`.`corresponde`, `descripasig_$cicloLectivo`.`curso`, `descripasig_$cicloLectivo`.`idCurso`, `plan_datos_asignaturas`.`nombre` FROM `descripasig_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`=`descripasig_$cicloLectivo`.`idAsignatura` ORDER BY `descripasig_$cicloLectivo`.`idDescrip` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         }else{

       
        $data=array(array('idDescrip' => 'error'));

         }

        break;
    case 2: //modificación
        $consulta = "UPDATE `descripasig_$cicloLectivo` SET `idAsignatura`='$idAsig',`dia`='$dia',`horario`='$horario' WHERE `idDescrip`='$idDescrip'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `descripasig_$cicloLectivo`.`idDescrip`, `descripasig_$cicloLectivo`.`idAsignatura`, `descripasig_$cicloLectivo`.`dia`, `descripasig_$cicloLectivo`.`horario`, `descripasig_$cicloLectivo`.`corresponde`, `descripasig_$cicloLectivo`.`curso`, `descripasig_$cicloLectivo`.`idCurso`, `plan_datos_asignaturas`.`nombre` FROM `descripasig_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`=`descripasig_$cicloLectivo`.`idAsignatura` WHERE `descripasig_$cicloLectivo`.`idDescrip`='$idDescrip' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `descripasig_$cicloLectivo` WHERE `descripasig_$cicloLectivo`.`idDescrip`='$idDescrip' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;


