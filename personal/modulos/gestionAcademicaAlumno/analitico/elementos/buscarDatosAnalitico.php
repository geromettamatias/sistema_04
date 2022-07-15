<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$Libro='';
$Folio='';
$egreso='';
$lugar='';
$fecha='';
$obs='';



$idAlumno = (isset($_POST['idAlumno'])) ? $_POST['idAlumno'] : '';



        $consulta = "SELECT `id_datos_anali`, `idAlumno`, `Libro`, `Folio`, `egreso`, `lugar`, `fecha`, `obs` FROM `analitico_datos` WHERE `idAlumno`='$idAlumno'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                
                            $Libro=$dat['Libro'];
                            $Folio=$dat['Folio'];
                            $egreso=$dat['egreso'];

                            $lugar=$dat['lugar'];
                            $fecha=$dat['fecha'];
                            $obs=$dat['obs'];
                       
                          
                            
                        }

                        $res= $Libro.'||'.$Folio.'||'.$egreso.'||'.$lugar.'||'.$fecha.'||'.$obs;

                        echo $res;

$conexion = NULL;