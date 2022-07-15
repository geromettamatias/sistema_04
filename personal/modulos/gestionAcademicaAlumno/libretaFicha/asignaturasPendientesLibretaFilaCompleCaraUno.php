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



<div class="letras" style="float:left;width: 33%;">
  <span style='font-size: 16px;'>CURSO Y DIVISIÓN: <b><?php  echo $nombreCurso;?></b></span>
</div>

<div class="letras" style="float:left;width: 52%;">
<span style='font-size: 16px;'>BOLETIN DE CALIFICACIONES DE: <b><?php  echo $nombreAlumnos;?></b>; DNI: <b><?php  echo $dniAlumnos;?></b></span>
 
</div>

<div class="letras" style="float:left;width: 15%;">
<span style='font-size: 16px;'>CICLO LECTIVO: <?php  echo $cicloLectivo;?></span>
 
</div>
  



        <table  class="customers"  style="width:100%" >
                        <thead class="letras">
                            <tr>
                      
                                <th colspan="2" rowspan="2" class="table-danger"  rowspan="2"><span style='  font-size: 24px;writing-mode: vertical-rl; transform: rotate(180deg); vertical-align:middle;'>Asignatura</span></th>

                                  
                                <?php

                                
                                
                                foreach ($asignaturas as &$asig) {
                                ?>

                                <th rowspan="2"><span style='writing-mode: vertical-rl;transform: rotate(180deg); font-size: 13px;'><?php  echo $asig;?></span></th>
                                
                                <?php } ?>
                                

                                <th colspan="2" style='font-size: 13px; vertical-align:middle;'>INASIST</th>

                                <th rowspan="2" style='font-size: 16px; vertical-align:middle;'>Firma de Autoridad Competente</th>
                                <th colspan="2" rowspan="2" style='font-size: 16px; vertical-align:middle;'>Firma del Padre Tutor o Encargado</th>

                            </tr>

                            <tr>
                      
                                <th ><span style='writing-mode: vertical-rl;transform: rotate(180deg); font-size: 14px;'>INJUSTIFICADAS</span></th>
                                <th ><span style='writing-mode: vertical-rl;transform: rotate(180deg); font-size: 14px;'>JUSTIFICADAS</span></th>

                            </tr>


                           
                        </thead>
                        <tbody class="letras">

                          <?php

                                $cantidadColu =count($columna);
                               
                                $cantidadAsig=0;
                                $conta=0;
                                foreach ($columna as &$colu) {
                                ?>

                                <tr>
                                <th colspan="2" style='font-size: 12px; vertical-align:middle;'><?php  echo $colu;?></th>
                                

                                <?php

                                $conta1=$cantidadAsig;
                                foreach ($asignaturas as &$asig) {
                                ?>

                                <th class="NOTA_<?php  echo $cantidadAsig;?>" style='font-size: 12px; vertical-align:middle;'><?php  




                                if ($notas[$conta1]=='3' || $notas[$conta1]=='4'  || $notas[$conta1]=='5'  || $notas[$conta1]=='2'  || $notas[$conta1]=='1'  || $notas[$conta1]=='0') {
                                   echo 'EP';
                                }else{

                                echo $notas[$conta1];
                                }

                              



                                ?></th>


                                 <?php 

                                 $conta1= $cantidadColu+$conta1;

                               } ?>


                                <th class="NOTA_<?php  echo $cantidadAsig;?>" style='font-size: 12px; vertical-align:middle;'> <?php 

                               
                                if ($asistenciaI[$contadorInasistencia]==0) {
                                  echo "";
                                }else{

                                  echo $asistenciaI[$contadorInasistencia];

                                

                                }



                                


                                 ?></th>
                                <th class="NOTA_<?php  echo $cantidadAsig;?>" style='font-size: 12px; vertical-align:middle;'><?php 

                               
                                if ($asistenciaJ[$contadorInasistencia]==0) {
                                  echo "";
                                }else{


                                  echo $asistenciaJ[$contadorInasistencia];

                                }

                                 $contadorInasistencia++;


                                 ?></th>
                                <th></th>
                                <th colspan="2"></th>
                             

                                </tr>

                                <?php 
                                $cantidadAsig++;

                              } ?>


                            <tr>
                              <th rowspan="2" colspan="<?php  $asignaturas =count($asignaturas)-4;

                               echo $asignaturas;?>" style='text-align: left ;font-size: 15px; vertical-align:middle;' >Promovido a: <?php  


                              if ($promovido=='') {
                                $promovido=' _____________________________________________________________________________';
                              }



                               echo $promovido;?>

                              </th>
                              <th colspan="10" style='font-size: 10px;text-align: center;' >Equivalencias</th>
                             
                            
                            </tr>
                              <tr>

                             
                              
                              <th colspan="8" style='font-size: 10px;text-align: center;'>Asignatura</th>
                              <th style='font-size: 10px;text-align: center;' >Fecha</th>
                              <th style='font-size: 10px;text-align: center;' >Calif</th>
                            
                            </tr>

                            <tr>

                              <th rowspan="6" colspan="<?php 

                               echo $asignaturas;?>" style='text-align: left ;font-size: 15px; vertical-align:middle;width: 1200px'>OBSERVACIONES: <?php  


               
                              if ($ob=='') {
                                $ob='________________________________________________________________________<br>_________________________________________________________________________________________<br>_________________________________________________________________________________________';
                              }



                               echo $ob;



                               ?> </th>
                              
                             
                              <?php

                              

                                $contador=0;
                                $notaF='';
                                $res='';

                                foreach ($asignatiraEquivalenteAsig as &$asig) {

                                    $nota=$asignatiraEquivalenteNota[$contador];

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


                                  if ($contador<5) {

                                  if ($contador==0) {
                                    $res.="<th class='asignaturas_".$asignatiraEquivalID[$contador]."' colspan='8' style='text-align: left;font-size: 10px;'>".$asig."</th>
                                          <th class='asNota_".$asignatiraEquivalID[$contador]."' style='font-size: 10px;'>".$asignatiraEquivalenteFecha[$contador]."</th>
                                          <th class='asNota_".$asignatiraEquivalID[$contador]."' style='font-size: 10px;'>".$notaF."</th>
                                          </tr>";

                                    $contador++;
                                  }else if ($contador!=0) {
                                    $res.="<tr style='font-size: 10px;text-align: center;'><th class='asignaturas_".$asignatiraEquivalID[$contador]."' colspan='8' style='text-align: left;font-size: 10px;'>".$asig."</th>
                                          <th class='asNota_".$asignatiraEquivalID[$contador]."' style='font-size: 10px;text-align: center;'>".$asignatiraEquivalenteFecha[$contador]."</th>
                                          <th class='asNota_".$asignatiraEquivalID[$contador]."' style='font-size: 10px;text-align: center;'>".$notaF."</th>
                                          </tr>";

                                    $contador++;
                                  }


                                  }

                                }


                                for ($i=$contador; $i < 5; $i++) { 
                                  

                                  $res.="<tr><th colspan='8' style='font-size: 10px;'>-</th>
                                          <th></th>
                                          <th></th>
                                          </tr>";


                                }


                                echo $res;

                                ?>





                                                   
                        </tbody>        
                       </table>

<span class="letras" style='font-size: 10px; vertical-align:middle;'>LA CALIFICACIÓN CORRESPONDIENTE A PENDIENTE DE APROBACIÓN SE CONSIGNARA CUANDO SEA APROBATOTIA. ENMIENDAS Y RASOADURAS, PARA SER VALIDAS DEBEN CONTAR EN OBSEVACIONES CON LA FIRMA DEL DIRECTOR</span>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script type="text/javascript">

        $(".print").click(function() {
  window.print();
});
</script>   
</body>
</html>


