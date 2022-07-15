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







  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Buscar Ciclo Lectivo</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover1()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            
                    <select class="form-control" id="cicloLectivoFina">
                <option>Seleccione un año lectivo</option>
                  <?php echo $cat;  ?>
                </select>




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

  $("#cicloLectivoFina").change(function(){
    cicloLectivoFina= $('#cicloLectivoFina').val();
  
    
    if (cicloLectivoFina!='Seleccione un año lectivo') {
$('#imagenProceso').show();
        

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
          data:'cicloLectivo=' + cicloLectivoFina,
          url:'modulos/gestionAcademicaAlumno/planillaNotas/elementos/seccionCursosPPP.php',
          success:function(r){

               $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide(); 
            $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/planillaNotas/buscarSegundo.php');

             
    


          }
        });

     }else{

   
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  


         $.unblockUI();


     }

   });


    function remover1 () {

 

            $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
       
        $('#buscarTablaInstitucional').html('');
        



}




 $.unblockUI();

</script>