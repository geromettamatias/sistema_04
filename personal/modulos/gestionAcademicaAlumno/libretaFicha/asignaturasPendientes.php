
    <style>
   
            table.table-bordered{
    border:1px solid black;
 
        }
      table.table-bordered > thead > tr > th{
          border:1px solid black;
      }
      table.table-bordered > tbody > tr > td{
          border:1px solid black;
      }
    </style>
<?php
    include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();
    if (isset($_SESSION['idAlumnos'])){
        $idAlumnos=$_SESSION['idAlumnos'];

        
        $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$operacion=$_SESSION["operacion"];


          $cursoSe=$_SESSION['cursoSe'];
     


                $c2onsulta = "SELECT `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `datosalumnos`.`idAlumnos`='$idAlumnos'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $nombreAlumnos=$d2at['nombreAlumnos'];
                    $dniAlumnos=$d2at['dniAlumnos'];
                    $nombreCurso=$d2at['nombre'];
                 } 


        $consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivo`.`idAlumno`='$idAlumnos'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

           

?>

<input hidden="" id="idAlumnosFIna" value="<?php echo $idAlumnos; ?>">


<input hidden="" id="cicloFinalLet" value="<?php echo $cicloLectivo; ?>">









  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-info">
              
              <div class="card-header">
                <h3 class="card-title">LISTA DE ASIGNATURAS QUE ADEUDA EL ALUMNO</h3>

                <div class="card-tools">
                    
                    <button type="button" class="btn btn-tool" id="RegresarLibreta">
                     <i class='fas fa-reply-all'></i>
                  </button>


                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover660()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            
                      <div id="datosF">Curso: <?php echo $nombreCurso.' '.$cicloLectivo; ?></div>

                    <div id="nombreAlumnosF">Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></div>

                    <div id="dniF">DNI del Alumno:<?php echo $dniAlumnos; ?></div>
                            </div>






   <button onclick="inprimirFicha()" type="button" class="btn btn-outline-success btn-block">Ficha Digital <span class="badge badge-success"> Imprimir la segunda carilla <i class='fas fa-edit'></i></span></button>

                <br>
                <hr>
   <?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>


<?php    if ((($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'AUXILIAR') || ($_SESSION['cargo'] == 'REGENTE')) && ($_SESSION['operacion'] == 'Lectura y Escritura')){  ?>
            
                <button id="btnNuevo_asignatura" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo Ciclo Lectivo"><i class='fas fa-edit'></i></button><br> <hr>    


<?php    }} ?>

                  <table id="tablaAsignacion" class="table table-bordered border-primar">

                        <thead class="text-center">
                            <tr>
                                        
                                <th>N°</th>
                                <th>N°AS</th>
                                <th>SITUACIÓN</th> 
                                <th>ASIGNATURA</th>
                                <?php if ($edicion=='SI') { ?>
                                <th>MESA</th>
                                <?php } ?>
                                
                                <th>BOTONES</th>
                                
                                
                             
                           
                            </tr>
                        </thead>
                        <tbody>
                          <?php                            
                            foreach($data as $dat) {                                                        
                            ?>

                            <tr>
                              <td><?php echo $dat['idAsigPendiente'] ?></td>
                              <td><?php echo $dat['asignaturas'] ?></td>
                              <td><?php echo $dat['situacion'] ?></td>
                              <td><?php echo $dat['nombre'].' '.$dat['ciclo']; ?></td>


                              <?php if ($edicion=='SI') { ?>

                              <td><div class="btn-group" role="group">
                                    <button id="btnGroupDrop1<?php echo $dat['idAsigPendiente'] ?>" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1<?php echo $dat['idAsigPendiente'] ?>">
                                      
                                      <?php    if ((($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'AUXILIAR') || ($_SESSION['cargo'] == 'REGENTE')) && ($_SESSION['operacion'] == 'Lectura y Escritura')){  ?>

                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa1" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 1</a></li>
                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa2" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 2</a></li>
                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa3" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 3</a></li>
                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa4" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 4</a></li>
                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa5" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 5</a></li>

                                   <?php    } ?>
                                    </ul>
                                  </div>
                                    
                                  </td>
                                  <?php }?>




                                 <td></td>
                            </tr>

                             <?php
                                }
                            ?>
                                                       
                        </tbody>        
                       </table>       
        




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











   <?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>



<div class="modal fade" id="modalCRUD_asignacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
            <div id="cont" class="modal-body">
                <div class="form-group">
                 <select class="form-select" id="situacion">
              <option>Asignatura Pendiente</option>
              <option>Equivalencia</option>
            
            </select>
                         
              </div>

 
                <div class="form-group">
              <label for="asignatura" class="col-form-label ediCur">ASIGNATURA Y CICLO:</label><br>
                        <select class="form-select" id="asignatura" >
                            <option value="0">Seleccione un curso</option>
                             <?php

                             include_once '../bd/conexion.php';
                                $objeto = new Conexion();
                                $conexion = $objeto->Conectar();
                                session_start();



                             $c1onsulta = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan` FROM `plan_datos_asignaturas` ORDER BY `ciclo`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {

                                         $idAsig = $d1at['idAsig'];
                                         $nombre = $d1at['nombre'];
                                         $ciclo = $d1at['ciclo'];
                                         $idPlan = $d1at['idPlan'];

                               
                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }



                                ?>
                                <option value="<?php echo $idAsig; ?>"><?php echo $ciclo.'--'.$nombre.'--'.$idPlan; ?></option>
                                <?php } ?>
                        </select>
                
               </div>


            
           
                                    
            </div> 
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button  onclick="formAsignaturaPendienteEquivalencia()" class="btn btn-dark"> <i class='fas fa-save'></i> Guardar</button>
            </div>
    
    </div>
  </div>
