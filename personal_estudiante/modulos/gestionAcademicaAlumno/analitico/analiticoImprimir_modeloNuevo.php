
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E.E.T. N° 16</title>
<style type="text/css" >
 
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;

  font-size:100%;

 
}

#customers td, #customers th {
  border: 1px solid #000000;
  padding: 1px;
}


#customers th {
  padding-top: 1px;
  padding-bottom: 1px;
  text-align: left;

}


.boton_personalizado{
    text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 20px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #000000;
  }




h1 {
  text-align: left;
}


p {
  text-align: justify;
}


</style>
 
</head>
<body>

<div id="ocultarBotonImpri" class="container ">
  <div class="row ">
    <div class="col-lg-12 p-4 ">
      <button class="boton_personalizado  print">Imprimir</button>
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
    size: legal;
    margin: 1cm;  /* this affects the margin in the printer settings */

    

}

header, footer, nav, aside {
  display: none;
}

#ocultarBotonImpri {
  display: none;
}


#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:100%;
  
}

#customers td, #customers th {
  border: 1px solid #000000;
  padding: 1px;
}

#customers th {
  padding-top: 1px;
  padding-bottom: 1px;
  text-align: left;

}





h1 {
  text-align: left;
}


p {
  text-align: justify;
}

</style>



<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();



if (isset($_SESSION['s_usuarioEstudiante'])){
$s_usuarioEstudiante=$_SESSION['s_usuarioEstudiante'];


  
        $c9onsulta = "SELECT datosalumnos.idAlumnos, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos, plan_datos.nombre AS 'nombrePlan', plan_datos.numero AS 'numeroPlan' FROM datosalumnos INNER JOIN plan_datos ON plan_datos.idPlan = datosalumnos.idPlanEstudio WHERE datosalumnos.dniAlumnos = '$s_usuarioEstudiante'";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $idAlumnos=$d9at['idAlumnos'];
            $nombreAlumnos=$d9at['nombreAlumnos'];
            $dniAlumnos=$d9at['dniAlumnos'];
            $nombrePlan=$d9at['nombrePlan'];
            $numeroPlan=$d9at['numeroPlan'];
         }



    $c9onsulta = "SELECT datosalumnos.dniAlumnos, datosalumnos.nombreAlumnos, plan_datos.nombre, plan_datos.numero FROM datosalumnos INNER JOIN plan_datos ON plan_datos.idPlan = datosalumnos.idPlanEstudio WHERE datosalumnos.idAlumnos = '$idAlumnos'";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $dniAlumnos=$d9at['dniAlumnos'];
            $nombreAlumnos=$d9at['nombreAlumnos'];
            $nombrePlan=$d9at['nombre'];

            $numero=$d9at['numero'];

           
         }


       $c9onsulta = "SELECT `idInstitucion`, `nombre`, `cue`, `domicilio` FROM `institucion_datos`";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $nombreInstitucion=$d9at['nombre'];
            $domicilioEscolar=$d9at['domicilio'];
            $cue=$d9at['cue'];
          
         }
            
         $Libro='';
            $Folio='';
            $egreso='';
            $lugar='';
            $fecha='';
            $obs='';

     $c9onsulta = "SELECT `id_datos_anali`, `idAlumno`, `Libro`, `Folio`, `egreso`, `lugar`, `fecha`, `obs` FROM `analitico_datos` WHERE `idAlumno`='$idAlumnos'";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $Libro=$d9at['Libro'];
            $Folio=$d9at['Folio'];
            $egreso=$d9at['egreso'];
            $lugar=$d9at['lugar'];
            $fecha=$d9at['fecha'];
            $obs=$d9at['obs'];
         }
     


 $decimales = explode('...',$numero);


$provi = $decimales[0];
$provi2 = $decimales[1];
$nacional = $decimales[2];
$modalidad = $decimales[3];
                            

?>



