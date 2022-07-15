
<?php
      include_once '../../bd/conexion.php';
      $objeto = new Conexion();
      $conexion = $objeto->Conectar();
      session_start();
      if ((isset($_SESSION['cursoSe']))){
          $cursoSe=$_SESSION['cursoSe'];

  
$operacion=$_SESSION["operacion"];


$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

 $cat='';

       $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` ORDER BY `idPlan`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $idPlan=$da1t['idPlan'];
                    $nombre=$da1t['nombre'];
                    $numero=$da1t['numero'];

                     $cat.="<option value='".$idPlan."'>".$nombre."- numero: ".$numero."</option>";


                  }





            $consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `datosalumnos`.`dniAlumnos`, `datosalumnos`.`nombreAlumnos` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos`= `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso` = '$cursoSe'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);






    ?>








  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">MATRICULA</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover3()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

                   <?php


 if ($_SESSION['cargo'] == 'Administrador'){  

        if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>






<hr>
         <select class="form-control" id="planF">
                        <?php echo $cat;  ?>
        </select> 

        <input hidden='' type="text" id="curso" value="<?php echo $cursoSe ?>">
<hr>
<h5>Carga Por Planilla <a download="matricula" href="modulos/gestionAcademicaAlumno/matriculacion/matricula.csv">MODELO EXCEL FORMATO (CSV DELIMITADO POR COMAS)</a></h5>
  <div id="container-input">
            <div class="wrap-file">


              
                <div class="content-icon-camera">


                    <input class="btn btn-success" type="file" id="file" name="file[]" accept=".csv" />
                    <div class="icon-camera"></div>
                </div>
                <div id="preview-images">
                    
                </div>
            </div>
            
           
        </div>


        <button type="submit" class="btn btn-dark" onclick="publicar()"> <i class='fas fa-save'></i> SUBIR ARCHIVO</button>
<hr><br>

















          <button class="btn btn-warning glyphicon glyphicon-pencil" title="SELECCIONAR O DESELECCIONAR ALUMNOS" onclick="seleccionarTODO()" class="Eliminar"><i class='fas fa-check-circle'></i></button>
          <button id="btnNuevo_InscripAl" type="button" class="btn btn-info" data-toggle="modal" title="MATRICULAR AL ALUMNO"><i class='fas fa-user-plus'></i></button>

          <button class="btn btn-danger glyphicon glyphicon-pencil eliminar" id="eliminarMatricula" title="DESMATRICULAR LOS ALUMNOS SELECCIONADOS" onclick="desmatricularAlumno()"><i class='fas fa-trash'></i></button>

          <button class="btn btn-info glyphicon glyphicon-pencil" title="MATRICULAR EN OTRO CURSO" onclick="cambiarCurso()"><i class='fas fa-undo-alt'></i></button>


          <br><hr>


             <?php } ?>


<?php   


 } 


  ?>


    <table id="tablaInscripcion" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>N°inscrip</th>
            <th>DNI</th>
            <th>Apellido y Nombre</th>
        </tr>
    </thead>
    <tbody>
     <?php

       $colorFinal='';

                            $contadorColores=0;
            $contador=0;    

            $cicloValor=0;
     
     foreach($data as $dat) { 
        $idIns=$dat['idIns'];
        $dniAlumnos=$dat['dniAlumnos'];
        $nombreAlumnos=$dat['nombreAlumnos'];
              
         
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
        </tr>
    <?php } ?>                      
    </tbody>
    <tfoot>
        <tr>
            <th>N°inscrip</th>
            <th>DNI</th>
            <th>Apellido y Nombre</th>
        </tr>
    </tfoot>
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


