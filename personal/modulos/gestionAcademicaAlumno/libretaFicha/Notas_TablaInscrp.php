
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


if ((isset($_SESSION['cursoSe']))){
$cursoSe=$_SESSION['cursoSe'];

  $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



if ($cursoSe!='0'){


 
$consulta = "SELECT `idIns`, `idCurso`, `idAlumno` FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `idCurso`='$cursoSe'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>
<div id="libreTaOcul">








  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-warning">
              
              <div class="card-header">
                <h3 class="card-title">LISTA DE ALUMNOS DEL CURSO</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover00()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

                
                       <table id="tablaInscripcion" class="table table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°inscrip</th>
                                <th>DNI</th>
                                <th>Apellido y Nombre</th>
                                <th>Botones</th> 
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php 
                            
                            $colorFinal='';

                            $contadorColores=0; 

                            foreach($data as $dat) { 

                              

                                $idIns=$dat['idIns'];
                                $idAlumno=$dat['idAlumno'];

                              


                                $consulta1 = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumno'";
                                    $resultado1 = $conexion->prepare($consulta1);
                                    $resultado1->execute();
                                    $d1ata=$resultado1->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($d1ata as $d1at) {
                                        $idAlumnos=$d1at['idAlumnos'];
                                        $dniAlumnos=$d1at['dniAlumnos'];
                                        $nombreAlumnos=$d1at['nombreAlumnos'];

                                        
                                    }
                                   if ($contadorColores<=6) {
                                 $contadorColores++;

                                 if ($contadorColores==1) {
                                     $colorFinal='success';
                                 }else{
                                        if ($contadorColores==2) {
                                            $colorFinal='primary';
                                         }else{
                                                 if ($contadorColores==3) {
                                                    $colorFinal='secondary';
                                                 }else{
                                                    if ($contadorColores==4) {
                                                        $colorFinal='danger';
                                                     }else{
                                                        if ($contadorColores==5) {
                                                            $colorFinal='warning';
                                                         }else{
                                                            $colorFinal='info';
                                                         }
                                                     }
                                                 }
                                         }
                                 }

                             }else{
                                $contadorColores=1;
                                $colorFinal='success';
                             }




                         
                            ?>
                            <tr class="table-<?php echo $colorFinal; ?>">
                              
                      
                                <td><?php echo $idIns ?></td>

                                <td><?php echo $dniAlumnos ?></td>
                             
                                <td><?php echo $nombreAlumnos ?></td>
                            



                               
           
                                <td>
                    
                                    <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      
                                      <li><a title='Gestión Libreta y Ficha digital' class="dropdown-item" href="javascript:void(0)" onclick="botonNotas('<?php echo $idIns ?>')">LIBRETA/FICHA/INFORME <i class='fas fa-cog fa-spin'></i></a></li>

                                      <?php if ($edicion=='SI') { ?>

                                       <?php    if ((($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'AUXILIAR')) && ($_SESSION['operacion'] == 'Lectura y Escritura')){  ?>

                                      <li><a title='Editar datos de Ficha' class="dropdown-item" href="javascript:void(0)" onclick="botonDatosFicha('<?php echo $idAlumnos ?>')">Datos Ficha <i class='fas fa-cog fa-spin'></i></a></li>

                                      <li><a title='Editar datos de Libreta digital' class="dropdown-item" href="javascript:void(0)" onclick="botonDatosLibreta('<?php echo $idAlumnos ?>')">Datos Libreta <i class='fas fa-cog fa-spin'></i></a></li>

                                       <?php    }  ?>

                                   <?php } ?>

                                        <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'AUXILIAR') || ($_SESSION['cargo'] == 'REGENTE') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>

                                      <li><a title='Gestión-Asignaturas Pendientes o Equivalentes' class="dropdown-item" href="javascript:void(0)" onclick="botonAsignaturaPendiente('<?php echo $idAlumnos ?>')">ASIGNATURAS PENDIENTES-EQUIVALENTE <i class='fas fa-cog fa-spin'></i></a></li>

                                       <?php    }  ?>

                                
                                    </ul>
                                  </div>
                                </div>






                                </td>
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






   
</div>


<div id="libretaFina"></div>









<?php  }

} ?>






  



<script type="text/javascript">
$(document).ready(function(){

var tablaInscripcion = $('#tablaInscripcion').DataTable({ 

    "destroy":true,
      // "pageLength" : 2, 
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
      {
        extend:    'excelHtml5',
        text:      '<i class="fas fa-file-excel"></i> ',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        className: 'btn btn-info'
      },
    ]         
    });

});


