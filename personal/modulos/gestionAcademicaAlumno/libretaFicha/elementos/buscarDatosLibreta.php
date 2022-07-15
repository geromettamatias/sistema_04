<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$promovido='';
$ob='';
$lugarFecha='';

$res='';

if (isset($_SESSION['cicloLectivo'])){
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$idAlumno = (isset($_POST['idAlumno'])) ? $_POST['idAlumno'] : '';



        $consulta = "SELECT `idDatosFicha`, `idAlumno`, `promovido`, `ob`, `lugarFecha` FROM `datoslibreta_$cicloLectivo` WHERE `idAlumno`='$idAlumno'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                
                            $promovido=$dat['promovido'];
                            $ob=$dat['ob'];
                            $lugarFecha=$dat['lugarFecha'];

                       
                  
                          
                            
                        }

                        $res= $promovido.'||'.$ob.'||'.$lugarFecha;

                        echo $res;
     
}else{

     $res= $promovido.'||'.$ob.'||'.$lugarFecha;

     echo $res;
}
$conexion = NULL;