<?php 
	session_start();

	$cursoSeleB=$_POST['cursoSeleB'];
	$_SESSION['cursoSeleB']=$cursoSeleB;

	$cicloLectivo=$_POST['cicloLectivo'];
	$_SESSION['cicloLectivo']=$cicloLectivo;


	echo '1';
	

 ?>