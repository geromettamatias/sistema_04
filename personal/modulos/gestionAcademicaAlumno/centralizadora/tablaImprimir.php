<?php
  
     include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    session_start();
     $cursoSe=$_SESSION['cursoSe'];



    $consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_2021` WHERE `idCurso`='$cursoSe'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
      foreach($data1 as $dat1) {

        $nombreCurso= $dat1['nombre'];
        $cicloCorrespondiente= $dat1['ciclo'];

     
    }






                        $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

       
         $columna = array();  

        $cantidadCabezeras=0;
      $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `corresponde`='FICHA/LIBRETA'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
      foreach($data1 as $dat1) {

        $cantidadCabezeras++;

         $cabeNombre= $dat1['nombre'];

         array_push($columna, $cabeNombre); 

    }




$c2onsulta = "SELECT  `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idIns=$d2at['idIns'];
                }



   $asignaturas = array();
      $notas = array();
      $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

      foreach($data as $dat) {
        $id_libretaF=$dat['id_libreta'];
        

        array_push($asignaturas, $dat['nombre']);

        foreach ($columna as &$Nombrecolum) {
                $consulta = "SELECT `id_libreta`, `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) {

                  array_push($notas, $dat[''.$Nombrecolum.'']);

                }

          }

}


                  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENTRALIZADORA</title>

<style type="text/css">



.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:120%;


}

.customers td, .customers th {
  border: 1px solid #031C44;
  padding: 0px;
}

.customers th {
  padding-top: 0px;
  padding-bottom: 0px;
 

}




.boton_personalizado{
    text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 20px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }



</style>
</head>
<body>




<div id="ocultarBotonImpri" class="container ">
  <div class="row ">
    <div class="col-lg-12 p-4 ">
      <button class="boton_personalizado  print">Imprimir </button>
    </div>
  </div>
</div>


<div class="imprimir" id="imprimir">
        <!-- Compiled and minified CSS -->

                <style type="text/css" media="print">
   @media print {
 
    #sidebar {
        display:none;
    } 
    main {
        float:none;
    } 
}

@page{    
    size: legal landscape;
    margin: 1cm;  /* this affects the margin in the printer settings */


}

header, footer, nav, aside {
  display: none;
}

#ocultarBotonImpri {
  display: none;
}


.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  font-size:80%;
  
}

.customers td, .customers th {
  border: 1px solid #031C44;
  padding: 0px;
   
}

.customers th {
  padding-top: 0px;
  padding-bottom: 0px;
 

}




</style>




<?php echo '<h2><b>Nombre del Curso:</b> '.$nombreCurso.'<b>; Corresponde al:</b> '.$cicloCorrespondiente.'<b>; Ciclo Lectivo:</b> '.$cicloLectivo.'</h2><p><u><b>Aclaración:</u></b>En esta planilla se detalla todas las materias con sus correspondientes notas, de <u><b>todas las NOTAS</u></b></p>';?>







<table class="customers" style='font-size: 10px; vertical-align:middle;width:100%'>
       <thead>
            <tr style='text-align: center;'>
                
                <th rowspan="2">Apellido y Nombre</th>
                <th rowspan="2">DNI</th>
                <?php
                $cantidadAsignatura=0;
                foreach ($asignaturas as &$asig) {

                  $cantidadAsignatura++;
                ?>
                <th colspan="<?php echo $cantidadCabezeras; ?>"><?php echo $asig; ?></th>

                <?php
                 }
                  
                ?>

               
            </tr>
            <tr style='text-align: center;'>
            <?php

              for ($i=0; $i < $cantidadAsignatura; $i++) { 
             

              foreach ($columna as &$Nombrecolum) {          
            ?>
              <th><span style='writing-mode: vertical-rl; transform: rotate(180deg); vertical-align:middle;'><?php echo $Nombrecolum; ?></span></th>

            <?php
              }  
              }
                  
            ?>


                
            </tr>
        </thead>


        <tbody>

          <?php
               
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
                

                  
            ?>


            <tr style='text-align: center;'>
                
                <td style='font-size: 9px'><b><?php  echo $nombreAlumnos;?></b></td>
                <td><b><?php  echo $dniAlumnos;?></b></td>

                 <?php
              
      
                $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $dat) {
                  $id_libretaF=$dat['id_libreta'];
                  
                  foreach ($columna as &$Nombrecolum) {
                          $consulta = "SELECT `id_libreta`, `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                          $resultado = $conexion->prepare($consulta);
                          $resultado->execute();
                          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                          foreach($data as $dat) {


            ?>

                            <td><b><?php  




                            $nota= $dat[''.$Nombrecolum.''];



                            if ($nota<6) {
                             echo '<FONT COLOR="red">'.$nota.'</FONT>';
                            }else{
                              echo '<FONT COLOR="black">'.$nota.'</FONT>';
                            }





                            ?></b></td>


                       <?php
           

                          }

                    }






          }
                  
            ?>  

            </tr>

             <?php
              }  
              
                  
            ?>
        </tbody>
      
    </table>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script type="text/javascript">

        $(".print").click(function() {
  window.print();
});
</script>   
</body>
</html>



