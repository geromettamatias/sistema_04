
<br>


 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">












  <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        ICONOS
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      



                <div class="row">
   


<?php


session_start();

include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

     
            $cantidadPreInscrp=0;
            $consulta = "SELECT count(`id_PreIncrip`) AS 'cantidad'  FROM `inscripcion`";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $dat) { 
            $cantidadPreInscrp=$dat['cantidad'];
            }
?>



          <div id="cargaAlumnoPreEstrella" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span  class="info-box-text">Pre-Alu</span>
                <span class="info-box-number"><?php echo $cantidadPreInscrp ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

<?php
     
            $cantidadPreInscrp=0;
            $consulta = "SELECT count(`idAlumnos`) AS 'cantidad'  FROM `datosalumnos`";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $dat) { 
            $cantidadAlumnos=$dat['cantidad'];
            }
?>



          <!-- /.col -->
          <div id="cargaAlumnoEstrella" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas  fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Alumnos</span>
                <span class="info-box-number"><?php echo $cantidadAlumnos ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


<!-- Fin segundo -->

  <?php    if (($_SESSION['cargo'] == 'SUPERVISOR') || ($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET') || ($_SESSION['cargo'] == 'REGENTE')){ 


    
     
            $cantidadPreInscrp=0;
            $consulta = "SELECT count(`idDocente`) AS 'cantidad'  FROM `datos_docentes`";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $dat) { 
            $cantidadDocente=$dat['cantidad'];
            }
?>



          <!-- /.col -->
          <div id="cargaDocenteEstrella"  class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Docentes</span>
                <span class="info-box-number"><?php echo $cantidadDocente ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>



  <?php    }  ?>




          <!-- /.col -->
                 <!-- /.col -->
          <div id="libretaDigitalEstrella"  class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-wrench"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Libretas/Fichas</span>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


     
          <!-- /.col -->
        </div>



       <div class="row">




  <?php    if (($_SESSION['cargo'] == 'SUPERVISOR') || ($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET') || ($_SESSION['cargo'] == 'REGENTE')){  ?>

  
          <div id="actasDi" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span  class="info-box-text">Actas Ex</span>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


  <?php    }  ?>




          <!-- /.col -->
          <div id="centralizadorafin" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas  fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Centralizadora</span>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>










<!-- Fin sexto -->

  <?php    if (($_SESSION['cargo'] == 'SUPERVISOR') || ($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET') || ($_SESSION['cargo'] == 'PERSONAL TITULO') || ($_SESSION['cargo'] == 'REGENTE')){  ?>
<!-- tercero -->




          <!-- /.col -->
          <div id="analiticosFinal"  class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Analítico</span>
             
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>






  <?php    }  ?>





          <!-- /.col -->
                 <!-- /.col -->
          <div id="notificacion_do"  class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-wrench"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Notificaciones</span>
            
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
     
          <!-- /.col -->
        </div>









      </div>
    </div>
  </div>

</div>
</div>
</div>
</div>
</section>












<script type="text/javascript">
    $(document).ready(function(){

      
      $('#imagenProceso').hide();




    $("#notificacion_do").click(function(){

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


        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
         $('#buscarTablaInstitucional').load('modulos/gestionAcademicaDocente/notificaciones/buscarCiclo.php');
      
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
     
        
        $("#collapseOne").collapse('hide');
  
    });



    $("#actasDi").click(function(){

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
    
        
        $('#imagenProceso').show();
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html(''); 
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actasBuscar.php');
        $('#contenidoAyuda').html(''); 
        
        $("#collapseOne").collapse('hide');
    
    });


    $("#analiticosFinal").click(function(){
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

        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/analitico/alumnosAnalitico1.php');  
      
        $("#collapseOne").collapse('hide');
    
    });

     $("#centralizadorafin").click(function(){ 

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



        $('#imagenProceso').show();
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/centralizadora/buscarPrimero.php');
        $('#contenidoAyuda').html(''); 
    
        $("#collapseOne").collapse('hide');
      }); 

   
      $("#cargaAlumnoPreEstrella").click(function(){

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




        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/preIncripcionAlumno/alumnos.php');
      
      
        $("#collapseOne").collapse('hide');
    });



       $("#cargaAlumnoEstrella").click(function(){


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




        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/datosAlumno/alumnos.php');
       
      
        $("#collapseOne").collapse('hide');
    });




      $("#cargaDocenteEstrella").click(function(){

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

        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/datosDocente/docente.php');
    
        $("#collapseOne").collapse('hide');
    });



   $("#libretaDigitalEstrella").click(function(){

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


        $('#imagenProceso').show();
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/libretaFicha/Inscrp_BuscarCursosLibretaDigitalPri.php');
         
      
        $('#contenidoAyuda').html(''); 
        
        $("#collapseOne").collapse('hide');

    });
       
});



 $.unblockUI();

</script>

