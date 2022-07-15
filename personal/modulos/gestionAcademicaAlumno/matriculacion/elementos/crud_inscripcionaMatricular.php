<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
  if ((isset($_SESSION['cursoSe']))){
          $cursoSe=$_SESSION['cursoSe'];


$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



$idIns = (isset($_POST['idIns'])) ? $_POST['idIns'] : '';

$idAlumnos = (isset($_POST['idAlumnos'])) ? $_POST['idAlumnos'] : '';



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

$respuesta='';




    $pregunta=0;

    $consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `datosalumnos`.`dniAlumnos`, `datosalumnos`.`nombreAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos`= `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`='$idAlumnos'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                          
                    foreach($data as $dat) { 

                         
                         $idIns=$dat['idIns'];
                     
                        
                         $pregunta=1;


                        $idIns=$dat['idIns'];
                        $dniAlumnos=$dat['dniAlumnos'];
                        $nombreAlumnos=$dat['nombreAlumnos'];
                        $nombre=$dat['nombre'];
               
                        $respuesta=$idIns.'||'.$dniAlumnos.'||'.$nombreAlumnos.'||'.$nombre.'||SI';
                                  
            }







if ($pregunta==1) {
   echo $respuesta;
}else{


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




        $consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `datosalumnos`.`dniAlumnos`, `datosalumnos`.`nombreAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos`= `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` ORDER BY `inscrip_curso_alumno_$cicloLectivo`.`idIns` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data1 as $dat1) {
            $idIns=$dat1['idIns'];
            $dniAlumnos=$dat1['dniAlumnos'];
            $nombreAlumnos=$dat1['nombreAlumnos'];
            $nombre=$dat1['nombre'];
        }

        $respuesta=$idIns.'||'.$dniAlumnos.'||'.$nombreAlumnos.'||'.$nombre.'||NO';

            
        echo $respuesta;
    }

    

}
$conexion = NULL;



   
                    
                  