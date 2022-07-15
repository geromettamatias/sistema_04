<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFORME</title>


<style>

table.table-bordered{
border:1px solid black;

}
table.table-bordered > thead > tr > th{
border:1px solid black;
}
table.table-bordered > tbody > tr > td{
border:1px solid black;
}



table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
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
    margin: 0cm;  /* this affects the margin in the printer settings */


}

header, footer, nav, aside {
  display: none;
}

#ocultarBotonImpri {
  display: none;
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

table.table-bordered{
border:1px solid black;

}
table.table-bordered > thead > tr > th{
border:1px solid black;
}
table.table-bordered > tbody > tr > td{
border:1px solid black;
}



table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}




</style>






<?php
    include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    


    session_start();

    $s_usuarioEstudiante=$_SESSION['s_usuarioEstudiante'];

    $idIns='';

    $cicloLectivo=$_SESSION['cicloLectivoFina'];




         $c3onsulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `curso_$cicloLectivo`.`ciclo`, `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `plan_datos`.`nombre` AS 'nombrePlan', `plan_datos`.`numero` AS 'numeroPlan' FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan` = `datosalumnos`.`idPlanEstudio` WHERE `datosalumnos`.`dniAlumnos` = '$s_usuarioEstudiante'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $nombreCurso=$d3at['nombreCurso'];
            $ciclo=$d3at['ciclo'];
            $idAlumno=$d3at['idAlumno'];
            $nombreAlumnos=$d3at['nombreAlumnos'];
            $dniAlumnos=$d3at['dniAlumnos'];
            $nombrePlan=$d3at['nombrePlan'];
            $numeroPlan=$d3at['numeroPlan'];
            $idIns=$d3at['idIns'];


         }




        if ($idIns!=1){


  
      $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo`";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);

      $contador=0;

      $columnas = array();

       $nom=0; 

 

      foreach($data1 as $dat1) {
          $contador++; 

          $descri=$dat1['descri'];

          if ($descri=='INFORME') {
                 array_push($columnas, $dat1['nombre']);

        } 
       $nom++;



        }


    $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                           
                            foreach($data as $dat) {

                            $id_libretaF=$dat['id_libreta'];
                            $nombre=$dat['nombre'];
                           
                           
                                    $notaFinal=0;
                                    $contadoresF=0;
                                    foreach ($columnas as &$Nombrecolum) {

                                         $consulta = "SELECT `id_libreta`, `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                         foreach($data as $dat) {

                                            $notaFinal=$dat[''.$Nombrecolum.''];

                                           
                                            $notaF = explode('|&|&|&|&|&|&|&||&|&|&|',$notaFinal);
                                         

                                            $barConjunto='';

                                            foreach ($notaF  as $not) {
                                                  
                                                  if ($not!='') {
                                                     


                                            ?>


                                            <div style="page-break-before: always;">
                                              <br>
                                            <?php  echo $not; ?>

                                            </div> 


                                            <?php

                                     
                                                  }


                                            }






                                        }



                                      }


                              
}}


                    
?>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script type="text/javascript">

        $(".print").click(function() {
  window.print();
});
</script>   
</body>
</html>