<div class="modal fade" id="inscripcionAlumnoMesaS" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Inscripción a la Mesa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  
            <div id="cont" class="modal-body">
           

 
                <div class="form-group">
              
                        <select class="form-select" id="idAlumnos" >
                            <option value="0">Seleccione el Estudiante</option>
                             <?php


                             $consulta = "SELECT `datosalumnos`.`idAlumnos`, `datosalumnos`.`idPlanEstudio`, `plan_datos`.`nombre`, `datosalumnos`.`dniAlumnos`, `datosalumnos`.`nombreAlumnos` FROM `datosalumnos` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan`=`datosalumnos`.`idPlanEstudio`";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                          
                                    foreach($data as $dat) { 

                                         
                                         $idPlanEstudio=$dat['idPlanEstudio'];
                                    $idAlumnos=$dat['idAlumnos'];
                                    $dniAlumnos=$dat['dniAlumnos'];
                                    $nombreAlumnos=$dat['nombreAlumnos'];
                                    $nombre=$dat['nombre'];
                                   

                                             ?>
                                            <option value="<?php echo $idAlumnos; ?>"><?php echo $nombreAlumnos.'; DNI: '.$dniAlumnos; ?></option>
                                        <?php } ?>
                        </select>
                
               </div>


            
           
                                    
            </div> 
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button  onclick="matricular()" type="submit" id="btnGuardar" class="btn btn-dark"> <i class='fas fa-save'></i> Matricular</button>
            </div>
   
    </div>
  </div>
</div>

      
                 


<div class="modal fade" id="modalCRUD_cambioCurso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
   
            <div class="modal-body">
              <div class="form-group">
                <label for="planSeleC" class="col-form-label">Curso:</label>
                <select class="form-control" id="cursoSeCambi">
                  <option value="0">Seleccione un Curso</option>
                  <?php

                    $consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `idPlan`='básico'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $idPlan=$da1t['idPlan'];
                    $idCurso=$da1t['idCurso'];
                    $nombre=$da1t['nombre'];

                    ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nombre.'--'.$idPlan ?></option>
                    <?php } ?>

                     <?php
           
                  $consulta = "SELECT `curso_$cicloLectivo`.`idCurso`, `plan_datos`.`nombre`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso' FROM `curso_$cicloLectivo` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan`= `curso_$cicloLectivo`.`idPlan`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($data as $dat) { 
                
                    $idCurso=$dat['idCurso'];
                    $nombreCurso=$dat['nombreCurso'];
                    $nombre=$dat['nombre'];

                    ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nombreCurso.'--'.$nombre ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button onclick="matricularOtro()"  class="btn btn-dark cambiarFinal"> <i class='fas fa-save'></i> Matricular en otro curso</button>
            </div>
        
    </div>
  </div>
</div>






   <?php } ?>











<script type="text/javascript">

 $.unblockUI();



    var myTable = $('#tablaInscripcion').DataTable({
        "destroy":true,
        responsive: true,   
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
            className: 'btn btn-success',
             title:'Listado de Alumnos de <?php echo $_SESSION['cursoSe'].' // Ciclo: '.$_SESSION['cicloLectivo'];?>'
          },
          {
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger',
             title:'Listado de Alumnos de <?php echo $_SESSION['cursoSe'].' // Ciclo: '.$_SESSION['cicloLectivo'];?>'
          },
          {
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info',
            title:'Listado de Alumnos de <?php echo $_SESSION['cursoSe'].' // Ciclo: '.$_SESSION['cicloLectivo'];?>'
          },
        ]         
        });

   <?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>

//  inicio el array y el selector (total)
var arrayContieneLosElementosAEliminar =[];
var selector=0;



//  selecciono particular o grupal, agrego en un array 

$('#tablaInscripcion tbody').on('click', 'tr', function () {
        
        // selecciona en datatable
         $(this).toggleClass('selected');

   
    // obtengo los valores
    var dataFila = myTable.row( this ).data();
    //verifico con el dato si esta dentro del array, busco y si tiene indice
    index = arrayContieneLosElementosAEliminar.indexOf(dataFila[0]);
    // verifico si posee indice no puede dar -1
    if (index > -1) {
        // elimino el elemento seleccionado con el indice encontrado
        arrayContieneLosElementosAEliminar.splice(index, 1);
    }else{
        // agrego elemento al array
        arrayContieneLosElementosAEliminar.push(dataFila[0]);

    }
console.log(arrayContieneLosElementosAEliminar); 


} );

//  fin seleccion particular o grupal

