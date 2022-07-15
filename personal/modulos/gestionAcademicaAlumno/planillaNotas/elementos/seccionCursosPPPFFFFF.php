<?php 
	session_start();

	$asignatura=$_POST['asignatura'];
	$_SESSION['idasignatura']=$asignatura;

	$situacionNota=$_POST['situacionNota'];
	$_SESSION['situacionNota']=$situacionNota;

	echo '1';
	

 ?>