</div>

      
                                        
 
        <?php } ?> 
 


 <script type="text/javascript">

 
$(document).ready(function(){

 var tablaAsignacion = $('#tablaAsignacion').DataTable({ 

         destroy:true,

           columnDefs:[{
        targets: -1,
        data:null,
        defaultContent: `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      
                                      <li><a title='IMPRIMIR FILA COMPLETA' class="dropdown-item btnEditar_libreComp" href="javascript:void(0)">IMPRIMIR FILA COMPLETA <i class='fas fa-cog fa-spin'></i></a></li>

                                      <li><a title='IMPRIMIR SOLO NOTAS' class="dropdown-item btnEditar_libreNotas" href="javascript:void(0)">IMPRIMIR FILA NOTA <i class='fas fa-cog fa-spin'></i></a></li>


   <?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>


<?php    if ((($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'AUXILIAR') || ($_SESSION['cargo'] == 'REGENTE')) && ($_SESSION['operacion'] == 'Lectura y Escritura')){  ?>


                                      <li><a title='Editar' class="dropdown-item btnEditar_asignaturaPe" href="javascript:void(0)">Editar</a></li>

                                      <li><a title='Editar' class="dropdown-item btnBorrar_asignaturaPe" href="javascript:void(0)">Borrar</a></li>


<?php    }}  ?>
                                    </ul>
                                  </div>
                                </div>`,

         
       }],


   
     language: {
      lengthMenu: "Display _MENU_ records per page",
      zeroRecords: "Nothing found - sorry",
      info: "Showing page _PAGE_ of _PAGES_",
      infoEmpty: "No records available",
      search: "",
      searchPlaceholder: "Buscar",
      loadingRecords: "Cargando...",
      processing: "Procesando....",
      paginate: {
        first: "primero",
        last: "ultimo",
        next: "siguiente",
        previous: "anterior"
      },
      infoFiltered: "(filtered from _MAX_ total records)"
    },
   

        
         
    });

<?php if ($edicion=='SI') { ?>

$(document).on("click", ".mesa1", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 1;//borrar

    boton12(idAsigPendiente,solisitud);
  
});

$(document).on("click", ".mesa2", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 2;//borrar

    boton12(idAsigPendiente,solisitud);
  
});

$(document).on("click", ".mesa3", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 3;//borrar

    boton12(idAsigPendiente,solisitud);
  
});

