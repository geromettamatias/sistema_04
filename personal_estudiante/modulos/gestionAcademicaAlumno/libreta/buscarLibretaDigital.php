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

                
                     $cat.="<option value='".$ciclo."'>".$ciclo."</option>";


                  }


?>


<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                      AÑO LECTIVO
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






 <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>


    <div id="buscarAsignaturas"></div>



    <script type="text/javascript">
      $('#imagenProceso').hide();
      $('#cargaCiclo').hide();
    $("#cicloLectivoFina").change(function(){


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








      cicloLectivoFina= $('#cicloLectivoFina').val();

      if (cicloLectivoFina=='Seleccione un año lectivo') {
        
                $('#contenidoAyuda').html(''); 
              
                $('#tablaInstitucional').html('');

                  $.unblockUI();
           

      }else{
      
      
       $.ajax({
          type:"post",
          data:'cicloLectivoFina=' + cicloLectivoFina,
          url:'modulos/gestionAcademicaAlumno/libreta/elementos/seccionCiclo.php',
          success:function(r){
          
           
                $('#contenidoAyuda').html(''); 
                 $('#cargaCiclo').show();
              
                $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/libreta/libretaDigital.php');
           
          }
        });

      }

      });

 

   $.unblockUI();
  </script>

