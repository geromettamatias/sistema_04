<?php 
	session_start();

	$cursoSele=$_POST['cursoSele'];
	$_SESSION['cursoSele']=$cursoSele;

	$planSeleC=$_POST['planSeleC'];
	$_SESSION['planSeleC']=$planSeleC;

	$cicloLectivo=$_POST['cicloLectivo'];
	$_SESSION['cicloLectivo']=$cicloLectivo;

	echo '1';
	

 ?>