//  seleccinar total
function seleccionarTODO () {

    //  selecciono y selecciono todo, reinicio el array y agrego los elementos nuevamente...

    if ((selector % 2) == 0) {
             $("tr").addClass(" odd selected");
            arrayContieneLosElementosAEliminar=[];

            myTable.rows().data().each(function (value) {
                var dataFila_total= value[0];
                arrayContieneLosElementosAEliminar.push(dataFila_total);
            });

    }else{

            $("tr").removeClass(" odd selected");
            
            myTable.rows().data().each(function (value) {
                var dataFila_total= value[0];
                arrayContieneLosElementosAEliminar=[];
            });
    }

selector++;

console.log(arrayContieneLosElementosAEliminar); 


}

//  fino selecciono total


//  eliminar lo seleccionado

function borrarSeleccion () {
  
        myTable.rows('.selected').remove().draw();
}

// fin de eliminar seleccionado








$("#btnNuevo_InscripAl").click(function(){
  
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Carga");            
    $("#inscripcionAlumnoMesaS").modal("show"); 

    
$('#idAlumnos').select2({
    dropdownParent: "#cont",
    theme: "bootstrap-5", 

});

});

function matricular(){

    idAlumnos = $("#idAlumnos").val();
    idIns = null; 
    opcion=1;

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
          data:'idAlumnos=' + idAlumnos + '&idIns=' + idIns+ '&opcion=' + opcion,
          url:'modulos/gestionAcademicaAlumno/matriculacion/elementos/crud_inscripcionaMatricular.php',
          success:function(res){
                console.log(res)
              v=res.split('||');

                idIns = v[0];    
                dniAlumnos = v[1];
                nombreAlumnos = v[2];
                nombre = v[3];
                comprobar = v[4];

                if (comprobar=='NO') {    
                    myTable.row.add([idIns,dniAlumnos,nombreAlumnos]).draw();
                    toastr.success('Se matriculo con exito  !!!');
                }else{
                        toastr.error('El alumno ya esta Matriculado en '+nombre);
                }
                $.unblockUI();
                   

            }
    });
   


}



     function desmatricularAlumno() {
        Swal.fire({
          title: 'Esta seguro de Desmatricular estos alumno/s del curso?',
          text: "Los alumnos perderan todas las notas de la Libreta digital",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Desmatricular'
        }).then((result) => {
          if (result.isConfirmed) {
            desmatricularAlumnoFi();
        }
      })
      }


      function desmatricularAlumnoFi() {

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
                  data:{arrayContieneLosElementosAEliminar:arrayContieneLosElementosAEliminar},
                  url:'modulos/gestionAcademicaAlumno/matriculacion/elementos/crud_inscripcionDesmatricular.php',
                  success:function(respuesta){

                    console.log(respuesta);

                        if (respuesta==1) {
                            toastr.success('Se Desmatriculo con exito  !!!');
                            $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/matriculacion/Inscrip_TablaInscrp.php');
                        }else{
                            toastr.error('Error del Servidor');
                        }
                        
                        $.unblockUI();
             
                  }
                });

       
      }
  
