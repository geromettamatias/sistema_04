<?php 
	session_start();

	$idAlumnos=$_POST['idAlumnos'];
	$_SESSION['idAlumnos']=$idAlumnos;


                  $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivoFina= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


  $_SESSION['cicloLectivoFina']=$cicloLectivoFina;



 include_once '../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();
                  $conta='0';

                 $consulta = "SELECT `idIns`, `idCurso`, `idAlumno` FROM `inscrip_curso_alumno_$cicloLectivoFina` WHERE `idAlumno`='$idAlumnos'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($data as $da1t) { 
                    $idIns=$da1t['idIns'];
                     
					         $_SESSION['idIns']=$idIns;
                  $conta='1';

                  }

	echo $conta;
	

 ?>