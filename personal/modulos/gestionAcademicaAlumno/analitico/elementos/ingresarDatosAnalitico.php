<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
$Libro = (isset($_POST['Libro'])) ? $_POST['Libro'] : '';
$Folio = (isset($_POST['Folio'])) ? $_POST['Folio'] : '';
$egreso = (isset($_POST['egreso'])) ? $_POST['egreso'] : '';
$lugar = (isset($_POST['lugar'])) ? $_POST['lugar'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$obs = (isset($_POST['obs'])) ? $_POST['obs'] : '';
$idAlumno = (isset($_POST['idAlumno'])) ? $_POST['idAlumno'] : '';



	$pref=0;

	$consulta = "SELECT `id_datos_anali`, `idAlumno`, `Libro`, `Folio`, `egreso`, `lugar`, `fecha`, `obs` FROM `analitico_datos` WHERE `idAlumno`='$idAlumno'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $dat) { 

            $pref=1;                

            }

    if ($pref==0) {
                 
        $consulta = "INSERT INTO `analitico_datos`(`id_datos_anali`, `idAlumno`, `Libro`, `Folio`, `egreso`, `lugar`, `fecha`, `obs`) VALUES (null,'$idAlumno','$Libro','$Folio','$egreso','$lugar','$fecha','$obs')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

      	
    }else{

    
    	  $consulta = "UPDATE `analitico_datos` SET `Libro`='$Libro',`Folio`='$Folio',`egreso`='$egreso',`lugar`='$lugar',`fecha`='$fecha',`obs`='$obs' WHERE `idAlumno`='$idAlumno'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
    }    

echo "Muy Bien";
$conexion = NULL;
