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


$c2onsulta = "SELECT  `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idIns=$d2at['idIns'];
                }

$cat='';

      $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`idAsig` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

      foreach($data as $dat) {
        $id_libretaF=$dat['id_libreta'];

         $idAsig=$dat['idAsig'];
        

         $cat.="<option>".$dat['idAsig'].'||'.$dat['nombre']."</option>";

    
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
                <h3 class="card-title">ASIGNATURA / SITUACIÓN</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover4()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            

                <select class="form-control" id="asignatura">
                <option>Seleccione la asignatura</option>
                  <?php echo $cat;  ?>
                </select>
                <hr>

                 <select class="form-control" id="situacionNota">
                <option>Aprovado (mayor a 6)</option>
                <option>Desaprovado (menor a 6)</option>
                <option>Todas las Notas</option>
                <option disabled="disabled">--------------</option>  
                <option>Desaprovado (menor a 5)</option>
                <option>Desaprovado (menor a 4)</option>
                <option>Desaprovado (menor a 3)</option>
                <option>Desaprovado (menor a 2)</option>
                <option>Aprovado (mayor a 7)</option>
                <option>Aprovado (mayor a 8)</option>
                <option>Aprovado (mayor a 9)</option>
                <option>Alumnos que sacaron 2</option>
                <option>Alumnos que sacaron 3</option>
                <option>Alumnos que sacaron 4</option>
                <option>Alumnos que sacaron 5</option>
                <option>Alumnos que sacaron 6</option>
                <option>Alumnos que sacaron 7</option>
                <option>Alumnos que sacaron 8</option>
                <option>Alumnos que sacaron 9</option>
                <option>Alumnos que sacaron 10</option>                   
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








<div id="IMAGENCARGANDOFINA">
    <img  src="../elementos/cargando.gif"  style="width: 150px;">
</div>

<div id="tablaFiFIFI"></div>


  
<script type="text/javascript">

  $('#imagenProceso').hide();
    $('#IMAGENCARGANDO').hide();
 $('#IMAGENCARGANDOFINA').hide();
  


  $("#asignatura").change(function(){
    asignatura= $('#asignatura').val();
    situacionNota= $('#situacionNota').val();
  
    
    if (asignatura!='Seleccione la asignatura') {
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
          data:'asignatura=' + asignatura+'&situacionNota=' + situacionNota,
          url:'modulos/gestionAcademicaAlumno/planillaNotas/elementos/seccionCursosPPPFFFFF.php',
          success:function(r){
            console.log(r);
            $('#IMAGENCARGANDOFINA').show();   
            
             
                    $('#tablaFiFIFI').load('modulos/gestionAcademicaAlumno/planillaNotas/tablaColu.php');
                    
            
             
    


          }
        });

     }else{

   
        $('#tablaFiFIFI').html('');
      

     }

   });




  $("#situacionNota").change(function(){
    asignatura= $('#asignatura').val();
    situacionNota= $('#situacionNota').val();
  
    
    if (asignatura!='Seleccione la asignatura') {
$('#imagenProceso').show();
        
     
     $.ajax({
          type:"post",
          data:'asignatura=' + asignatura+'&situacionNota=' + situacionNota,
          url:'modulos/gestionAcademicaAlumno/planillaNotas/elementos/seccionCursosPPPFFFFF.php',
          success:function(r){
            console.log(r);
            $('#IMAGENCARGANDOFINA').show();   
            
             
                    $('#tablaFiFIFI').load('modulos/gestionAcademicaAlumno/planillaNotas/tablaColu.php');
                    
            
             
    


          }
        });

     }else{

   
        $('#tablaFiFIFI').html('');
      

     }

   });




     function remover4 () {

 

        $('#tablaFiFIFI').html('');
        $('#imagenProceso').hide();
        $('#imagenProceso').hide();
        $('#IMAGENCARGANDO').hide();
        
     
        $('#cursoSe').val(0);

        



}



 $.unblockUI();
</script>