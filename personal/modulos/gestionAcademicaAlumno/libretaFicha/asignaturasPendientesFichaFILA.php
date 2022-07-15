<?php
    include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();
    if (isset($_SESSION['idAlumnos'])){
        $idAlumnos=$_SESSION['idAlumnos'];

        $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

          $cursoSe=$_SESSION['cursoSe'];
     
          $idAsigPendiente=$_SESSION['idAsigPendiente'];



                $c2onsulta = "SELECT `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `datosalumnos`.`idAlumnos`='$idAlumnos'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $nombreAlumnos=$d2at['nombreAlumnos'];
                    $dniAlumnos=$d2at['dniAlumnos'];
                    $nombreCurso=$d2at['nombre'];
                 } 


         

?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FICHA</title>

<style type="text/css">



.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:120%;

  background-image: url("../../../../elementos/logo_LIBR.png");
  background-size: 40%;
  background-repeat: no-repeat;

  background-position:center;
}

.customers td, .customers th {
  border: 2px solid #031C44;
  padding: 1px;
}

.customers th {
  padding-top: 1px;
  padding-bottom: 1px;
 

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




.customers2 {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:130%;

  background-image: url("../../../../elementos/logo_LIBR.png");
  background-size: 15%;
  background-repeat: no-repeat;

  background-position:center;
  
}

.customers2 td, .customers2 th {
  border: 2px solid #031C44;
  padding: 0px;
   
}

.customers2 th {
  padding-top: 1px;
  padding-bottom: 1px;
 

}

.border {
  border: red 5px dashed;
}

.Cuar{
  border: 2px solid #031C44;
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
  font-size:130%;
  
}

.customers td, .customers th {
  border: 2px solid #FFFFFF;
  padding: 1px;
   
}

.customers th {
  padding-top: 1px;
  padding-bottom: 1px;
 

}

.letras{
  color:#FFFFFF;
}

#NIT<?php echo $idAsigPendiente;?>{
  color:#000000;
}


h1 {
  text-align: left;
}


p {
  text-align: justify;
}







.customers2 {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 90%;
  font-size:130%;

 background-image: none;
  background-size: 15%;
  background-repeat: no-repeat;


  
}

.customers2 td, .customers2 th {
  border: 2px solid #FFFFFF;
  padding: 0px;
   
}

.customers2 th {
  padding-top: 1px;
  padding-bottom: 1px;
 

}

.border {
  border: red 5px dashed;
}

.Cuar{
  border: 2px solid #FFFFFF;
}

</style>






          <table  class="customers2"  style="width:100%" >
                        <thead class="letras">

                            <tr style="height: 30px;">
                                <th style="width: 60%;"><span style='font-size: 15px;'  >  <?php

          if ($cicloLectivo=='2020') {
            echo 'Promoción Acompañada';
          }else{

            echo 'Asignaturas Pendientes de Aprobación';
          }

         ?>
</span></th>
                                <th style="width: 10%;"><span style='font-size: 15px;'  >Cla.Fin</span></th>
                                <th style="width: 10%;"><span style='font-size: 15px;'  >Fecha</span></th>
                                <th style="width: 10%;"><span style='font-size: 15px;'  >Libr</span></th>
                                <th style="width: 10%;"><span style='font-size: 15px;'  >Folio</span></th>
                                

                            </tr>
                        </thead>
                        <tbody class="letras">

                        <?php 

                            $consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`,`asignaturas_pendientes_$cicloLectivo`.`calFinal`, `asignaturas_pendientes_$cicloLectivo`.`fecha`, `asignaturas_pendientes_$cicloLectivo`.`libro`, `asignaturas_pendientes_$cicloLectivo`.`folio`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivo`.`idAlumno`='$idAlumnos' ORDER BY `asignaturas_pendientes_$cicloLectivo`.`asignaturas`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
           foreach($data as $dat) {  

           $situacion= $dat['situacion'];

           $contadorS=0;
           if ($situacion=='Asignatura Pendiente') {
               
            $contadorS++;

                         ?>
                            <tr style='text-align: center; height: 30px;' id="NIT<?php echo $dat['idAsigPendiente']; ?>">
 
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['nombre'].' '.$dat['ciclo']; ?></span>.</td>
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal']; ?></span></td>
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['fecha']; ?></span></td>
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['libro']; ?></span></td>
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['folio']; ?></span></td>
                             
                        
                            
                                  
                            </tr>

                       <?php } }


                            for ($i=$contadorS; $i < 10; $i++) { 
                            
                            ?>  


                                <tr style='height: 30px;' class="<?php $dat['idAsigPendiente']; ?>">
 
                                <td><span style='font-size: 15px;'>.</span>.</td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                             
                        
                            
                                  
                            </tr>


                           <?php 
                            }





                     ?>

                        </tbody>        
                       </table> <br>

                          


          <table  class="customers2"  style="width:100%" >
                        <thead class="letras">
                         <tr style="height: 30px;">
                                <th style="width: 60%;"><span style='font-size: 15px;'  >Equivalencia</span></th>
                                <th style="width: 10%;"><span style='font-size: 15px;'  >Cla.Fin</span></th>
                                <th style="width: 10%;"><span style='font-size: 15px;'  >Fecha</span></th>
                                <th style="width: 10%;"><span style='font-size: 15px;'  >Libr</span></th>
                                <th style="width: 10%;"><span style='font-size: 15px;'  >Folio</span></th>
                               

                            </tr>
                        </thead>
                        <tbody class="letras">

                        <?php 

                            $consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`,`asignaturas_pendientes_$cicloLectivo`.`calFinal`, `asignaturas_pendientes_$cicloLectivo`.`fecha`, `asignaturas_pendientes_$cicloLectivo`.`libro`, `asignaturas_pendientes_$cicloLectivo`.`folio`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivo`.`idAlumno`='$idAlumnos' ORDER BY `asignaturas_pendientes_$cicloLectivo`.`asignaturas`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
           foreach($data as $dat) {  

           $situacion= $dat['situacion'];
            $contadorP=0;

           if ($situacion=='Equivalencia') {
               
            $contadorP++;

                         ?>
                            <tr id="NIT<?php echo $dat['idAsigPendiente']; ?>" style='text-align: center; height: 30px;' >
 
                                
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['nombre'].' '.$dat['ciclo']; ?></span>.</td>
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal']; ?></span></td>
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['fecha']; ?></span></td>
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['libro']; ?></span></td>
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['folio']; ?></span></td>
                             
                        
                            
                                  
                                 </tr>

                       <?php } }


                            for ($i=$contadorP; $i < 8; $i++) { 
                            
                            ?>  


                                <tr style=' center; height: 30px;' class="<?php $dat['idAsigPendiente']; ?>">
 
                                <td><span style='font-size: 15px;'>.</span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                             
                        
                            
                                  
                            </tr>


                           <?php 
                            }



?>

                        </tbody>        
                       </table> 

                          
                     
</div>           




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script type="text/javascript">

        $(".print").click(function() {
  window.print();
});
</script>   
</body>
</html>
<?php } ?>