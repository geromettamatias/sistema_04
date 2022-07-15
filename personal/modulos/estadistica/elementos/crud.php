<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$boto = (isset($_POST['boto'])) ? $_POST['boto'] : '';


if ($boto==1) {

$var='';


$consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) {   
$ciclo=$dat['ciclo'];


$cantidadIscripto=0;

if ($var!='') {
  $var.='||';
}



$consulta1 = "SELECT count(*) AS 'cantidadIscripto' FROM `inscrip_curso_alumno_$ciclo`";
$resultado2 = $conexion->prepare($consulta1);
$resultado2->execute();
$data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
foreach($data2 as $dat3) {   
$cantidadIscripto=$dat3['cantidadIscripto'];

}

$var.=$ciclo.';'.$cantidadIscripto;


}


echo $var;






}


if ($boto==2) {


$cantidadAlumnos=0;
$consulta = "SELECT count(*) AS 'cantidadAlumnos' FROM `datosalumnos`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) {   
$cantidadAlumnos=$dat['cantidadAlumnos'];
}

$cantidadDocente=0;
$consulta = "SELECT count(*) AS 'cantidadDocente' FROM `personal_eet16`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) {   
$cantidadDocente=$dat['cantidadDocente'];
}

$cantidadAdmin=0;
$consulta = "SELECT count(*) AS 'cantidadAdmin' FROM `personal_eet16` WHERE `cargo`='Administrador'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) {   
$cantidadAdmin=$dat['cantidadAdmin'];
}


echo $cantidadAlumnos.'||'.$cantidadDocente.'||'.$cantidadAdmin;


}

if ($boto==3) {


 if ((isset($_SESSION['cursoSe']))){
          $cursoSe=$_SESSION['cursoSe'];

      





// antes


                          $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

       $columnaSEle=$_SESSION['columnaSEle'];
       


$contador=0;

$cantidadInscripto=0;
$c2onsulta = "SELECT  `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idIns=$d2at['idIns'];
                    $cantidadInscripto++;
                }



   $asignaturas = array();
    
      $sumaPositiva=array();
      $sumaNegativa=array();
      $CantidadAprobad=array();
      $CantidadDesap=array();



      $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

      foreach($data as $dat) {
        $id_libretaF=$dat['id_libreta'];
        
        $contador++;
        array_push($asignaturas, $dat['nombre']);

     
         array_push($sumaPositiva, 0);
          array_push($sumaNegativa, 0);


          array_push($CantidadAprobad, 0);
          array_push($CantidadDesap, 0);



}


                  

  

                $c2onsulta = "SELECT `datosalumnos`.`idAlumnos`,`datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre`, `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idAlumnos=$d2at['idAlumnos'];
                    $nombreAlumnos=$d2at['nombreAlumnos'];
                    $dniAlumnos=$d2at['dniAlumnos'];
                    $nombreCurso=$d2at['nombre'];
                

                    $idIns=$d2at['idIns'];


      $contadorNuevo=0;
     
                $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $dat) {
                  $id_libretaF=$dat['id_libreta'];
                  
                          $consulta = "SELECT `id_libreta`, `$columnaSEle` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                          $resultado = $conexion->prepare($consulta);
                          $resultado->execute();
                          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                          foreach($data as $dat) {



                            $nota= $dat[''.$columnaSEle.''];



                          if (($nota=='') || ($nota=='undefined')) {
                          	$nota=0;
                          }


            				if ($nota < 6) {
            					
            					$CantidadDesap[$contadorNuevo]=$CantidadDesap[$contadorNuevo] + 1;


                        if ($nota==0) {
                          $sumaNegativa[$contadorNuevo]= $nota+0;
                        }else if ($nota==1) {
                          $sumaNegativa[$contadorNuevo]= $nota+0;
                        }else if ($nota==2) {
                          $sumaNegativa[$contadorNuevo]= $nota+0;
                        }else if ($nota==3) {
                          $sumaNegativa[$contadorNuevo]= $nota+0;
                        }else if ($nota==4) {
                          $sumaNegativa[$contadorNuevo]= $nota+0;
                        }else if ($nota==5) {
                          $sumaNegativa[$contadorNuevo]= $nota+0;
                        }else{
                          $sumaNegativa[$contadorNuevo]= $nota+0;
                        }
                        


            				}else{

                        $CantidadAprobad[$contadorNuevo]=$CantidadAprobad[$contadorNuevo] + 1;
							    
                       
                                  if ($nota==0) {
                                    $sumaPositiva[$contadorNuevo]= $nota+0;
                                  }else if ($nota==1) {
                                    $sumaPositiva[$contadorNuevo]= $nota+0;
                                  }else if ($nota==2) {
                                    $sumaPositiva[$contadorNuevo]= $nota+0;
                                  }else if ($nota==3) {
                                    $sumaPositiva[$contadorNuevo]= $nota+0;
                                  }else if ($nota==4) {
                                    $sumaPositiva[$contadorNuevo]= $nota+0;
                                  }else if ($nota==5) {
                                    $sumaPositiva[$contadorNuevo]= $nota+0;
                                  }else{
                                    $sumaPositiva[$contadorNuevo]= $nota+0;
                                  }
                        
           				
							
                    }

                          	$contadorNuevo++;


            				}

                 

                          


          }
                  
    
              }  
              





//  fin
$final=[];



array_push($final, $asignaturas);

array_push($final, $sumaNegativa);

array_push($final, $sumaPositiva);

array_push($final, $CantidadDesap);
array_push($final, $CantidadAprobad);

array_push($final, $cantidadInscripto);


$nombreCurso='NO FUNCIONA';
$consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `idCurso`='$cursoSe'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($data as $dat) { 
          $nombreCurso=$dat['nombre'];
    }

array_push($final, $nombreCurso);










print json_encode($final, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;




 }

}