function botonAsignaturaPendiente(idAlumnos) {
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
              data:'idAlumnos=' + idAlumnos,
              url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/seccionPendienteApro.php',
              beforeSend: function() {
                  $("#imagenProceso").show();
                                
                              },
              success:function(r){
                

              $('#libreTaOcul').hide();
              $("#imagenProceso").hide();

            $('#libretaFina').load('modulos/gestionAcademicaAlumno/libretaFicha/asignaturasPendientes.php');
                            

                
                
              }
            });



  
          
}





function botonNotas(idIns) {

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
                  data:'idIns=' + idIns,
                  url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/seccionLibretaDigital.php',
                  beforeSend: function() {
                  $("#imagenProceso").show();
                                
                              },
              success:function(r){
                    

              $('#libreTaOcul').hide();
              $("#imagenProceso").hide();

            $('#libretaFina').load('modulos/gestionAcademicaAlumno/libretaFicha/LibretaDigital.php');
                            

                    
                    
                  }
                });



    
          
}








function botonDatosLibreta(idAlumno) {



  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno,
    url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/buscarDatosLibreta.php',
    success:function(res){

            console.log(res);

            data = res.split('||');

            promovido1 = data[0];            
            ob1 = data[1];
            lugarFecha1 = data[2];
     

    Swal.fire({
              title: 'Datos para la Ficha del Alumno',
              html:`<div class="col-12">
              <div class="form-group">
                  <label for="promovido" class="col-form-label">Promovido a:</label>
                  <input type="text" class="form-control" id="promovido" value='`+promovido1+`'>
              </div>
              <div class="form-group">
                  <label for="ob" class="col-form-label">OBSERVACIONES:</label>
                  <input type="text" class="form-control" id="ob" value='`+ob1+`'>
              </div>
              <div class="form-group">
                  <label for="lugarFecha" class="col-form-label">Lugar y Fecha:</label>
                  <input type="text" class="form-control" id="lugarFecha" value='`+lugarFecha1+`'>
              </div>
             
            </div>`, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  promovido = document.getElementById('promovido').value,
                  ob = document.getElementById('ob').value,
                  lugarFecha = document.getElementById('lugarFecha').value,
                
                 
                 ingresarDatosLibreta(idAlumno,promovido,ob,lugarFecha);
                                  
                }
        });



    }
  });


  
          
}




function ingresarDatosLibreta(idAlumno,promovido,ob,lugarFecha) {
  


  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno +'&promovido=' + promovido +'&ob=' + ob +'&lugarFecha=' + lugarFecha,
    url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/ingresarDatosLibretaAlumno.php',
    success:function(r){
  
      Swal.fire(
            'Muy bien !!',
            'Operación exitosa',
            'success'
          )

    }
  });

}














function botonDatosFicha(idAlumno) {


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
        data:'idAlumno=' + idAlumno,
        url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/buscarDatosFicha.php',
        success:function(res){

              
            data = res.split('||');

            Libro = data[0];            
            Folio = data[1];
           
            auxiliar = data[2];
            piePagina = data[3];
    


        Swal.fire({
              title: 'Datos para la Ficha del Alumno',
              html:`<div class="col-12">
                <div class="form-group">
                    <label for="Libro" class="col-form-label">Libro:</label>
                    <input type="text" class="form-control" id="Libro" value='`+Libro+`'>
                </div>
                <div class="form-group">
                    <label for="Folio" class="col-form-label">Folio:</label>
                    <input type="text" class="form-control" id="Folio" value='`+Folio+`'>
                </div>
                
                <div class="form-group">
                    <label for="auxiliar" class="col-form-label">Auxiliar Docente:</label>
                    <input type="text" class="form-control" id="auxiliar" value='`+auxiliar+`'>
                </div>
              <div class="form-group">
                  <label for="piePagina" class="col-form-label">Observaciones(Pie de Pagina):</label>
                 
                  <textarea class="form-control" id="piePagina" rows="5">`+piePagina+`</textarea>
              </div>
            </div>`, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  Libro = document.getElementById('Libro').value,
                  Folio = document.getElementById('Folio').value,
                 
                   auxiliar = document.getElementById('auxiliar').value,
                   piePagina = document.getElementById('piePagina').value,
                 
                 ingresarDatosFicha(idAlumno,Libro,Folio,auxiliar,piePagina);
                                  
                }
        });


               $.unblockUI();
        }
    });


    
          
}

function ingresarDatosFicha(idAlumno,Libro,Folio,auxiliar,piePagina) {
    
    $.ajax({
        type:"post",
        data:'idAlumno=' + idAlumno +'&Libro=' + Libro +'&Folio=' + Folio +'&auxiliar=' + auxiliar +'&piePagina=' + piePagina,
        url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/ingresarDatosFichaAlumno.php',
        success:function(r){

            Swal.fire(
                      'Muy bien !!',
                      'Operación exitosa',
                      'success'
                    )

        }
    });

}



function remover00 () {


  $('#cursoSe').val(0);
  $('#contenidoAyuda').html('');



}
 $.unblockUI();
</script>