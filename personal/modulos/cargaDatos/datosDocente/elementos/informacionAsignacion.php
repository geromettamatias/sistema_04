<?php
                  
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
   session_start();

 if ((isset($_SESSION['docenteSEL']))){
 $idDocente=$_SESSION['docenteSEL'];


$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivoFINAL= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



                            
$curso=$_POST['curso'];
$idAsig=$_POST['idAsig'];

$cat="Disponible";


$consulta = "SELECT `datos_docentes`.`nombre`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`situacion`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`desde`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`hasta` FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` INNER JOIN `datos_docentes` ON `datos_docentes`.`idDocente` = `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idDocente` WHERE `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idCurso`='$curso' AND `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura`='$idAsig'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($dat1a as $da1t) { 
  $nombre=$da1t['nombre'];
  $situacion=$da1t['situacion'];
  $desde=$da1t['desde'];
  $hasta=$da1t['hasta'];
  
   $cat.="<br>Profesor: <FONT COLOR='red'>".$nombre.";</FONT> Situación: <FONT COLOR='red'>".$situacion."</FONT>; Desde: <FONT COLOR='red'>".$desde."</FONT>- Hasta: <FONT COLOR='red'>".$hasta.'</FONT><br>';


}



$consulta = "SELECT `idDescrip`, `idAsignatura`, `dia`, `horario`, `corresponde`, `curso`, `idCurso` FROM `descripasig_$cicloLectivoFINAL` WHERE `idAsignatura`='$idAsig' AND `idCurso` ='$curso'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($dat1a as $da1t) { 
  $dia=$da1t['dia'];
  $horario=$da1t['horario'];

   $cat.="<br>DIA: <FONT COLOR='red'>".$dia.";</FONT> HORARIOS: <FONT COLOR='red'>".$horario.'</FONT>';


}

echo $cat;


               }

?>
