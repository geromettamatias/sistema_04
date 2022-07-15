<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS 
 session_start();
 if (isset($_SESSION['idAlumnos'])){
        $idAlumnos=$_SESSION['idAlumnos'];

        $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$calfinal = (isset($_POST['calfinal'])) ? $_POST['calfinal'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';

$libro = (isset($_POST['libro'])) ? $_POST['libro'] : '';

$folio = (isset($_POST['folio'])) ? $_POST['folio'] : '';
$bloqueFIL = (isset($_POST['bloqueFIL'])) ? $_POST['bloqueFIL'] : '';

$solisitud = (isset($_POST['solisitud'])) ? $_POST['solisitud'] : '';
$idAsigPendiente = (isset($_POST['idAsigPendiente'])) ? $_POST['idAsigPendiente'] : '';



        $consulta = "UPDATE `asignaturas_pendientes_$cicloLectivo` SET `calFinal_$solisitud`='$calfinal',`fecha_$solisitud`='$fecha',`libro_$solisitud`='$libro',`folio_$solisitud`='$folio',`bloque$solisitud`='$bloqueFIL' WHERE `idAsigPendiente`='$idAsigPendiente'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

      



}