$(document).on("click", ".mesa4", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 4;//borrar

    boton12(idAsigPendiente,solisitud);
  
});

$(document).on("click", ".mesa5", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 5;//borrar

    boton12(idAsigPendiente,solisitud);
  
});


function boton12(idAsigPendiente,solisitud) {


   $.ajax({
            url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/califAsigPendi.php",
            type: "POST",
            data: {idAsigPendiente:idAsigPendiente, solisitud:solisitud},
             success: function(res){  
            console.log(res);
           
                data = res.split('||');

                   
                  calFinal = data[0];
                  fecha = data[1];
                  libro = data[2];
                  folio = data[3];
                  bloque = data[4];

                  if (bloque=='SI') {

                    ret=`<div class="col-12"><div class="form-group"><label for="bloqueFIL" class="col-form-label">BLOQUEO AL AUXILIAR:</label>
                <select class="form-control" id="bloqueFIL">
                <option>SI</option>
                <option>NO</option>
                </select></div><div class="form-group">
                <label for="calfinal" class="col-form-label">CAL.FINAL</label>
                <input type="number" class="form-control" id="calfinal" value='`+calFinal+`'>
                </div> 


                <div class="form-group">
                <label for="fecha" class="col-form-label">FECHA</label>
                <input type="date" class="form-control" id="fecha" value='`+fecha+`'>
                </div> 
                <div class="form-group">
                <label for="libro" class="col-form-label">LIBRO</label>
                <input type="data" class="form-control" id="libro" value='`+libro+`'>
                </div> 
                <div class="form-group">
                <label for="folio" class="col-form-label">FOLIO</label>
                <input type="data" class="form-control" id="folio" value='`+folio+`'>
                </div> 
            </div>`;

                  }else{

                     ret=`<div class="col-12"><div class="form-group"><label for="bloqueFIL" class="col-form-label">BLOQUEO AL AUXILIAR:</label>
                <select class="form-control" id="bloqueFIL">
                <option>NO</option>
                <option>SI</option>
                </select></div><div class="form-group">
                <label for="calfinal" class="col-form-label">CAL.FINAL</label>
                <input type="number" class="form-control" id="calfinal" value='`+calFinal+`'>
                </div> 


                <div class="form-group">
                <label for="fecha" class="col-form-label">FECHA</label>
                <input type="date" class="form-control" id="fecha" value='`+fecha+`'>
                </div> 
                <div class="form-group">
                <label for="libro" class="col-form-label">LIBRO</label>
                <input type="data" class="form-control" id="libro" value='`+libro+`'>
                </div> 
                <div class="form-group">
                <label for="folio" class="col-form-label">FOLIO</label>
                <input type="data" class="form-control" id="folio" value='`+folio+`'>
                </div> 
            </div>`;

                  }
                


                  Swal.fire({
              title: 'Datos para la Ficha del Alumno',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  calfinal = document.getElementById('calfinal').value;
                  fecha = document.getElementById('fecha').value;
                  libro = document.getElementById('libro').value;
                  folio = document.getElementById('folio').value;
                  bloqueFIL = document.getElementById('bloqueFIL').value;
       

                  ingresar(calfinal,fecha,libro,folio,bloqueFIL,solisitud,idAsigPendiente);
                                  
                }
        });

            
               
            }
        });


}




function ingresar(calfinal,fecha,libro,folio,bloqueFIL,solisitud,idAsigPendiente) {



         ret=`<div class="col-12"> 
                <div class="form-group">
                
                <input type="data" class="form-control" id="pass">
                </div> 
            </div>`;


                  Swal.fire({
              title: 'INGRESE TU CONTRASEÑA',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  pass = document.getElementById('pass').value;

                  if (pass=='32729125') {
                    ingresarF(calfinal,fecha,libro,folio,bloqueFIL,solisitud,idAsigPendiente);
                  }else{
                    Swal.fire({
                            icon: 'error',
                            title: 'CONTRASEÑA INCORRECTA',
                            text: 'Consulte con el administrador',
                            footer: '<a href>Why do I have this issue?</a>'
                          })
                  }
                
                  
                                  
                }
        });

            
    

}











