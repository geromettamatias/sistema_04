<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$Libro='';
$Folio='';

$auxiliar='';
$piePagina='';
$res='';

if (isset($_SESSION['cicloLectivo'])){
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$idAlumno = (isset($_POST['idAlumno'])) ? $_POST['idAlumno'] : '';



        $consulta = "SELECT `idDatoExtraFicha`, `idAlumno`, `Libro`, `Folio`, `auxiliar`, `piePagina` FROM `datosficha_$cicloLectivo` WHERE `idAlumno`='$idAlumno'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                
                            $Libro=$dat['Libro'];
                            $Folio=$dat['Folio'];
                            
                            $auxiliar=$dat['auxiliar'];
                            $piePagina=$dat['piePagina'];

                  
                          
                            
                        }

                        $res= $Libro.'||'.$Folio.'||'.$auxiliar.'||'.$piePagina;

                        echo $res;
     
}else{

     $res= $Libro.'||'.$Folio.'||'.$auxiliar.'||'.$piePagina;

     echo $res;
}
$conexion = NULL;