<!DOCTYPE html>
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

  font-size:140%;

  background-image: url("../../../../elementos/logo_LIBR.png");
  background-size: 30%;
  background-repeat: no-repeat;

  background-position:center;
}

#customers td, #customers th {
  border: 2px solid #ddd;
  padding: 8px;
}


#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
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
    border: 2px solid #0016b0;
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
  font-size:140%;
  background-image: url("../../../../elementos/logo_LIBR.png");
  background-size: 30%;
  background-repeat: no-repeat;

  background-position:center;
}

#customers td, #customers th {
  border: 2px solid #ddd;
  padding: 8px;
}

#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
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


if (isset($_SESSION['idAlumnos'])){
$idAlumnos=$_SESSION['idAlumnos'];


$c3onsulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumnos'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $nombreAlumnos=$d3at['nombreAlumnos'];
            $dniAlumnos=$d3at['dniAlumnos'];
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
            
                             

?>



  <img src="../../../../elementos/cabesera.png"><br><br>
           
 <h2 style="text-align: center; font-size: 22px">LEY DE EDUCACION N° 6.691 <br> MINISTERIO DE EDUCACIÓN, CULTURA, CIENCIA Y TECNOLOGIA <br> DIRECCIÓN DE TITULO Y EQUIVALENCIAS</h2><br>
 
 <span style="font-size: 20px; text-align: justify;">Las autoridad del establecimiento educativo <?php echo $nombreInstitucion; ?> ubicado en <?php echo $domicilioEscolar; ?> certifica que <?php echo $nombreAlumnos; ?> Tipo de Documento D.N.I. N° <?php echo $dniAlumnos; ?>, aprobó los espacios curriculares que con sus respectivas calificaciones a continuación expresan: </span><br><br>


<?php
$sumaNotas=0;
$cantidadNota=0;

$contenido='';

$consulta = "SELECT analitico.idAnalitico, plan_datos_asignaturas.nombre, plan_datos_asignaturas.ciclo, analitico.nota, analitico.notaEscr,  analitico.fechaMes, analitico.fechaAño,  analitico.condicion,  analitico.establecimiento FROM analitico INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = analitico.idAsig WHERE analitico.idAlumno = '$idAlumnos'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
                            foreach($data as $dat) {                                
                    
                                $cicloFinal=$dat['ciclo'];


                           if ($contenido!=$cicloFinal) {
                             
                          
                             

?>


 <table id="customers" style="width:100%;vertical-align:middle; border: 4px solid #ddd;">
        <thead style='font-size: 15px'>
                            <tr>
                         
      
                                <th colspan="7" style="text-align: center;"><?php echo $cicloFinal; ?></th> 
                           
                            </tr>
                            <tr>
                         
      
                                
                                <th style="width: 65%;">ESPACIO CURRICULAR</th>
                                <th style="width: 10%; text-align: center;" colspan="2">CALIFICACIÓN</th>
                                <th style="width: 10%; text-align: center;">CONDICIÓN</th> 
                                <th style="width: 5%; text-align: center;">MES</th>
                                <th style="width: 5%; text-align: center;">AÑO</th>
                                <th style="width: 10%; text-align: center;">ESTABLECIMIENTO</th> 
                                 
                                                    
                             
                            </tr>
                        </thead>
                        <tbody style='font-size: 12px'>
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

                                $establecimiento=$dat['establecimiento'];

                                if ($establecimiento=='') {
                                  $establecimiento='<b>--------</b>';
                                }

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
                                <td style="text-align: center;"><b><?php echo $establecimiento; ?></b></td>
                                
           
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table> 
                     

<?php  } 

$contenido=$cicloFinal;

} ?>



 <span style="font-size: 15px; text-align: justify;">
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


  ?> <br><br>




<?php 


$decimales = explode('...',$numero);


$provi = $decimales[0];
$provi2 = $decimales[1];
$nacional = $decimales[2];
$modalidad = $decimales[3];





 $Libro='___';
            $Folio='___';
            $egreso='';
            $lugar='________________________';
            $fecha='___/___/____';
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
     





 ?>

  El/la alumno/a <?php echo $nombreAlumnos; ?> con tipo de documento D.N.I. N° <?php echo $dniAlumnos; ?>, aprobó las asignaturas expresadas anteriormente de los estudios conducentes al TÍTULO de <?php echo $nombrePlan; ?> que se corresponde con <?php echo $modalidad; ?>.<br> <br>



  NORMA JURISD. DE APROB. PLAN DE ESTUDIOS: <?php echo $provi; ?> <br><br>
  NORMA JURISD. DE RATIFICACIÓN DEL DICTAMEN: <?php echo $provi2; ?> <br> 
  VALIDEZ NACIONAL otorgada por: <?php echo $nacional; ?> <br><br>

  Libro Matriz N°<?php echo $Libro; ?>; Folio N°<?php echo $Folio; ?>  <br>
  Otorgado en la ciudad de <?php echo $lugar; ?>, República Argentina, el dia <?php echo $fecha; ?>
<br><br>
OBSERVACIONES: Ingresó con  <?php echo $obs; ?> 

</span><br><br><br><br>



  <table  style="text-align: center;width:100%; font-size: 25px" >
                                <thead>
                                    <tr>
                                        <th>...............................</th>
                                        <th>...............................</th> 
                                        <th>...............................</th>                         
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                                 
                                    <tr>       
                                        <td>Secretaria</td>
                                        <td>Sello de la Institución</td>
                                        <td>Director/ra</td>
                                    </tr>
                                 
                               


                                </tbody>

                               

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