<h2 style="text-align: center;"><span style="text-align: center;"><img style="width:50px;"  src="../../../../elementos/escudoProvincia.png"></h2>
 
   
<table id="customers" style="width:100%;vertical-align:middle;  border: 3px solid #000000;">
        <thead style='font-size: 15px'>
                          
                            <tr>
                         
       
                                <th colspan="2" style="text-align: center; font-size: 22px; border: 3px solid #000000;"><b>PROVINCIA DEL CHACO<br><br>MINISTERIO DE EDUCACIÓN, CULTURA, CIENCIA Y TECNOLOGIA</b></th>
                                               
                             
                            </tr>
                            <tr>
                         
       
                                <th colspan="2" style="text-align: center; font-size: 22px; border: 3px solid #000000;"><b>FICHA INTEGRADOR DE CALIFICACIONES</b></th>
                                               
                             
                            </tr>
                            <tr>
                         
       
                                <th colspan="2" style="font-size: 20px;">Establecimiento: <b><?php echo $nombreInstitucion; ?></b></th>
                                               
                             
                            </tr>

                        </thead>
                        <tbody>
                         
                            <tr>
                                
                                <td>Apellido y Nombre:<b><?php echo $nombreAlumnos; ?></b></td>
                                <td>DNI:<b><?php echo $dniAlumnos; ?></b></td>
                     
                              
                                
           
                            </tr>
                            <tr>
                                
                                <td colspan="2" >Titulo:<b><?php echo $nombrePlan; ?></b></td>
                              
                     
                              
                                
           
                            </tr>
                            <tr>
                                
                                <td colspan="2" >Norma Jurisdiccional: <b><?php echo $provi; ?></b></td>
                              
                     
                              
                                
           
                            </tr>
                            <tr>
                                
                                <td colspan="2" ><br>Validez Nacional: <b><?php echo $nacional; ?></b></td>
                              
                     
                              
                                
           
                            </tr>
                                                           
                        </tbody>        
                       </table> 




<?php
$sumaNotas=0;
$cantidadNota=0;

$contenido='';

$cantidadCiclosHoja=0;

