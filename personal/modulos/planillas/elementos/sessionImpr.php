<?php 
	session_start();

	$dni=$_POST['dni'];
	$_SESSION['dni']=$dni;

	$name=$_POST['name'];
	$_SESSION['name']=$name;

	$domicilio=$_POST['domicilio'];
	$_SESSION['domicilio']=$domicilio;

	$email=$_POST['email'];
	$_SESSION['email']=$email;

	$telefono=$_POST['telefono'];
	$_SESSION['telefono']=$telefono;

	$titulo1=$_POST['titulo1'];
	$_SESSION['titulo1']=$titulo1;

	$hijos=$_POST['hijos'];
	$_SESSION['hijos']=$hijos;

	$situacion=$_POST['situacion'];
	$_SESSION['situacion']=$situacion;

	$nombreMateria=$_POST['nombreMateria'];
	$_SESSION['nombreMateria']=$nombreMateria;

	$situacionRevista=$_POST['situacionRevista'];
	$_SESSION['situacionRevista']=$situacionRevista;

	$desdeHasta=$_POST['desdeHasta'];
	$_SESSION['desdeHasta']=$desdeHasta;



	echo $titulo;

 ?>