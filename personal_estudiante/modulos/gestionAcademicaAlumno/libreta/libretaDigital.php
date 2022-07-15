
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



 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['s_usuarioEstudiante'])){
$s_usuarioEstudiante=$_SESSION['s_usuarioEstudiante'];

$cicloLectivo=$_SESSION['cicloLectivoFina'];
$tenerLibreta=0;


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

            $tenerLibreta=1;

         }



?>

<?php if ($tenerLibreta==0) { ?>


            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  ACTUALMENTE NO ESTA CARGADO SU LIBRETA DIGITAL
                </h3>
              </div>
              <div class="card-body">

                

                <img src="../elementos/alto.jpg" style='width: 50%'>
               
              </div>
              <!-- /.card -->
            </div>

<script type="text/javascript">

    $('#cargaCiclo').hide();

</script>

<?php }else{ ?>


     <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  LIBRETA DIGITAL
                </h3>
              </div>
              <div class="card-body">

                

                <div id="datosF">Modalidad: <?php echo $nombrePlan; ?> // N°<?php echo $numeroPlan; ?>; Curso: <?php echo $nombreCurso; ?></div>
                    
                    <div id="nombreAlumnosF">Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></div>
                    <div id="dniF">DNI del Alumno:<?php echo $dniAlumnos; ?></div>


                     <button  type="button" class="btn btn-success" onclick="libreta()" title="Imprimir Toda la Libreta"><i class='fas fa-print'></i> LIBRETA DIGITAL</button>

                     <button  type="button" class="btn btn-danger"onclick="informe()" title="INFORME"><i class='fas fa-print'></i> INFORME</button>

           
               
              </div>
              <!-- /.card -->
            </div>







 <script type="text/javascript">

    $('#cargaCiclo').hide();


    function libreta(){


        Swal.fire({
  title: 'Advertencia',
  text: "La información que se visualizara no tienen valides como constancia, para ello deberá concurrir al establecimiento para su certificación !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Confirmado!'
}).then((result) => {
  if (result.isConfirmed) {
  


   window.open('modulos/gestionAcademicaAlumno/libreta/LibretaDigitalExtra.php', '_blank'); 

  }
})




    }


    function informe(){



                Swal.fire({
  title: 'Advertencia',
  text: "La información que se visualizara no tienen valides como constancia, para ello deberá concurrir al establecimiento para su certificación !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Confirmado!'
}).then((result) => {
  if (result.isConfirmed) {
  


   window.open('modulos/gestionAcademicaAlumno/libreta/informe.php', '_blank'); 
 

  }
})


    

    }
    
  
  $.unblockUI();

</script>


<?php }  } ?> 

