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

 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  AÑO LECTIVO
                </h3>
              </div>
              <div class="card-body">
                
                <select class="form-control" id="cicloLectivo">
                    <option>Seleccione un año lectivo</option>
                    <?php echo $cat;  ?>
                </select>
                
               
              </div>
              <!-- /.card -->
            </div>


 </div> </div> </div> </section>





     





<script type="text/javascript">


$('#imagenProceso').hide();
$("#cicloLectivo").change(function(){

    cicloLectivo= $('#cicloLectivo').val();

    if (cicloLectivo!='Seleccione un año lectivo') {

        $.blockUI({ 
                                    message: '<h1>Espere !!</h1>',
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
          data:'cicloLectivo=' + cicloLectivo,
          url:'modulos/herramientas/cabesados/elementos/seccionCicloLectivo.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){

           
              $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('modulos/herramientas/cabesados/encabesados.php');
              $('#contenidoAyuda').html(''); 
            

              $('#imagenProceso').hide();
          }
        });

        }else{
          $('#tablaInstitucional').html(''); 
               
              $('#contenidoAyuda').html(''); 
            

              $('#imagenProceso').hide();

               $.unblockUI();

        }

      });


 $.unblockUI();
  </script>

