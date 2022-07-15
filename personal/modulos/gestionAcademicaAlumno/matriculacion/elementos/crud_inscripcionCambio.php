<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
  if ((isset($_SESSION['cicloLectivo']))){
    

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



$cursoSe = (isset($_POST['cursoSe'])) ? $_POST['cursoSe'] : '';

 $arrayContieneLosElementosAEliminar = (isset($_POST['arrayContieneLosElementosAEliminar'])) ? $_POST['arrayContieneLosElementosAEliminar'] : '';






//  CABEZERAS


$inicio='';
$final='';

   $consulta1 = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde`, `tipo` FROM `cabezera_libreta_digital_$cicloLectivo` ORDER BY `idCabezera` ASC";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();
        $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);
        foreach($data1 as $dat1) {

            $nombre=$dat1['nombre'];
            

                 $inicio.=',`'.$nombre.'`';
                $final.=', ""';
              


          

        }


// Final Cabe














        foreach ($arrayContieneLosElementosAEliminar as $idIns) {
        
            $consulta = "UPDATE `inscrip_curso_alumno_$cicloLectivo` SET `idCurso`='$cursoSe' WHERE `idIns`='$idIns'";      
             $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "DELETE FROM `libreta_digital_$cicloLectivo` WHERE `idIns`='$idIns' ";      
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();





     // cargaLibreta

        $inicioLibreta='';
        $finalLibreta='';
        $contadorLibre=0;


        $consulta = "SELECT `plan_datos_asignaturas`.`idAsig` FROM `plan_datos_asignaturas` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`ciclo` = `plan_datos_asignaturas`.`ciclo` AND `curso_$cicloLectivo`.`idPlan` = `plan_datos_asignaturas`.`idPlan` WHERE `curso_$cicloLectivo`.`idCurso`='$cursoSe'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) { 
                    $idAsig=$dat['idAsig'];
                            
                    if ($contadorLibre==0) {
                        $contadorLibre=1;

                        $inicioLibreta='(`id_libreta`, `idIns`, `idAsig`'.$inicio.')';
                        $finalLibreta='(null,'.$idIns.','.$idAsig.$final.')';


                    }else{

            
                        $finalLibreta.=',(null,'.$idIns.','.$idAsig.$final.')';


                    }

                   
                } 



                $c1onsulta = "INSERT INTO `libreta_digital_$cicloLectivo`".$inicioLibreta." VALUES ".$finalLibreta."";
                     $r1esultado = $conexion->prepare($c1onsulta);
                     $r1esultado->execute();

    
  
                     // fin  






            }
                 
            echo 1;
   
                        


}
$conexion = NULL;



   
         