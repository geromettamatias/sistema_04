<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS 
 session_start();
 if (isset($_SESSION['idAlumnos'])){
        $idAlumnos=$_SESSION['idAlumnos'];

     $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$idAsigPendiente = (isset($_POST['idAsigPendiente'])) ? $_POST['idAsigPendiente'] : '';
$asignatura = (isset($_POST['asignatura'])) ? $_POST['asignatura'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$situacion = (isset($_POST['situacion'])) ? $_POST['situacion'] : '';


switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `asignaturas_pendientes_$cicloLectivo`(`idAsigPendiente`, `idAlumno`, `asignaturas`, `calFinal_1`, `fecha_1`, `libro_1`, `folio_1`, `calFinal_2`, `fecha_2`, `libro_2`, `folio_2`, `calFinal_3`, `fecha_3`, `libro_3`, `folio_3`, `calFinal_4`, `fecha_4`, `libro_4`, `folio_4`, `calFinal_5`, `fecha_5`, `libro_5`, `folio_5`, `situacion`, `bloque1`, `bloque2`, `bloque3`, `bloque4`, `bloque5`) VALUES (null,'$idAlumnos', '$asignatura','','','','','','','','','','','','','','','','','','','','','$situacion','','','','','')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas` ORDER BY `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;
    case 2: //modificación
        $consulta = "UPDATE `asignaturas_pendientes_$cicloLectivo` SET `asignaturas`='$asignatura',`situacion`='$situacion' WHERE `idAsigPendiente`='$idAsigPendiente'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        



        $consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`='$idAsigPendiente'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;        
    case 3://baja
               $consulta = "DELETE FROM `asignaturas_pendientes_$cicloLectivo` WHERE `idAsigPendiente`='$idAsigPendiente' ";        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
     
        echo 'Listo';
                                
        break;        
}


$conexion = NULL;

}
