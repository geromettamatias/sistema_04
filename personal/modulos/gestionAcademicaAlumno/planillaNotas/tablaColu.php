


  
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
        $idasignatura=$_SESSION['idasignatura'];

         $situacionNota=$_SESSION['situacionNota'];



$datos = explode("||", $idasignatura);
$idasigFF= $datos[0]; // porción1
$asigFF= $datos[1]; // porción2






$c2onsulta = "SELECT  `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idIns=$d2at['idIns'];
                }



   $asignaturas = array();

      $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

      foreach($data as $dat) {
        $id_libretaF=$dat['id_libreta'];
        

        array_push($asignaturas, $dat['nombre']);



      

}


                  
?>









  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-danger">
              
              <div class="card-header">
                <h3 class="card-title">PLANILLA DE NOTAS <?php echo $columnaSEle; ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover5()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            



<table id="tablaCentralizadora" class="table table-bordered border-primary table-sm" style="width:100%">
        <thead>
            <tr style='text-align: center;'>
                
                <th rowspan="2">Apellido y Nombre</th>
                <th rowspan="2">DNI</th>
                <?php
                $cantidadAsignatura=0;

                $contadorFinal=0;
                foreach ($asignaturas as &$asig) {

                  $cantidadAsignatura++;
                if ($asigFF==$asig) {

                ?>
                <th colspan="<?php echo $cantidadCabezeras; ?>">
                    <?php 

                  
                        echo $asig;
                        $contadorFinal=$cantidadAsignatura;

            

                     ?></th>

                <?php

                 }
                 }
                  
                ?>

               
            </tr>
            <tr style='text-align: center;'>
        
              <th><?php echo $columnaSEle; ?></th>

        

                
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


            <tr style='text-align: center;' class="table-<?php echo $colorFinal; ?>" id='<?php echo $dniAlumnos; ?>'>
                
                <td><?php  echo $nombreAlumnos;?></td>
                <td><?php  echo $dniAlumnos?></td>

                 <?php
              

      
                $consulta = "SELECT `libreta_digital_2021`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_2021` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_2021`.`idAsig` WHERE `libreta_digital_2021`.`idIns`='$idIns' AND `plan_datos_asignaturas`.`idAsig`='$idasigFF'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $dat) {
                  $id_libretaF=$dat['id_libreta'];
                  $nombreAsi=$dat['nombre'];
               
                          $consulta = "SELECT `id_libreta`, `$columnaSEle` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                          $resultado = $conexion->prepare($consulta);
                          $resultado->execute();
                          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                          foreach($data as $dat) {

                        

                        


            ?>

                            <td><?php  




                            $nota= $dat[''.$columnaSEle.''];



                             echo $nota;
                          


                            ?></td>


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
    $('#IMAGENCARGANDOFINA').hide();
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

     responsive: "true",
            dom: 'Bfrtilp',       
            buttons:[ 
          {
            extend:    'excelHtml5',
            text:      '<i class="fas fa-file-excel"></i> ',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success'
          },
          {
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger'
          },
          {
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info',
            title: 'PLANILLA DE NOTAS',
              messageTop:'<?php


            $c2onsulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `idCurso`='$cursoSe'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $curso=$d2at['nombre'];
                }


             echo 'Curso '.$curso.'; Asignatura '.$asigFF.'; Ciclo Lectivo '.$cicloLectivo.'; Situación de calificación: '.$situacionNota ?>'
          },
        ] 
   

    

  
   
    });




tablaCentralizadora.rows().data().each(function (value) {
    var dniFF= value[1];
    var nota= value[2];
    
situacionNota="<?php echo $situacionNota; ?>";

if (situacionNota=='Aprovado (mayor a 6)') {

    if (nota<6) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }

}else if(situacionNota=='Desaprovado (menor a 6)'){


    if (nota>5) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 

     }



}else if(situacionNota=='Desaprovado (menor a 4)'){


    if (nota>4) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 

     }



}else if(situacionNota=='Desaprovado (menor a 3)'){


    if (nota>3) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 

     }



}else if(situacionNota=='Desaprovado (menor a 2)'){


    if (nota>2) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 

     }



}else if (situacionNota=='Aprovado (mayor a 7)') {

    if (nota<7) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }

}else if (situacionNota=='Aprovado (mayor a 8)') {

    if (nota<8) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }

}else if (situacionNota=='Aprovado (mayor a 9)') {

    if (nota<9) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }

}else if (situacionNota=='Alumnos que sacaron 2') {

    if (nota!=2) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }



}else if (situacionNota=='Alumnos que sacaron 3') {

    if (nota!=3) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }



}else if (situacionNota=='Alumnos que sacaron 4') {

    if (nota!=4) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }



}else if (situacionNota=='Alumnos que sacaron 5') {

    if (nota!=5) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }



}else if (situacionNota=='Alumnos que sacaron 6') {

    if (nota!=6) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }



}else if (situacionNota=='Alumnos que sacaron 7') {

    if (nota!=7) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }



}else if (situacionNota=='Alumnos que sacaron 8') {

    if (nota!=8) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }



}else if (situacionNota=='Alumnos que sacaron 9') {

    if (nota!=9) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }



}else if (situacionNota=='Alumnos que sacaron 10') {

    if (nota!=10) {

        tablaCentralizadora.row(`#`+dniFF+``).remove().draw();
 
     }



}




    
        });



});



 function remover5 () {

 

        $('#tablaFiFIFI').html('');
        $('#imagenProceso').hide();
        $('#imagenProceso').hide();
        $('#IMAGENCARGANDO').hide();
        
     
        $('#asignatura').val('Seleccione la asignatura');
        $('#situacionNota').val('Aprovado (mayor a 6)');

   


}



 $.unblockUI();

</script>



