
<?php
                  
                  include_once '../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();

                  $cat="";


 
                  $consulta = "SELECT DISTINCT `tipo` FROM `correos`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $tipo=$da1t['tipo'];

                     $cat.="<option>".$tipo."</option>";


                  }

?>

<br>

            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Tipo Usuario
                </h3>
              </div>
              <div class="card-body">

                

                <select class="form-control" id="usuarios">
                      <option>Seleccione el usuario</option>
                      <option>Profesor</option>
  
                </select>

                <hr>

                <select class="form-control" id="tipo">
                        <option>Selecciona el tipo de Pedido</option>
                        <?php echo $cat;  ?>
                        
                        </select>


              <!-- /.card -->
            </div>



 </div>


<div id="segundoBuscador"></div>
  
<script type="text/javascript">

 
$('#imagenProceso').hide();



   $("#usuarios").change(function(){

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



    usuarios= $('#usuarios').val();
    tipo= $('#tipo').val();
   
 
    
    if ((usuarios!='Seleccione el usuario') && (tipo!='Selecciona el tipo de Pedido')) {
    $('#imagenProceso').show();



      $.ajax({
          type:"post",
          data:'&tipo=' + tipo,
          url:'modulos/gestionAcademicaDocente/generarPedidoAdmin/elementos/seccionProfesor.php',
          success:function(r){
               
               $('#contenidoAyuda').html(''); 
                      $('#imagenProceso').hide(); 
                      $('#segundoBuscador').load('modulos/gestionAcademicaDocente/generarPedidoAdmin/generarPedidoAdminProfesor.php');
                    

          }
        });



                    
              

      }else{

   
        $('#segundoBuscador').html(''); 
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  

         $.unblockUI();


     }

   });








     $("#tipo").change(function(){

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



    usuarios= $('#usuarios').val();
    tipo= $('#tipo').val();
   
 
    
    if ((usuarios!='Seleccione el usuario') && (tipo!='Selecciona el tipo de Pedido')) {
    $('#imagenProceso').show();



      $.ajax({
          type:"post",
          data:'tipo=' + tipo,
          url:'modulos/gestionAcademicaDocente/generarPedidoAdmin/elementos/seccionProfesor.php',
          success:function(r){
               
               $('#contenidoAyuda').html(''); 
                      $('#imagenProceso').hide(); 
                      $('#segundoBuscador').load('modulos/gestionAcademicaDocente/generarPedidoAdmin/generarPedidoAdminProfesor.php');
                    

          }
        });




      }else{

   
        $('#segundoBuscador').html(''); 
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  

         $.unblockUI();


     }

   });




 $.unblockUI();

</script>