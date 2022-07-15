<?php 
	session_start();

	$columnaSEle=$_POST['columnaSEle'];
	$_SESSION['columnaSEle']=$columnaSEle;

	$tipoGrafico=$_POST['tipoGrafico'];
	$_SESSION['tipoGrafico']=$tipoGrafico;


	echo '1';
	

 ?>