function cambiarCurso(){

    
          $(".modal-header").css("background-color", "#1cc88a");
          $(".modal-header").css("color", "white");
          $(".modal-title").text("Cambiar los alumnos del curso");            
          $("#modalCRUD_cambioCurso").modal("show");
      }





 function matricularOtro() {
        Swal.fire({
              title: 'Esta seguro de cambiar estos alumno/s a otro curso?',
              text: "Los alumnos perderan todas las notas de la Libreta digital de este curso",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Cambiar'
            }).then((result) => {
              if (result.isConfirmed) {

                cambioCursoTotalFinal();
            }
          })
          }


 

          function cambioCursoTotalFinal() {

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
    


            cursoSe = $("#cursoSeCambi").val();


            if (cursoSe!='0') {
              $("#modalCRUD_cambioCurso").modal("hide");
          
                 myTable.rows('.selected').remove().draw();
                
                $.ajax({
                      type:"post",
                      data:{arrayContieneLosElementosAEliminar:arrayContieneLosElementosAEliminar,cursoSe:cursoSe},
                      url:'modulos/gestionAcademicaAlumno/matriculacion/elementos/crud_inscripcionCambio.php',
                      success:function(respuesta){
                    
                        if (respuesta==1) {
                            toastr.success('Se Desmatriculo con exito  !!!');
                            $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/matriculacion/Inscrip_TablaInscrp.php');
                        }else{
                            toastr.error('Error del Servidor');
                        }
                        
                         $.unblockUI();
                      
                     }
                });
              }else{
                toastr.error('Debe seleccionar un curso');

              }
        
            }
          































    var formData = new FormData();

    var cantidadArchivos=0;

   file.addEventListener('change', function (e) {

        for ( var i = 0; i < file.files.length; i++ ) {
            var thumbnail_id = Math.floor( Math.random() * 30000 ) + '_' + Date.now();

            nombreArchivo=file.files[i].name;
            createThumbnail(file, i, thumbnail_id,nombreArchivo);
            formData.append(thumbnail_id, file.files[i]);
            cantidadArchivos=1;
        }

        

        e.target.value = '';

    });


  
 var createThumbnail = function (file, iterator, thumbnail_id,nombreArchivo) {
        var thumbnail = document.createElement('div');


        thumbnail.classList.add('thumbnail', thumbnail_id);
        thumbnail.dataset.id = thumbnail_id;

        // thumbnail.setAttribute('style', `background-image: url(${ URL.createObjectURL( file.files[iterator] ) })`);   imagen
        
     document.getElementById('preview-images').appendChild(thumbnail);
        createCloseButton(thumbnail_id,nombreArchivo);
    }

    var createCloseButton = function (thumbnail_id,nombreArchivo) {
        var closeButton = document.createElement('div');
        closeButton.classList.add('close-button');
        closeButton.innerText = '*) ELIMINAR: '+nombreArchivo;
        document.getElementsByClassName(thumbnail_id)[0].appendChild(closeButton);
    }

    var clearFormDataAndThumbnails = function () {
        for ( var key of formData.keys() ) {
            formData.delete(key);
            cantidadArchivos=0;
        }

        cantidadArchivos=0;

        document.querySelectorAll('.thumbnail').forEach(function (thumbnail) {
            thumbnail.remove();
        });
    }

    document.body.addEventListener('click', function (e) {
        if ( e.target.classList.contains('close-button') ) {
            e.target.parentNode.remove();
            formData.delete(e.target.parentNode.dataset.id);
            cantidadArchivos=0;
        }
    });






    function publicar(){

     
          if (cantidadArchivos==0) {
            toastr.error('No hay archivo seleccionado');
            return false;
          }


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
    




            planF= $("#planF").val();


            formData.append('planF', planF);


            curso= $("#curso").val();


            formData.append('curso', curso);




                    $.ajax({
                
               url:'modulos/gestionAcademicaAlumno/matriculacion/elementos/registrar.php',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
                
                success: function(respuesta){
                    
                    console.log(respuesta);

                    if (respuesta==1) {

                        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/matriculacion/Inscrip_TablaInscrp.php');
    
                        toastr.success('¡Operación exitosa!');
                        toastr.info('¡Petición exitosa!');
                       

                    }else if (respuesta==2) {

                      
                        toastr.error('No podes editar cuando esta cerrado el ciclo');
                      

                    }else if (respuesta==2) {

                      
                        toastr.error('No podes editar cuando esta cerrado el ciclo');
                      

                    }else if (respuesta=='La variable ciclo no esta') {

                      
                        toastr.error('La variable ciclo no esta');
                      

                    }else if (respuesta=='La variable curso no esta') {

                      
                        toastr.error('La variable curso no esta');
                      

                    }else{

                      
                        toastr.error('error de Servidor');
                      

                    }


                       
                    clearFormDataAndThumbnails();

                       

                        $.unblockUI();
                 },




});  
    }








   <?php }?>







function remover3 () {

  
    
  
 
   $('#cursoSe').val('Seleccione un Curso');
  
      $('#tablaInstitucional').html('');
       
        $('#imagenProceso').hide();  



}



</script>



<?php  } ?>

