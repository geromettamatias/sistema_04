<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$nombresColumnas = (isset($_POST['nombresColumnas'])) ? $_POST['nombresColumnas'] : '';
$arrayIdeLibreta = (isset($_POST['arrayIdeLibreta'])) ? $_POST['arrayIdeLibreta'] : '';

$arrayNotasCompletas = (isset($_POST['arrayNotasCompletas'])) ? $_POST['arrayNotasCompletas'] : '';
$contComas = (isset($_POST['contComas'])) ? $_POST['contComas'] : '';
$contComasFijo= (isset($_POST['contComas'])) ? $_POST['contComas'] : '';

$contador=0;


foreach($arrayIdeLibreta as $idLibreta) {

$editarDatos='';

    foreach($nombresColumnas as $nombresColu) {


        if ($contComas == 1) {
            $editarDatos.=' `'.$nombresColu.'`'.'='."'".$arrayNotasCompletas[$contador]."' ";
        }else{
            $editarDatos.=' `'.$nombresColu.'`'.'='."'".$arrayNotasCompletas[$contador]."', ";
        }
        $contador++;
        $contComas--;

        
    }

  $consulta = "UPDATE `libreta_digital_$cicloLectivo` SET $editarDatos WHERE `id_libreta`='$idLibreta'";        
         $resultado = $conexion->prepare($consulta);
         $resultado->execute();  

        

     echo 'Proceso Finalizado --N°Libreta'.$idLibreta;

  $contComas=$contComasFijo;
}


      


  

$conexion = NULL;