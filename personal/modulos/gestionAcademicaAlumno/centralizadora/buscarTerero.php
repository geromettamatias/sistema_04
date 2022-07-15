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

                  $cat="";
              
              
                  $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `corresponde`='FICHA/LIBRETA'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $nombre=$da1t['nombre'];

                     $cat.="<option>".$nombre."</option>";

                    

                  }

?>


<input hidden="" id="cantidFFF" value="<?php echo $cantidFFF;  ?>">





  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Columna Para visualizar</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover433()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            
                       <select class="form-control" id="nombreColumna">
              <option>Seleccione una o todas las columnas</option>
              <option>Todas</option>
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


<div id="IMAGENCARGANDO">
    <img  src="../elementos/cargando.gif"  style="width: 150px;">
</div>

<div id="tablaFi"></div>




<script type="text/javascript">

 $('#IMAGENCARGANDO').hide();

  $("#nombreColumna").change(function(){
    columnaSEle= $('#nombreColumna').val();

    
    if (columnaSEle!='Seleccione una o todas las columnas') {
     
     $.ajax({
          type:"post",
          data:'columnaSEle=' + columnaSEle,
          url:'modulos/gestionAcademicaAlumno/centralizadora/elementos/seccionCursosColum.php',
          beforeSend: function() {

              $('#imagenProceso').show();
              $('#IMAGENCARGANDO').show();

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
                           
                              },
          success:function(r){

              
              if (columnaSEle=='Todas') {

                    $('#tablaFi').load('modulos/gestionAcademicaAlumno/centralizadora/tabla.php');
                    

                }else{
                    $('#tablaFi').load('modulos/gestionAcademicaAlumno/centralizadora/tablaColu.php');
                    
                }
             
             


          }
        });

      }else{

        $('#tablaFi').html('');
        $('#imagenProceso').hide();
        $('#imagenProceso').hide();
        $('#IMAGENCARGANDO').hide();
      }

   });






  function remover433 () {

 

  $('#cursoSe').val(0);

        $('#tablaFi').html('');
        $('#imagenProceso').hide();
        $('#imagenProceso').hide();
        $('#IMAGENCARGANDO').hide();


}




 $.unblockUI();
</script>