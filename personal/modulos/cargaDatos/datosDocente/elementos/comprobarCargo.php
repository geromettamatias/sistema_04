<?php 
	session_start();

	$cargoF=$_POST['cargoF'];



         $cicloF=$_SESSION['cicloLectivoFina'];

$cicloFF = explode("||", $cicloF);
$cicloLectivoFINAL= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



 include_once '../../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();
                  $res='SIN ASIGNACIÓN';

                  $consulta = "SELECT `datos_docentes`.`nombre`, `datos_docentes`.`dni`, `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL`.`situacion`, `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL`.`desde`, `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL`.`hasta` FROM `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL`INNER JOIN `datos_docentes` ON `datos_docentes`.`idDocente` = `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL`.`idDocente` WHERE `cargo`='$cargoF'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $nombre=$da1t['nombre'];
                    $dni=$da1t['dni'];
                    $situacion=$da1t['situacion'];
                    $desde=$da1t['desde'];
                    $hasta=$da1t['hasta'];
                     
					$res='Profesor: '.$nombre.'; DNI: '.$dni.'; SITUACIÓN: '.$situacion.'; desde: '.$desde.'; hasta: '.$hasta;


                  }
	echo $res;
	


 ?>