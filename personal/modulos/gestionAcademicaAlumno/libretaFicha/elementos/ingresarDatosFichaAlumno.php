<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
$Libro = (isset($_POST['Libro'])) ? $_POST['Libro'] : '';
$Folio = (isset($_POST['Folio'])) ? $_POST['Folio'] : '';

$idAlumno = (isset($_POST['idAlumno'])) ? $_POST['idAlumno'] : '';
$auxiliar = (isset($_POST['auxiliar'])) ? $_POST['auxiliar'] : '';
$piePagina = (isset($_POST['piePagina'])) ? $_POST['piePagina'] : '';

if (isset($_SESSION['cicloLectivo'])){
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 	
	$pref=0;

	$consulta = "SELECT `idDatoExtraFicha`, `idAlumno` FROM `datosficha_$cicloLectivo` WHERE `idAlumno`='$idAlumno'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $dat) { 

            $pref=1;                

            }

    if ($pref==0) {
                 
        $consulta = "INSERT INTO `datosficha_$cicloLectivo`(`idDatoExtraFicha`, `idAlumno`, `Libro`, `Folio`, `auxiliar`, `piePagina`) VALUES (null,'$idAlumno','$Libro','$Folio','$auxiliar','$piePagina')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

      	
    }else{

    
    	  $consulta = "UPDATE `datosficha_$cicloLectivo` SET `Libro`='$Libro',`Folio`='$Folio',`auxiliar`='$auxiliar',`piePagina`='$piePagina' WHERE `idAlumno`='$idAlumno'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
    }    

echo "Muy Bien";
$conexion = NULL;

}