function ingresarF(calfinal,fecha,libro,folio,bloqueFIL,solisitud,idAsigPendiente) {
  

  $.ajax({
            url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/asignaturasPendientesFinal.php",
            type: "POST",
            dataType: "json",
            data: {calfinal:calfinal, fecha:fecha, libro:libro, folio:folio, bloqueFIL:bloqueFIL, solisitud:solisitud, idAsigPendiente:idAsigPendiente},
            success: function(){
            
               
            }
        });

  Swal.fire(
                        'MUY BIEN !',
                        'DATOS GUARDADOS',
                        'success'
                      )

}





<?php }?>




















$("#btnNuevo_asignatura").click(function(){
  
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Carga");            
    $("#modalCRUD_asignacion").modal("show"); 

    
$('#asignatura').select2({
    dropdownParent: "#cont",
    theme: "bootstrap-5", 

});

       
    idAsigPendiente=null;
    opcion = 1; //alta
});


$("#RegresarLibreta").click(function(){

  $('#imagenProceso').show();

      $('#libreTaOcul').show();

      $('#libretaFina').html('');
                

           
    
 $('#imagenProceso').hide(); 

}); 



$(document).on("click", ".btnEditar_libreComp", function(){
    fila = $(this).closest("tr");

    idAsigPendiente = parseInt(fila.find('td:eq(0)').text());
  
    situacion = fila.find('td:eq(2)').text();
    fila='completa';


    idAlumnos=$('#idAlumnosFIna').val();

    cicloFinalLet=$('#cicloFinalLet').val();


    if (situacion=='Equivalencia') {


         $.ajax({
            url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/seccionLibretaFilaPendienteEquivalencia.php",
            type: "POST",
            dataType: "json",
            data: {fila:fila, idAsigPendiente:idAsigPendiente, idAlumnos:idAlumnos, cicloFinalLet:cicloFinalLet},
            success: function(){
            

              window.open('modulos/gestionAcademicaAlumno/libretaFicha/asignaturasPendientesLibretaFilaCompleCaraUno.php', '_blank'); 

    
               
            }
        });


    }else{

  $.ajax({
            url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/seccionLibretaFilaPendienteEquivalencia.php",
            type: "POST",
            dataType: "json",
            data: {fila:fila, idAsigPendiente:idAsigPendiente, idAlumnos:idAlumnos, cicloFinalLet:cicloFinalLet},
            success: function(){
            
               
              window.open('modulos/gestionAcademicaAlumno/libretaFicha/asignaturasPendientesLibretaFilaCompleCaraDos.php', '_blank'); 


            }
        });



    }



});
  

$(document).on("click", ".btnEditar_libreNotas", function(){
    fila = $(this).closest("tr");

    idAsigPendiente = parseInt(fila.find('td:eq(0)').text());

    situacion = fila.find('td:eq(2)').text();

    fila='notas';

       idAlumnos=$('#idAlumnosFIna').val();
       cicloFinalLet=$('#cicloFinalLet').val();

     if (situacion=='Equivalencia') {


         $.ajax({
            url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/seccionLibretaFilaPendienteEquivalencia.php",
            type: "POST",
            dataType: "json",
            data: {fila:fila, idAsigPendiente:idAsigPendiente, idAlumnos:idAlumnos, cicloFinalLet:cicloFinalLet},
            success: function(){
            
            window.open('modulos/gestionAcademicaAlumno/libretaFicha/asignaturasPendientesLibretaFilaCompleCaraUno.php', '_blank'); 

               
            }
        });




    }else{

  $.ajax({
            url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/seccionLibretaFilaPendienteEquivalencia.php",
            type: "POST",
            dataType: "json",
            data: {fila:fila, idAsigPendiente:idAsigPendiente, idAlumnos:idAlumnos, cicloFinalLet:cicloFinalLet},
            success: function(){
            
               window.open('modulos/gestionAcademicaAlumno/libretaFicha/asignaturasPendientesLibretaFilaCompleCaraDos.php', '_blank'); 

            }
        });



    }
    
});









