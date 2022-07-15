<?php
    include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $contadorInasistencia=0;

   

    session_start();
    if (isset($_SESSION['idAlumnos'])){




$idAlumnos=$_SESSION['idAlumnos'];

$cicloF=$_SESSION['cicloFinalLet'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


 
$fila=$_SESSION['fila'];
$idAsigPendienteFinal=$_SESSION['idAsigPendiente'];






        if ($idAlumnos!=''){

               $c2onsulta = "SELECT `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre`, `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`='$idAlumnos'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idIns=$d2at['idIns'];
                    $nombreAlumnos=$d2at['nombreAlumnos'];
                    $dniAlumnos=$d2at['dniAlumnos'];
                    $nombreCurso=$d2at['nombre'];
                 } 




            $asistenciaI = array();
            $asistenciaJ = array();

           

      $columna = array();          
      $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `corresponde`='FICHA/LIBRETA'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
      $contador=0;

    
    $cantidad=0;
      foreach($data1 as $dat1) {

         $cabeNombre= $dat1['nombre'];

        array_push($columna, $cabeNombre); 


         $acumuladorInasistencia=0;
            $acumuladorJustificado=0;



            $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado` FROM `asistenciaalumno_$cicloLectivo` WHERE `encabezado`='$cabeNombre' AND `idAlumno`='$idAlumnos'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($data1 as $dat1) {

               $cantidad= $dat1['cantidad'];

               if ($cantidad=='1') {
                 $cantidad=1;
               }else if ($cantidad=='0,5') {
                 
                 $cantidad=0.5;

               }else if ($cantidad=='0,25') {
                 $cantidad=0.25;
               }

               $justificado= $dat1['justificado'];
               $encabezado= $dat1['encabezado'];

               if ($justificado=='SI') {
                 $acumuladorJustificado=$acumuladorJustificado+$cantidad;
               }else{
                  $acumuladorInasistencia=$acumuladorInasistencia+$cantidad;
               }

            } 
              array_push($asistenciaI, $acumuladorInasistencia);  
              array_push($asistenciaJ, $acumuladorJustificado);


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





$promovido='_____________________________________________________________________________';
                   $ob='________________________________________________________________________<br>_________________________________________________________________________________________<br>_________________________________________________________________________________________';
                   $lugarFecha='___________________________de_________________________de 20____';



$consulta = "SELECT `idDatosFicha`, `idAlumno`, `promovido`, `ob`, `lugarFecha` FROM `datoslibreta_2020` WHERE `idAlumno`= '$idAlumnos'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) {

                  $promovido=$dat['promovido'];
                   $ob=$dat['ob'];
                   $lugarFecha=$dat['lugarFecha'];
                }









 $asignatiraPendiente = array();
 $asignatiraPendienteFecha = array();
$asignatiraPendienteNota= array();

$asignatiraPendienteID= array();

 $asignatiraEquivalenteAsig = array();
 $asignatiraEquivalenteFecha = array();
$asignatiraEquivalenteNota= array();

$asignatiraEquivalID= array();

$consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_1`,`asignaturas_pendientes_$cicloLectivo`.`fecha_1`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_2`,`asignaturas_pendientes_$cicloLectivo`.`fecha_2`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_3`,`asignaturas_pendientes_$cicloLectivo`.`fecha_3`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_4`,`asignaturas_pendientes_$cicloLectivo`.`fecha_4`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_5`,`asignaturas_pendientes_$cicloLectivo`.`fecha_5` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivo`.`idAlumno`='$idAlumnos'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $dat) {

               $situacion= $dat['situacion'];

               $calFinal_1= $dat['calFinal_1'];
               $fecha_1= $dat['fecha_1'];
               $calFinal_2= $dat['calFinal_2'];
               $fecha_2= $dat['fecha_2'];

               $calFinal_3= $dat['calFinal_3'];
               $fecha_3= $dat['fecha_3'];

               $calFinal_4= $dat['calFinal_4'];
               $fecha_4= $dat['fecha_4'];
               
               $calFinal_5= $dat['calFinal_5'];
               $fecha_5= $dat['fecha_5'];
               

               $asisg=$dat['nombre'].' '.$dat['ciclo'];

               $idAsigPendiente=$dat['idAsigPendiente'];


               if ($situacion=='Equivalencia') {




                array_push($asignatiraEquivalID, $idAsigPendiente);
                 array_push($asignatiraEquivalenteAsig, $asisg);


                 if (($calFinal_5!='') || ($calFinal_5 > 6)) {
                  
                   array_push($asignatiraEquivalenteFecha, $fecha_5);
                   array_push($asignatiraEquivalenteNota, $calFinal_5);


                 }else if (($calFinal_4!='') || ($calFinal_4 > 6)) {
                  
                   array_push($asignatiraEquivalenteFecha, $fecha_4);
                   array_push($asignatiraEquivalenteNota, $calFinal_4);


                 }else if (($calFinal_3!='') || ($calFinal_3 > 6)) {
                  
                   array_push($asignatiraEquivalenteFecha, $fecha_3);
                   array_push($asignatiraEquivalenteNota, $calFinal_3);


                 }else if (($calFinal_2!='') || ($calFinal_2 > 6)) {
                  
                   array_push($asignatiraEquivalenteFecha, $fecha_2);
                   array_push($asignatiraEquivalenteNota, $calFinal_2);


                 }else if (($calFinal_1!='') || ($calFinal_1 > 6)) {
                  
                   array_push($asignatiraEquivalenteFecha, $fecha_1);
                   array_push($asignatiraEquivalenteNota, $calFinal_1);


                 }else{
                  
                   array_push($asignatiraEquivalenteFecha, '');
                   array_push($asignatiraEquivalenteNota, '');


                 }





               }else{


 
                   array_push($asignatiraPendienteID, $idAsigPendiente);
                   array_push($asignatiraPendiente, $asisg);


                 if (($calFinal_5!='') || ($calFinal_5 > 6)) {
                  
                   array_push($asignatiraPendienteFecha, $fecha_5);
                   array_push($asignatiraPendienteNota, $calFinal_5);


                 }else if (($calFinal_4!='') || ($calFinal_4 > 6)) {
                  
                   array_push($asignatiraPendienteFecha, $fecha_4);
                   array_push($asignatiraPendienteNota, $calFinal_4);


                 }else if (($calFinal_3!='') || ($calFinal_3 > 6)) {
                  
                   array_push($asignatiraPendienteFecha, $fecha_3);
                   array_push($asignatiraPendienteNota, $calFinal_3);


                 }else if (($calFinal_2!='') || ($calFinal_2 > 6)) {
                  
                   array_push($asignatiraPendienteFecha, $fecha_2);
                   array_push($asignatiraPendienteNota, $calFinal_2);


                 }else if (($calFinal_1!='') || ($calFinal_1 > 6)) {
                  
                   array_push($asignatiraPendienteFecha, $fecha_1);
                   array_push($asignatiraPendienteNota, $calFinal_1);


                 }else{
                  
                   array_push($asignatiraPendienteFecha, '');
                   array_push($asignatiraPendienteNota, '');


                 }







               }



                  

          }



}}














}
                    
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Libreta digital de '.$nombreAlumnos; ?></title>

<style type="text/css">



.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:140%;

  background-image: url("../../../../elementos/logo_LIBR.png");
  background-size: 30%;
  background-repeat: no-repeat;

  background-position:center;
}

.customers td, .customers th {
  border: 2px solid #031C44;
  padding: 8px;
}

.customers th {
  padding-top: 8px;
  padding-bottom: 8px;
 

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

#noImprimir {
  display: none;
}




.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:140%;
  background-image: none;
  
}

.customers td, .customers th {
  border: 2px solid #FFFFFF;
  padding: 8px;
   
}

.customers th {
  padding-top: 8px;
  padding-bottom: 8px;
 

}

.letras{
  color:#FFFFFF;
}







<?php 

if ($fila=='completa') {

?>

.asignaturas_<?php  echo $idAsigPendienteFinal;?>{
  color:#000000;
}


<?php 

}

?>


.asNota_<?php  echo $idAsigPendienteFinal;?>{
  color:#000000;
}







h1 {
  text-align: left;
}


p {
  text-align: justify;
}

</style>


<div class="letras" style="float:left;width: 50%;">



  <table  class="customers"  style="width:100%;"  >
  <thead>
    <tr>
      <th colspan="5" style='font-size: 17px; vertical-align:middle;'>  <?php

          if ($cicloLectivo=='2020') {
            echo 'Promoción Acompañada';
          }else{

            echo 'Asignaturas Pendientes de Aprobación';
          }

         ?>
</th>
    </tr>
    <tr>
      <th style='font-size: 10px; vertical-align:middle; width: 50px'>Nº de Orden</th>
      <th style='font-size: 10px; vertical-align:middle; width: 400px'>Asignaturas</th>
      <th style='font-size: 10px; vertical-align:middle; width: 70px'>Fechas</th>
      <th style='font-size: 10px; vertical-align:middle; width: 70px'>Calif.</th>
      <th style='font-size: 10px; vertical-align:middle; width: 10s0px'>Profesor/a</th>
    </tr>
  </thead>
  <tbody>



        <?php

                              


                                $contadorP=0;
                                $contar=1;
                                $resF='';
                                $notaF='';
                                foreach ($asignatiraPendiente as &$asigP) {



                                   $nota=$asignatiraPendienteNota[$contadorP];

                                    if ($nota==10) {
                                      $notaF='10 (diez)';
                                    }else if ($nota==9) {
                                      $notaF='9 (nueve)';
                                    }else if ($nota==8) {
                                      $notaF='8 (ocho)';
                                    }else if ($nota==7) {
                                      $notaF='7 (siete)';
                                    }else if ($nota==6) {
                                      $notaF='6 (seis)';
                                    }else if ($nota==5) {
                                      $notaF='5 (cinco)';
                                    }else{
                                      $notaF='';
                                    }


                                  
                
                                    $resF.="<tr style='font-size: 10px;text-align: center;'>
                                    <td>".$contar."</td>
                                    <th class='asignaturas_".$asignatiraPendienteID[$contadorP]."' style='font-size: 10px;text-align: center;'>".$asigP."</th>
                                          <th class='asNota_".$asignatiraPendienteID[$contadorP]."' style='text-align: left;font-size: 10px;'>".$asignatiraPendienteFecha[$contadorP]."</th>
                                          <th class='asNota_".$asignatiraPendienteID[$contadorP]."' style='font-size: 10px;text-align: center;'>".$notaF."</th>
                                          <td></td>
                                          </tr>";

                                    $contadorP++;
                                    $contar++;

                               

                                }


                                for ($i=$contadorP; $i < 20; $i++) { 
                                  

                                  $resF.="<tr style='font-size: 10px;text-align: center;'><th>".$contar."</th>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          </tr>";
                                          $contar++;

                                }


                                echo $resF;

                                ?>

  
     
   
  </tbody>
</table>
<br>
<table    style="width:100%"  >
  <thead>
    <tr>
      <th><span style='font-size: 16px;text-align: center;'>    



        <?php  


                              if ($lugarFecha=='') {
                                 $lugarFecha='___________________________de_________________________de 20____';


                              }



                               echo $lugarFecha;?> 






       </span></th>
   
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style='font-size: 15px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LUGAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELLO</td>
    
    </tr>
   
  </tbody>
</table>





</div>

<div id="noImprimir" class="letras" style="float:right;width: 49%;">

<table border="3"  style="width:100%"  >
  <thead>
    <tr style='text-align: center;'>
      <th><img src="../../../../elementos/logo_LIBR2.png"><h1 style='text-align: center;'><span style='font-size: 28px;text-align: center;'>ESCUELA DE EDUCACIÓN
TÉCNICA Nº16
“1º DE MAYO”</span>
</h1><h1 style='text-align: center;'><span style='font-size: 20px;text-align: center;'>BOLETÍN DE CALIFICACIONES</span></h1>


      </th>
   
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style='text-align: center;'>
      <br>
      <span style='font-size: 20px;text-align: center;'>NOMBRE Y APELLIDO DEL ALUMNO</span><br>
      <span style='font-size: 20px;text-align: center;'><b><?php  echo $nombreAlumnos;?></b></span><br><br>
      <span style='font-size: 20px;text-align: center;'>DNI DEL ALUMNO</span><br>
      <span style='font-size: 20px;text-align: center;'><b><?php  echo $dniAlumnos;?></b></span><br>
      


      </td>
    </tr>

     <tr>
      <td style='text-align: center;'>
      <br>
      <span style='font-size: 20px;text-align: center;'>CURSO Y DIVISION</span><br>
      <span style='font-size: 20px;text-align: center;'><b><?php  echo $nombreCurso;?></b></span>
      <br>

      </td>
    </tr>
   
  </tbody>
</table>


</div>



   

</div>
  



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script type="text/javascript">

        $(".print").click(function() {
  window.print();
});
</script>   
</body>
</html>


