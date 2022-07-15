<?php 
	session_start();

	$tipoProfesor=$_POST['tipo'];
	$_SESSION['tipoProfesor']=$tipoProfesor;


	echo 1;
	

 ?>