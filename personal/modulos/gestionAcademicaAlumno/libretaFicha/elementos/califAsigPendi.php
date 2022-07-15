<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

session_start();
$res= ''.'||'.''.'||'.''.'||'.''.'||'.'';



if (isset($_SESSION['cicloLectivo'])){
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 
$idAsigPendiente = (isset($_POST['idAsigPendiente'])) ? $_POST['idAsigPendiente'] : '';
$solisitud = (isset($_POST['solisitud'])) ? $_POST['solisitud'] : '';



        $consulta = "SELECT `calFinal_$solisitud`, `fecha_$solisitud`, `libro_$solisitud`, `folio_$solisitud`, `bloque$solisitud` FROM `asignaturas_pendientes_$cicloLectivo` WHERE `idAsigPendiente`= '$idAsigPendiente'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                
                            $calFinal=$dat['calFinal_'.$solisitud];
                            $fecha=$dat['fecha_'.$solisitud];
                            $libro=$dat['libro_'.$solisitud];

                            $folio=$dat['folio_'.$solisitud];
                            $bloque=$dat['bloque'.$solisitud];
                           
                          
                            $res= $calFinal.'||'.$fecha.'||'.$libro.'||'.$folio.'||'.$bloque;
                        }

                        echo $res;
     

$conexion = NULL;

}