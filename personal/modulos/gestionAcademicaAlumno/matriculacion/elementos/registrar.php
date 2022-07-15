<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

session_start();

$planF = (isset($_POST['planF'])) ? $_POST['planF'] : '';

$cursoSe = (isset($_POST['curso'])) ? $_POST['curso'] : '';

$cicloF=$_SESSION['cicloLectivo'];
$cicloFF = explode("||", $cicloF);

$cicloLectivo= $cicloFF[0]; 


$edicion= $cicloFF[1]; 




if ($cicloLectivo=='') {
    echo 'La variable ciclo no esta';
    return false;
}



if ($cursoSe=='') {
    echo 'La variable curso no esta';
    return false;
}



if ($edicion=='SI') {








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




















 

    foreach ($_FILES as $key => $file) {

        
         $nombre= $file['name'];
         $type = $file['type'];
         $size = $file['size'];
         $archivotmp = $file['tmp_name'];
         
          
    }


$lineas     = file($archivotmp);
$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);



          
        $dniAlumnos= !empty($datos[0])  ? ($datos[0]) : '';
       
        $nombreAlumnos= !empty($datos[1])  ? ($datos[1]) : '';

        $nombreAlum = utf8_encode($nombreAlumnos);


        if(!empty($dniAlumnos) ){

            $idAlumnos='';

             $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass` FROM `datosalumnos` WHERE `dniAlumnos`='$dniAlumnos'";          
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) { 
                    $idAlumnos=$dat['idAlumnos'];
                }
                        

                    if ($idAlumnos=='') {

                        $consulta = "INSERT INTO `datosalumnos`(`idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass`) VALUES (null,'$nombreAlum','$dniAlumnos','','','','','','','','','$planF','','','','','','RVNDVUVMQTE2')";                       
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();


                        $consulta = "SELECT `idAlumnos` FROM `datosalumnos` WHERE `dniAlumnos`='$dniAlumnos'";          
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();

                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach($data as $dat) { 
                                 $idAlumnos=$dat['idAlumnos'];

                            }   


                    }




                    $idIns='';

                    $consulta = "SELECT `idIns`, `idCurso`, `idAlumno` FROM `inscrip_curso_alumno_2022` WHERE `idAlumno`='$idAlumnos'";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                          
                            foreach($data as $dat) { 

                                 
                                 $idIns=$dat['idIns'];
                             }

                 if ($idIns=='') {


                    $consulta = "INSERT  INTO `inscrip_curso_alumno_$cicloLectivo`(`idIns`, `idCurso`, `idAlumno`) VALUES (null,'$cursoSe','$idAlumnos')";            
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(); 

                    $consulta1 = "SELECT `idIns`, `idCurso`, `idAlumno` FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `idAlumno`='$idAlumnos'";
                    $resultado1 = $conexion->prepare($consulta1);
                    $resultado1->execute();
                    $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data1 as $dat1) {
                        $idIns=$dat1['idIns'];
                    }









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











            }else{



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









// dddddddddddddddddddddddd



























        }   
    }
        $i++;
}


echo 1;


   // code...
}else{


    echo 0;
}



?>