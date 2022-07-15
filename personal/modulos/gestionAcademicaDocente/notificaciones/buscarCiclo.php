<?php
                  
                  include_once '../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();

                  $cat="";


                  $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `ciclo`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $ciclo=$da1t['ciclo'];
                    $edicion=$da1t['edicion'];

                     $cat.="<option value='".$ciclo."||".$edicion."'>".$ciclo."- Editar: ".$edicion."</option>";


                  }

?>

<br>




            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                    Marticulación al curso lectivo (del Alumno)
                </h3>
              </div>
              <div class="card-body">

                

                <select class="form-control" id="cicloLectivoFina">
                        <option>Seleccione un año lectivo</option>
                        <?php echo $cat;  ?>
                </select> 

               
              </div>
              <!-- /.card -->
            </div>




       
        <div id="contenidoCursos"></div>

<script type="text/javascript">

   $('#imagenProceso').hide();
  $("#cicloLectivoFina").change(function(){
    cicloLectivoFina= $('#cicloLectivoFina').val();
    $('#tablaInstitucional').html('');


    if (cicloLectivoFina!='Seleccione un año lectivo') {


       $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 
 

     $.ajax({
          type:"post",
          data:'cicloLectivo=' + cicloLectivoFina,
          url:'modulos/gestionAcademicaDocente/notificaciones/elementos/seccionciclo.php',
          success:function(r){
            $('#contenidoCursos').load('modulos/gestionAcademicaDocente/notificaciones/buscarCurso.php');
          }
        });

     }else{

        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
         $.unblockUI();



     }

   });


 $.unblockUI();
</script>
