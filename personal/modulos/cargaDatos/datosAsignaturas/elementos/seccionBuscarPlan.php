<?php 
	session_start();

	$planSele=$_POST['planSele'];
	$_SESSION['planSele']=$planSele;

	echo $planSele;
	


 ?>