$consulta = "SELECT analitico.idAnalitico, plan_datos_asignaturas.nombre, plan_datos_asignaturas.ciclo, analitico.nota, analitico.notaEscr,  analitico.fechaMes, analitico.fechaAño,  analitico.condicion,  analitico.establecimiento FROM analitico INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = analitico.idAsig WHERE analitico.idAlumno = '$idAlumnos'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
                            foreach($data as $dat) {                                
                    
                                $cicloFinal=$dat['ciclo'];


                           if ($contenido!=$cicloFinal) {
                             
                          
                          $cantidadCiclosHoja++;

if ($cantidadCiclosHoja==5) {
     echo '<div style="page-break-before: always;">';
   }   

?>


 <table id="customers" style="width:100%;vertical-align:middle;  border: 3px solid #000000;">
        <thead style='font-size: 15px'>
                            <tr>
                         
      
                                <th colspan="7" style="text-align: center; border: 3px solid #000000; font-size: 14px"><?php 

                                $porbar7ciclo=0;
                                if ($cicloFinal=='1° AÑO (1° AÑO P.C.)') {
                                  echo 'PRIMER AÑO';
                                }else if ($cicloFinal=='2° AÑO (2° AÑO P.C.)') {
                                  echo 'SEGUNDO AÑO';
                                }else if ($cicloFinal=='3° AÑO (1° AÑO S.C.)') {
                                  echo 'TERCER AÑO';
                                }else if ($cicloFinal=='4° AÑO (2° AÑO S.C.)') {
                                  echo 'CUARTO AÑO';
                                }else if ($cicloFinal=='5° AÑO (3° AÑO S.C.)') {
                                  echo 'QUINTO AÑO';
                                }else if ($cicloFinal=='6° AÑO (4° AÑO S.C.)') {
                                  echo 'SEXTO AÑO';
                                }else if ($cicloFinal=='7° AÑO (5° AÑO S.C.)') {

                                  $porbar7ciclo=1;
                                  echo 'SÉPTIMO AÑO';
                                }else {

                                  $porbar7ciclo=1;
                                  echo $cicloFinal;
                                }
                                




                                 ?></th> 
                           
                            </tr>
                            <tr>
                         
      
                                
                                <th style="width: 65%; text-align: center; font-size: 10px">ESPACIO CURRICULAR</th>
                                <th style="width: 10%; text-align: center; text-align: center; font-size: 10px" colspan="2">CALIFICACIÓN</th>
                                <th style="width: 10%; text-align: center; text-align: center; font-size: 10px">CONDICIÓN</th> 
                                <th style="width: 5%; text-align: center; text-align: center; font-size: 10px">MES</th>
                                <th style="width: 5%; text-align: center; text-align: center; font-size: 10px">AÑO</th>
                              
                                                    
                             
                            </tr>
                        </thead>
                        <tbody style='font-size: 11px'>
                            <?php 
                            
                            $consulta = "SELECT analitico.idAnalitico, plan_datos_asignaturas.nombre, plan_datos_asignaturas.ciclo, analitico.nota, analitico.notaEscr,  analitico.fechaMes, analitico.fechaAño,  analitico.condicion,  analitico.establecimiento FROM analitico INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = analitico.idAsig WHERE analitico.idAlumno = '$idAlumnos' AND  plan_datos_asignaturas.ciclo = '$cicloFinal'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
                            foreach($data as $dat) {                                
                    
                                $idAnalitico=$dat['idAnalitico'];
                                 $nota=$dat['nota'];
                                $notaEscr=$dat['notaEscr'];

                                $ciclo=$dat['ciclo'];
                                $nombre=$dat['nombre'];

                                $fechaMes=$dat['fechaMes'];
                                 $fechaAño=$dat['fechaAño'];
                                $condicion=$dat['condicion'];

                               

                                if ($nota=='') {
                                  $nota='<b>---</b>';
                                }else{

                                  $sumaNotas=$sumaNotas+$nota;
                                  $cantidadNota++;

                                }


                                if ($notaEscr=='') {
                                  $notaEscr='<b>-------</b>';
                                }
                                if ($fechaMes=='') {
                                  $fechaMes='<b>-------</b>';
                                }
                                if ($fechaAño=='') {
                                  $fechaAño='<b>-------</b>';
                                }

                                if ($condicion=='') {
                                  $condicion='<b>ADEUDA</b>';
                                }
                            

                            ?>
                            <tr>
                                
                                <td><b><?php echo $nombre ?></b></td>
                                <td style="text-align: center;"><b><?php echo $nota; ?></b></td>
                                <td style="text-align: center;"><b><?php echo $notaEscr; ?></b></td>
                                <td style="text-align: center;"><b><?php echo $condicion; ?></b></td>
                                <td style="text-align: center;"><b><?php echo $fechaMes; ?></b></td>
                                <td style="text-align: center;"><b><?php echo $fechaAño; ?></b></td>
                                
                                
           
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table> 


                     
                     

<?php  

if ($cantidadCiclosHoja==5) {
     echo '</div>';
   }  


} 

$contenido=$cicloFinal;

} ?>




<?php 


  if ($porbar7ciclo==0) {

 ?>
<table id="customers" style="width:100%;vertical-align:middle;  border: 2px solid #000000;">
        <thead style='font-size: 10px'>
                            <tr>
                         
      
                                <th colspan="7" style="text-align: center; border: 2px solid #000000; font-size: 14px">SÉPTIMO AÑO</th> 
                           
                            </tr>
                            <tr>
                         
      
                                
                                <th style="width: 65%;">ESPACIO CURRICULAR</th>
                                <th style="width: 10%; text-align: center;" colspan="2">CALIFICACIÓN</th>
                                <th style="width: 10%; text-align: center;">CONDICIÓN</th> 
                                <th style="width: 5%; text-align: center;">MES</th>
                                <th style="width: 5%; text-align: center;">AÑO</th>
                              
                                                    
                             
                            </tr>
                        </thead>
                        <tbody style='font-size: 11px'>

                          <?php for ($i=0; $i < 5; $i++) { 
                            # code...
                           ?>
                            
                            <tr>
                                
                                <td><b>------------------------------------------------------</b></td>
                                <td style="text-align: center;"><b>------</b></td>
                                <td style="text-align: center;"><b>-----------</b></td>
                                <td style="text-align: center;"><b>-----------</b></td>
                                <td style="text-align: center;"><b>----------</b></td>
                                <td style="text-align: center;"><b>----------</b></td>
                                
                                
           
                            </tr>
                          

                           <?php 
                          } ?>
                                                         
                        </tbody>        
                       </table> 


  <?php 

}

 ?>







 
 


<table id="customers" style="width:100%;vertical-align:middle;  border: 2px solid #000000;">
        <thead style='font-size: 15px'>
                            <tr>
                         
      
                                <th style="width:30%" colspan="2" rowspan="2" style="text-align: center; border: 2px solid #000000; font-size: 10px"><span style="font-size: 10px; text-align: justify;">
  PROMEDIO GENERAL: <?php 


if ($sumaNotas!=0) {
  

  echo $sumaNotas/$cantidadNota; 

  $total = $sumaNotas/$cantidadNota;


$numTex='';

$decimales = explode('.',$total);


$cantidad=count($decimales);

if ($cantidad==2) {
  $entera = $decimales[0];
$decimal =  ' con '.$decimales[1];

}else{
  $entera = $decimales[0];
$decimal = '';

}



if ($entera==10) {
  $numTex='diez'.$decimal;
}else if ($entera==9) {
  $numTex='nueve'.$decimal;
}else if ($entera==8) {
  $numTex='ocho'.$decimal;
}else if ($entera==7) {
  $numTex='siete'.$decimal;
}else if ($entera==6) {
  $numTex='seis'.$decimal;
}else if ($entera==5) {
  $numTex='cinco'.$decimal;
}else if ($entera==4) {
  $numTex='cuatro'.$decimal;
}else if ($entera==3) {
  $numTex='tres'.$decimal;
}else if ($entera==2) {
  $numTex='dos'.$decimal;
}else if ($entera==1) {
  $numTex='uno'.$decimal;
}else if ($entera==0) {
  $numTex='zero'.$decimal;
}


echo '('.$numTex.')';

}

  ?> 

                                </th> 

                                <th style="border: 2px solid #000000; font-size: 10px" style="width:70%"><b>OBSERVACIONES: Ingresó con <?php echo $obs; ?></b></th> 
                                 
                           
                           
                            </tr>
                           <tr>
                            <th style="border: 2px solid #000000; font-size: 10px" style="width:70%"><b></b>.</th> 
                           </tr>





                           <tr>
                         
      
                                <th style="width:30%" colspan="2" rowspan="2" style="text-align: center; border: 2px solid #000000; font-size: 10px"><span style="font-size: 10px; text-align: justify;">
                                  FECHA DE EGRESO: <?php echo $egreso; ?></th> 

                                <th style="border: 2px solid #000000; font-size: 10px" style="width:70%"><b>.</b></th> 
                                 
                           
                           
                            </tr>
                           <tr>
                            <th style="border: 2px solid #000000; font-size: 10px" style="width:70%"><b></b>.</th> 
                           </tr>




                            <tr>
                         
      
                                <th style="width:15%" rowspan="2" style="text-align: center; border: 2px solid #000000; font-size: 10px"><span style="font-size: 10px; text-align: justify;">
                                  LIBRO N° <?php echo $Libro; ?></th> 

                                <th style="width:15%" rowspan="2" style="text-align: center; border: 2px solid #000000; font-size: 10px"><span style="font-size: 10px; text-align: justify;">
                                  FOLIO N° <?php echo $Folio; ?></th>

                                <th style="border: 2px solid #000000; font-size: 10px" style="width:70%"><b>.</b></th> 
                                 
                           
                           
                            </tr>
                           <tr>
                            <th style="border: 2px solid #000000; font-size: 10px" style="width:70%"><b></b>.</th> 
                           </tr>



                        </thead>
                          
                       </table> 


<table id="customers" style="width:100%;vertical-align:middle;  border: 2px solid #000000;">
        <thead style='font-size: 15px'>
                            <tr>
                         
      
                           <tr>
                            <th style="font-size: 15px; width:10%"><b>LUGAR: </b></th> 

                            <th style="font-size: 15px; width:70%" ><b><?php echo $lugar; ?></b></th> 

                            <th style="font-size: 15px; width:10%"><b>FECHA:</b></th>
                            <th style="font-size: 15px; width:10%"><b><?php echo $fecha; ?></b></th>  
                           </tr>




                           
                        </thead>
                          
                       </table> 


<br><br><br><br>
  <table  style="text-align: center;width:100%; font-size: 15px" >
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Sello de la Institución</th> 
                                        <th></th>                         
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                             

                               

                               </table>

 <br>




</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>










 <script type="text/javascript">
$(document).ready(function(){

  $(".print").click(function(e){
    e.preventDefault();
     window.print();
  });





});



</script>



</body>
</html>
<?php  } ?>



