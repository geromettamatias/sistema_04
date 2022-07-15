<?php 
	session_start();

	$cicloLectivoFina = (isset($_POST['cicloLectivoFina'])) ? $_POST['cicloLectivoFina'] : '';
	$_SESSION['cicloLectivo']=$cicloLectivoFina;


	echo $cicloLectivoFina;
	


 ?>