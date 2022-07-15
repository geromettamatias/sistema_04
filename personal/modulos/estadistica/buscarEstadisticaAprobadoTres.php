<?php
                  
     include_once '../bd/conexion.php';
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



            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Columna Para visualizar (cada columna corresponde a la Ficha)
                </h3>
              </div>
              <div class="card-body">

            <select class="form-control" id="nombreColumna">
              <option>Seleccione una o todas las columnas</option>
              
              <?php echo $cat;  ?>
            
            </select>

              </div>
              <!-- /.card -->
            </div>



            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  El tipo de Grafico
                </h3>
              </div>
              <div class="card-body">


             <select class="form-control" id="tipoGrafico">
              <option>TIPO DE GRAFICO POR COLUMNA</option>
              <option>TIPO DE GRAFICO POR BARRA</option>
              <option>TIPO DE GRAFICO POR CIRCULO</option>
         
            
            </select>


              </div>
              <!-- /.card -->
            </div>

<div id="IMAGENCARGANDO">
    <img  src="../elementos/cargando.gif"  style="width: 150px;">
</div>

<div id="tablaFi"></div>




<script type="text/javascript">

 $('#IMAGENCARGANDO').hide();

  $("#nombreColumna").change(function(){
    columnaSEle= $('#nombreColumna').val();
    tipoGrafico= $('#tipoGrafico').val();

    
    if (columnaSEle!='Seleccione una o todas las columnas') {
     
     $.ajax({
          type:"post",
          data:'columnaSEle=' + columnaSEle+'&tipoGrafico=' + tipoGrafico,
          url:'modulos/estadistica/elementos/sessionTres.php',
          beforeSend: function() {

              $('#imagenProceso').show();
              $('#IMAGENCARGANDO').show();
                           
                              },
          success:function(r){

            
                    $('#tablaFi').load('modulos/estadistica/estadisticaAlumnosApro.php');
             

          }
        });

      }else{

        $('#tablaFi').html('');
        $('#imagenProceso').hide();
        $('#imagenProceso').hide();
        $('#IMAGENCARGANDO').hide();
      }

   });

  $("#tipoGrafico").change(function(){
    columnaSEle= $('#nombreColumna').val();
    tipoGrafico= $('#tipoGrafico').val();

    
    if (columnaSEle!='Seleccione una o todas las columnas') {
     
     $.ajax({
          type:"post",
          data:'columnaSEle=' + columnaSEle+'&tipoGrafico=' + tipoGrafico,
          url:'modulos/estadistica/elementos/sessionTres.php',
          beforeSend: function() {

              $('#imagenProceso').show();
              $('#IMAGENCARGANDO').show();
                           
                              },
          success:function(r){

            
                    $('#tablaFi').load('modulos/estadistica/estadisticaAlumnosApro.php');
             

          }
        });

      }else{

        $('#tablaFi').html('');
        $('#imagenProceso').hide();
        $('#imagenProceso').hide();
        $('#IMAGENCARGANDO').hide();
      }

   });

</script>