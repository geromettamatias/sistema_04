<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$nombresColumnas = (isset($_POST['nombresColumnas'])) ? $_POST['nombresColumnas'] : '';
$arrayIdeLibreta = (isset($_POST['arrayIdeLibreta'])) ? $_POST['arrayIdeLibreta'] : '';

$arrayNotasCompletas = (isset($_POST['arrayNotasCompletas'])) ? $_POST['arrayNotasCompletas'] : '';

$campofinal= (isset($_POST['campofinal'])) ? $_POST['campofinal'] : '';

$contador=0;
$numTex='';

$mes='';

$libreta=$arrayIdeLibreta[0];

//  comprovamos la existencia del analitico 

$consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`, `libreta_digital_$cicloLectivo`.`idAsig`, `plan_datos_asignaturas`.`idPlan` FROM `libreta_digital_$cicloLectivo` INNER JOIN `inscrip_curso_alumno_$cicloLectivo` ON `inscrip_curso_alumno_$cicloLectivo`.`idIns` = `libreta_digital_$cicloLectivo`.`idIns` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`id_libreta` = '$libreta'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data2=$resultado->fetchAll(PDO::FETCH_ASSOC);

foreach($data2 as $dat2) {
    $idAlumno= $dat2['idAlumno']; 
    $idAsigFINAL= $dat2['idAsig']; 
    $idPlan= $dat2['idPlan'];
}

$idAnalitico='';
$consulta = "SELECT `idAnalitico`FROM `analitico` WHERE `idAlumno`='$idAlumno'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data3=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data3 as $dat3) {
    $idAnalitico= $dat3['idAnalitico']; 
}


// en caso de no tener se crea

 if ($idAnalitico=='') {

 $consulta = "SELECT `idPlanEstudio` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumno'";       
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($data as $dat) {
        $idPlanEstudio=$dat['idPlanEstudio'];
    }

$consulta = "SELECT `idAsig`, `idPlan`, `nombre`, `ciclo` FROM `plan_datos_asignaturas` WHERE `idPlan`='$idPlanEstudio' OR `idPlan`='básico'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($d1ata as $d1at) {
    $idAsig=$d1at['idAsig'];

    $idPlanD=$d1at['idPlan'];
     
    $consulta = "INSERT INTO `analitico`(`idAnalitico`, `idPlan`, `idAsig`, `idAlumno`, `nota`, `notaEscr`, `fechaMes`, `fechaAño`, `condicion`, `establecimiento`) VALUES  (null,'$idPlanD','$idAsig','$idAlumno','','','','','','')";            
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 
}

                


}


// se carga la nota

$dato=0;



foreach($arrayIdeLibreta as $idLibreta) {

$editarDatos='';
$dato=0;

    foreach($nombresColumnas as $nombresColu) {

        if ($campofinal==$nombresColu) {
         
            $editarDatos.=' `'.$nombresColu.'`'.'='."'".$arrayNotasCompletas[$contador]."' ";
            $dato=$arrayNotasCompletas[$contador];

        }

        $contador++;
      
        
    }



$consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`, `libreta_digital_$cicloLectivo`.`idAsig`, `plan_datos_asignaturas`.`idPlan` FROM `libreta_digital_$cicloLectivo` INNER JOIN `inscrip_curso_alumno_$cicloLectivo` ON `inscrip_curso_alumno_$cicloLectivo`.`idIns` = `libreta_digital_$cicloLectivo`.`idIns` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`id_libreta` = '$idLibreta'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data2=$resultado->fetchAll(PDO::FETCH_ASSOC);

foreach($data2 as $dat2) {
    $idAlumno= $dat2['idAlumno']; 
    $idAsigFINAL= $dat2['idAsig']; 
    $idPlan= $dat2['idPlan'];

    }

if ($dato==10) {
    $numTex='diez';
    }else if ($dato==9) {
    $numTex='nueve';
    }else if ($dato==8) {
    $numTex='ocho';
    }else if ($dato==7) {
    $numTex='siete';
    }else if ($dato==6) {
    $numTex='seis';
    }
 $consulta = "UPDATE `analitico` SET `nota`='$dato', `notaEscr`='$numTex', `fechaMes`='$mes',`fechaAño`='$cicloLectivo',`condicion`='Regular',`establecimiento`='Este Establecimiento' WHERE `idAsig`='$idAsigFINAL' AND `idAlumno`='$idAlumno'";        
    $resultado = $conexion->prepare($consulta);
 $resultado->execute(); 

        

     echo 'LISTO';

}


      


  

$conexion = NULL;