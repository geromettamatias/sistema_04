
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



            $consulta = "SELECT `notificacion`.`id_notificacion`, `datos_docentes`.`nombre`  AS 'nombreDocente', `datos_docentes`.`dni`, `curso_$cicloLectivo`.`nombre`  AS 'nombreCurso', `plan_datos_asignaturas`.`nombre`  AS 'nombreAsignatura', `notificacion`.`columna`, `notificacion`.`fecha` FROM `notificacion` INNER JOIN `datos_docentes` ON  `datos_docentes`.`idDocente`=`notificacion`.`id_docente` INNER JOIN `curso_$cicloLectivo` ON  `curso_$cicloLectivo`.`idCurso`=`notificacion`.`id_curso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `notificacion`.`id_asignatura` WHERE `notificacion`.`ciclo`='$cicloLectivo'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);






   if ($_SESSION['cargo'] == 'Administrador'){  


    ?>

          <button class="btn btn-warning glyphicon glyphicon-pencil" title="SELECCIONAR O DESELECCIONAR ALUMNOS" onclick="seleccionarTODO()" class="Eliminar"><i class='fas fa-check-circle'></i></button>
          


          <button class="btn btn-danger glyphicon glyphicon-pencil eliminar" id="eliminarMatricula" title="DESMATRICULAR LOS ALUMNOS SELECCIONADOS" onclick="desmatricularAlumno()"><i class='fas fa-trash'></i></button>

     


          <br><hr>
<?php   


 } 


  ?>


    <table id="tablaInscripcion" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>N°</th>
            <th>Fecha</th>
            <th>Asignatura</th>
            <th>Datos</th>
            <th>Columnas Notificación</th>

       

        </tr>
    </thead>
    <tbody>
     <?php

       $colorFinal='';

                            $contadorColores=0;
            $contador=0;    

            $cicloValor=0;
     
     foreach($data as $dat) { 
        $id_notificacion=$dat['id_notificacion'];
        $fecha=$dat['fecha'];
        $nombreAsignatura=$dat['nombreAsignatura'];
          $nombreDocente=$dat['nombreDocente'];
            $dni=$dat['dni'];
           $columna=$dat['columna'];
                     
     

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
            <td><?php echo $id_notificacion ?></td>
            <td><?php echo $fecha ?></td>
            <td><?php echo $nombreAsignatura ?></td>
            <td><?php echo $nombreDocente.'; DNI:'.$dni; ?></td>
            <td><?php echo $columna ?></td>

        </tr>
    <?php } ?>                      
    </tbody>
    <tfoot>
        <tr>
            <th>N°</th>
            <th>Fecha</th>
            <th>Asignatura</th>
            <th>Datos</th>
            <th>Columnas Notificación</th>

         
        </tr>
    </tfoot>
</table>
   




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
    

            myTable.rows('.selected').remove().draw();
               

                $.ajax({
                  type:"post",
                  data:{arrayContieneLosElementosAEliminar:arrayContieneLosElementosAEliminar},
                  url:'modulos/gestionAcademicaDocente/notificaciones/elementos/eliminar.php',
                  success:function(respuesta){

                        if (respuesta==1) {
                            toastr.success('Se elimino con exito  !!!');
                        }else{
                            toastr.error('Error del Servidor');
                        }
                        
                        $.unblockUI();
             
                  }
                });

       
      }
  


          

</script>



<?php  } ?>