$(document).on("click", ".btnEditar_asignaturaPe", function(){
    fila = $(this).closest("tr");

    

    idAsigPendiente = parseInt(fila.find('td:eq(0)').text());
    asignaturas=fila.find('td:eq(1)').text();
    
    situacion = fila.find('td:eq(2)').text();
    
   
    ciclo=$("#cicloFinalLet").val(); 

  $('#asignatura').select2({
    dropdownParent: "#cont",
    theme: "bootstrap-5", 

});


          
            $('#asignatura').val(asignaturas).trigger('change.select2');
  
    
       
    $("#situacion").val(situacion);
 

    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar ");            
    $("#modalCRUD_asignacion").modal("show");  
    
});
  

$(document).on("click", ".btnBorrar_asignaturaPe", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    opcion = 3 ;//borrar

    eliminarAntesPE(idAsigPendiente,opcion);

    

  
});
    



















});









function eliminarAntesPE(idAsigPendiente,opcion) {

  

Swal.fire({
  title: 'Esta seguro de eliminar este registro?',
  text: "Los datos eliminados no se podran recuperar!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, eliminar este registro!'
}).then((result) => {
  if (result.isConfirmed) {
  
    eliminarAntesPEDefini(idAsigPendiente,opcion);
  }
})



      
     
}


function  eliminarAntesPEDefini(idAsigPendiente,opcion){

    alert(idAsigPendiente);
    alert(opcion);
    
 
        $.ajax({
            url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/asignaturasPendientes.php",
            type: "POST",
            
            data: {opcion:opcion, idAsigPendiente:idAsigPendiente},
            success: function(dat){
            console.log(dat);

            tablaAsignacion = $('#tablaAsignacion').DataTable();

              tablaAsignacion.row(fila.parents('tr')).remove().draw();
            }
        });

        

    
}







function formAsignaturaPendienteEquivalencia(){

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


    
    asignatura = $("#asignatura").val();
    
     situacion = $("#situacion").val();


    $.ajax({
        url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/asignaturasPendientes.php",
        type: "POST",
        dataType: "json",
        data: {idAsigPendiente:idAsigPendiente, asignatura:asignatura, opcion:opcion, situacion:situacion},
        success: function(data){  
            console.log(data);
            idAsigPendiente = data[0].idAsigPendiente;            
            idAlumno = data[0].idAlumno;
            asignaturas = data[0].asignaturas;
          

            nombre = data[0].nombre;
            
            situacion = data[0].situacion;
            ciclo = data[0].ciclo;




              boton=`<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1`+idAsigPendiente+`" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1`+idAsigPendiente+`">
                                      
                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa1" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 1</a></li>
                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa2" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 2</a></li>
                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa3" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 3</a></li>
                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa4" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 4</a></li>
                                      <li><a title='MODIFICAR NOTA DE LA MESA' class="dropdown-item mesa5" href="javascript:void(0)"><i class='fas fa-cog fa-spin'></i> MESA 5</a></li>

                                   
                                    </ul>
                                  </div>`;



         tablaAsignacion = $('#tablaAsignacion').DataTable();

            
            
        
            if(opcion == 1){tablaAsignacion.row.add([idAsigPendiente,asignaturas,situacion,nombre+' '+ciclo,boton]).draw();}
            else{tablaAsignacion.row(fila).data([idAsigPendiente,asignaturas,situacion,nombre+' '+ciclo,boton]).draw();}            
        }        
    });


    $("#modalCRUD_asignacion").modal("hide");    
     $.unblockUI();
    
}  





function remover660 () {


    $('#cursoSe').val(0);
  $('#contenidoAyuda').html('');




}




function inprimirFicha(){

   window.open('modulos/gestionAcademicaAlumno/libretaFicha/asignaturasPendientesFicha.php', '_blank'); 

   
}

 $.unblockUI();

</script>




<?php  } ?>



