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
  border: 2px solid #031C44;
  padding: 1px;
   
}

.customers th {
  padding-top: 1px;
  padding-bottom: 1px;
 

}

.letras{
  color:#000000;
}

.NOTA_0{
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



          <table  class="customers2"  style="width:100%" >
                        <thead class="letras">

                            <tr style="height: 30px;">
                                <th style="width: 30%;"><span style='font-size: 15px;'  >

                                    <?php

                                        if ($cicloLectivo=='2020') {
                                          echo 'Promoción Acompañada';
                                        }else{

                                          echo 'Asignaturas Pendientes de Aprobación';
                                        }

                                       ?>



                                </span></th>
                                
                                <th><span style='font-size: 9px;'  >1°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >1°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >1°Libr</span></th>
                                <th><span style='font-size: 9px;'  >1°Folio</span></th>

                                <th><span style='font-size: 9px;'  >2°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >2°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >2°Libr</span></th>
                                <th><span style='font-size: 9px;'  >2°Folio</span></th>
                                <th><span style='font-size: 9px;'  >3°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >3°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >3°Libr</span></th>
                                <th><span style='font-size: 9px;'  >3°Folio</span></th>

                                <th><span style='font-size: 9px;'  >4°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >4°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >4°Libr</span></th>
                                <th><span style='font-size: 9px;'  >4°Folio</span></th>

                                <th><span style='font-size: 9px;'  >5°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >5°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >5°Libr</span></th>
                                <th><span style='font-size: 9px;'  >5°Folio</span></th>
                                

                            </tr>
                        </thead>
                        <tbody class="letras">

                        <?php 
                             $contadorS=0;
                            $consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_1`, `asignaturas_pendientes_$cicloLectivo`.`fecha_1`, `asignaturas_pendientes_$cicloLectivo`.`libro_1`, `asignaturas_pendientes_$cicloLectivo`.`folio_1`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_2`, `asignaturas_pendientes_$cicloLectivo`.`fecha_2`, `asignaturas_pendientes_$cicloLectivo`.`libro_2`, `asignaturas_pendientes_$cicloLectivo`.`folio_2`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_3`, `asignaturas_pendientes_$cicloLectivo`.`fecha_3`, `asignaturas_pendientes_$cicloLectivo`.`libro_3`, `asignaturas_pendientes_$cicloLectivo`.`folio_3`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_4`, `asignaturas_pendientes_$cicloLectivo`.`fecha_4`, `asignaturas_pendientes_$cicloLectivo`.`libro_4`, `asignaturas_pendientes_$cicloLectivo`.`folio_4`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_5`, `asignaturas_pendientes_$cicloLectivo`.`fecha_5`, `asignaturas_pendientes_$cicloLectivo`.`libro_5`, `asignaturas_pendientes_$cicloLectivo`.`folio_5`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivo`.`idAlumno`='$idAlumnos' ORDER BY `asignaturas_pendientes_$cicloLectivo`.`asignaturas`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
           foreach($data as $dat) {  

           $situacion= $dat['situacion'];

        
           if ($situacion=='Asignatura Pendiente') {
               
            $contadorS++;

                         ?>
                            <tr style='text-align: center; height: 30px;' class="<?php $dat['idAsigPendiente']; ?>">
 
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['nombre'].' '.$dat['ciclo']; ?></span>.</td>

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_1']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_1']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_1']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_1']; ?></span></td>

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_2']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_2']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_2']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_2']; ?></span></td>

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_3']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_3']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_3']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_3']; ?></span></td>

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_4']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_4']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_4']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_4']; ?></span></td>

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_5']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_5']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_5']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_5']; ?></span></td>
                             
                        
                             
                        
                            
                                  
                            </tr>

                       <?php } }


                            for ($i=$contadorS; $i < 10; $i++) { 
                            
                            ?>  


                                <tr style='height: 30px;' class="<?php $dat['idAsigPendiente']; ?>">
 
                                
                                <td><span style='font-size: 15px;'>.</span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>

                                 <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                             
                                 <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                             
                                 <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                             
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


                      <br>


          <table  class="customers2"  style="width:100%" >
                        <thead class="letras">
                              <tr style="height: 30px;">
                                <th style="width: 30%;"><span style='font-size: 15px;'  >  <?php

          if ($cicloLectivo=='2020') {
            echo 'Promoción Acompañada';
          }else{

            echo 'Asignaturas Pendientes de Aprobación';
          }

         ?>
</span></th>
                                
                                <th><span style='font-size: 9px;'  >1°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >1°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >1°Libr</span></th>
                                <th><span style='font-size: 9px;'  >1°Folio</span></th>

                                <th><span style='font-size: 9px;'  >2°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >2°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >2°Libr</span></th>
                                <th><span style='font-size: 9px;'  >2°Folio</span></th>
                                <th><span style='font-size: 9px;'  >3°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >3°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >3°Libr</span></th>
                                <th><span style='font-size: 9px;'  >3°Folio</span></th>

                                <th><span style='font-size: 9px;'  >4°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >4°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >4°Libr</span></th>
                                <th><span style='font-size: 9px;'  >4°Folio</span></th>

                                <th><span style='font-size: 9px;'  >5°Cla.Fin</span></th>
                                <th><span style='font-size: 9px;'  >5°Fecha</span></th>
                                <th><span style='font-size: 9px;'  >5°Libr</span></th>
                                <th><span style='font-size: 9px;'  >5°Folio</span></th>
                                

                            </tr>
                        </thead>
                        <tbody class="letras">

                        <?php 
                           $contadorP=0;
                                      $consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_1`, `asignaturas_pendientes_$cicloLectivo`.`fecha_1`, `asignaturas_pendientes_$cicloLectivo`.`libro_1`, `asignaturas_pendientes_$cicloLectivo`.`folio_1`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_2`, `asignaturas_pendientes_$cicloLectivo`.`fecha_2`, `asignaturas_pendientes_$cicloLectivo`.`libro_2`, `asignaturas_pendientes_$cicloLectivo`.`folio_2`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_3`, `asignaturas_pendientes_$cicloLectivo`.`fecha_3`, `asignaturas_pendientes_$cicloLectivo`.`libro_3`, `asignaturas_pendientes_$cicloLectivo`.`folio_3`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_4`, `asignaturas_pendientes_$cicloLectivo`.`fecha_4`, `asignaturas_pendientes_$cicloLectivo`.`libro_4`, `asignaturas_pendientes_$cicloLectivo`.`folio_4`,`asignaturas_pendientes_$cicloLectivo`.`calFinal_5`, `asignaturas_pendientes_$cicloLectivo`.`fecha_5`, `asignaturas_pendientes_$cicloLectivo`.`libro_5`, `asignaturas_pendientes_$cicloLectivo`.`folio_5`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivo`.`idAlumno`='$idAlumnos' ORDER BY `asignaturas_pendientes_$cicloLectivo`.`asignaturas`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
           foreach($data as $dat) {  

           $situacion= $dat['situacion'];
           

           if ($situacion=='Equivalencia') {
               
            $contadorP++;

                         ?>
                            <tr style='text-align: center; height: 30px;' class="<?php $dat['idAsigPendiente']; ?> ">
 
                                
                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['nombre'].' '.$dat['ciclo']; ?></span>.</td>
                                

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_1']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_1']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_1']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_1']; ?></span></td>

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_2']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_2']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_2']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_2']; ?></span></td>

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_3']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_3']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_3']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_3']; ?></span></td>

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_4']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_4']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_4']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_4']; ?></span></td>

                                <td><span style='font-size: 12px;text-align: center;'><?php echo $dat['calFinal_5']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['fecha_5']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['libro_5']; ?></span></td>
                                <td><span style='font-size: 10px;text-align: center;'><?php echo $dat['folio_5']; ?></span></td>
                             
                        
                             
                             
                        
                            
                                  
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

                                 <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                             
                                 <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                             
                                 <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                                <td><span style='font-size: 15px;'></span></td>
                             
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