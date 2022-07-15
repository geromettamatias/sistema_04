

<style type="text/css">
  @media screen and (max-width: 600px) {
       table {
           width:100%;
       }
       thead {
           display: none;
       }
       tr:nth-of-type(2n) {
           background-color: inherit;
       }
       tr td:first-child {
           background: #f0f0f0;
           font-weight:bold;
           font-size:1.3em;
       }
       tbody td {
           display: block;
           text-align:center;
       }
       tbody td:before {
           content: attr(data-th);
           display: block;
           text-align:center;
       }
}
</style>


  
    <style>
      .table-striped>tbody>tr:nth-child(odd)>td, 
      .table-striped>tbody>tr:nth-child(odd)>th {
       background-color: #9BFEA7;
      }
      .table-striped>tbody>tr:nth-child(even)>td, 
      .table-striped>tbody>tr:nth-child(even)>th {
       background-color: #DADFF8;
      }
      .table-striped>thead>tr>th {
         background-color:  #D4FAD7;
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
    </style>


<?php
  
     include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    session_start();
     $cursoSe=$_SESSION['cursoSe'];
                        $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

       $columnaSEle=$_SESSION['columnaSEle'];
       





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



                $consulta = "SELECT `id_libreta`, `$columnaSEle` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) {

                  array_push($notas, $dat[''.$columnaSEle.'']);

                }

      

}


                  
?>





  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-info">
              
              <div class="card-header">
                <h3 class="card-title">Tabla de La Centralizadora - Por Columna <?php echo $columnaSEle; ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="removerCOlu()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            

                <button  type="button" class="btn btn-success modalCRUD_Centralizadora" data-toggle="modal" title="Nuevo Ciclo Lectivo"><i class="fas fa-print"></i></button><br> <hr>    



<table id="tablaCentralizadora" class="table table-bordered border-primary table-sm" style="width:100%">
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
             

       
           
            ?>
              <th><?php echo $columnaSEle; ?></th>

            <?php
                
              }
                  
            ?>


                
            </tr>
        </thead>


        <tbody>

          <?php
                $colorFinal='';
           $contadorColores=0;  

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




                     if ($contadorColores<=6) {
                                 $contadorColores++;

                                 if ($contadorColores==1) {
                                     $colorFinal='success';
                                 }else{
                                        if ($contadorColores==2) {
                                            $colorFinal='white';
                                         }else{
                                                 if ($contadorColores==3) {
                                                    $colorFinal='secondary';
                                                 }else{
                                                    if ($contadorColores==4) {
                                                        $colorFinal='danger';
                                                     }else{
                                                        if ($contadorColores==5) {
                                                            $colorFinal='warning';
                                                         }else{
                                                                if ($contadorColores==6) {
                                                                    $colorFinal='danger';
                                                                 }else{
                                                                    $colorFinal='info';
                                                                 }
                                                         }
                                                     }
                                                 }
                                         }
                                 }

                             }else{
                                $contadorColores=1;
                                $colorFinal='muted';
                             }
                
                

                  
            ?>


            <tr style='text-align: center;' class="table-<?php echo $colorFinal; ?>">
                
                <td><b><FONT COLOR="black"><?php  echo $nombreAlumnos;?></FONT></b></td>
                <td><b><FONT COLOR="black"><?php  echo $dniAlumnos;?></FONT></b></td>

                 <?php
              
      
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


            ?>

                            <td title="<?php  echo $nombreAlumnos.'; DNI:'.$dniAlumnos;?>"><b><?php  




                            $nota= $dat[''.$columnaSEle.''];



                            if ($nota<6) {
                             echo '<FONT COLOR="red">'.$nota.'</FONT>';
                            }else{
                             echo '<FONT COLOR="black">'.$nota.'</FONT>';
                            }


                            ?></b></td>


                       <?php
           

                          }

                 





          }
                  
            ?>  

            </tr>

             <?php
              }  
              
                  
            ?>
        </tbody>
      
    </table>
                




                </div>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


 






 <script type="text/javascript">
    $('#imagenProceso').hide();
    $('#IMAGENCARGANDO').hide();
$(document).ready(function(){

   

    var tablaCentralizadora = $('#tablaCentralizadora').DataTable({ 

    "destroy":true,
     scrollX:        "400px",   
     scrollY:        "200px",
     
        paging:         false,
         fixedColumns: false,
        // fixedColumns:   {
        //     leftColumns: 2//Le indico que deje fijas solo las 2 primeras columnas
        // },




   
     language: {
      lengthMenu: "Display _MENU_ records per page",
      zeroRecords: "Nothing found - sorry",
      info: "Showing page _PAGE_ of _PAGES_",
      infoEmpty: "No records available",
      search: "",
      searchPlaceholder: "Buscar",
      loadingRecords: "Cargando...",
      processing: "Procesando....",
      paginate: {
        first: "primero",
        last: "ultimo",
        next: "siguiente",
        previous: "anterior"
      },
      infoFiltered: "(filtered from _MAX_ total records)"
    },
   

  
   
    });



$(document).on("click", ".modalCRUD_Centralizadora", function(e){

e.preventDefault(); 
 
   window.open('modulos/gestionAcademicaAlumno/centralizadora/tablaColuImprimir.php', '_blank'); 

    

});



});




  function removerCOlu () {

 

  $('#nombreColumna').val('Seleccione una o todas las columnas');

        $('#tablaFi').html('');
        $('#imagenProceso').hide();
        $('#imagenProceso').hide();
        $('#IMAGENCARGANDO').hide();


}


 $.unblockUI();
</script>



