<?php 
	session_start();

	$id = (isset($_POST['id'])) ? $_POST['id'] : '';
	$_SESSION['id_Alumno_Asistencia']=$id;

	$cicloLectivoFina = (isset($_POST['cicloLectivoFina'])) ? $_POST['cicloLectivoFina'] : '';
	$_SESSION['cicloLectivo']=$cicloLectivoFina;


	echo $id;
	


 ?>