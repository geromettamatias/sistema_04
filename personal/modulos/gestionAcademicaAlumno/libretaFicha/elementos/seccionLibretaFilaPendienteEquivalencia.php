<?php 
	session_start();


	$fila=$_POST['fila'];
	$_SESSION['fila']=$fila;

	$idAsigPendiente=$_POST['idAsigPendiente'];
	$_SESSION['idAsigPendiente']=$idAsigPendiente;

	$idAlumnos=$_POST['idAlumnos'];
	$_SESSION['idAlumnos']=$idAlumnos;

	$cicloFinalLet=$_POST['cicloFinalLet'];
	$_SESSION['cicloFinalLet']=$cicloFinalLet;


	echo '1';
	

 ?>