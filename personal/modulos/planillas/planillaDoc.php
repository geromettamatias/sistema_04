
<?php
        include_once '../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        
                 session_start();

     

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivoFINAL= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


        $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos` FROM `datos_docentes`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>



<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                 Planilla Docente Docentes
                </h3>
              </div>
              <div class="card-body">

                

                <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

              <button  type="button" class="btn btn-warning" data-toggle="modal" title="Inprimir Planilla Docente" onclick="imprimirPre()"><i class="fa fa-print"></i></button>
              <hr>

              <table id="tablaDocente" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>DNI</th>
                                <th>APELLIDO Y NOMBRE</th> 
                                <th>DOMICILIO</th> 
                                <th>EMAIL</th>
                                <th>TELEFONO</th>
                                <th>TITULO</th>
                                <th>HIJOS EN ESCOLARIDAD</th>
                                <th>SITUACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $colorFinal='';

                            $contadorColores=0;                           
                            foreach($data as $dat) {                   

                                $idDocente=$dat['idDocente'];                    
                            

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
                             
                                <td><?php echo $dat['dni'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['domicilio'] ?></td>
                                <td><?php echo $dat['email'] ?></td>
                                <td><?php echo $dat['telefono'] ?></td>
                                <td><?php echo $dat['titulo'] ?></td>
                                <td><?php echo $dat['hijos'] ?></td>
                                 <td><?php 

                                 $imprimir='';

                                     $consulta = "SELECT `id_asig_cargo`, `idDocente`, `cargo`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes` FROM `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL` WHERE `idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $da1ta=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($da1ta as $d1at) {   

                                    $imprimir.= '*) '.$d1at['cargo'].'; Situación: '.$d1at['situacion'].'; Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'];

                             }   



                                  $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivoFINAL`.`nombre` AS 'nombreCurso', `asignacion_asignatura_docente_$cicloLectivoFINAL`.`situacion`,`asignacion_asignatura_docente_$cicloLectivoFINAL`.`desde`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`hasta`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`obserbaci` FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivoFINAL` ON `curso_$cicloLectivoFINAL`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idCurso` WHERE `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data3=$resultado->fetchAll(PDO::FETCH_ASSOC);                   
                            foreach($data3 as $d1at) {

                                  $imprimir.= '*) '.$d1at['nombre'].'; Situación: '.$d1at['situacion'].'; Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'; Curso: '.$d1at['nombreCurso'];

                            }




                                $consulta = "SELECT `id_asig_proyecto`, `idDocente`, `cHoras`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `licencia` FROM `asignacion_asignatura_docente_proyecto_$cicloLectivoFINAL` WHERE `idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $da1ta=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($da1ta as $d1at) {


                                 $imprimir.= '*) '.$d1at['cHoras'].' Hs Proyecto; Situación: '.$d1at['situacion'].'; Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'];
                            } 

                            echo $imprimir;                                      

                                  ?></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>  

               
              </div>
              <!-- /.card -->
            </div>


<div class="modal fade" id="modal_Pregunta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
               
          

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>SELECCIONE LAS COLUMNAS QUE SE IMPRIMIRAN</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 table-info">
                                 <div class="form-group">
                                    <label for="dni" class="col-form-label">DNI:</label>
                                    <select class="form-control" id="dni">
                                    <option>SI</option>
                                    <option>NO</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-4 table-warning">

                              <div class="form-group">
                                <label for="name" class="col-form-label">APELLIDO Y NOMBRE:</label>
                                <select class="form-control" id="name">
                                <option>SI</option>
                                <option>NO</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4 table-danger">
                               <div class="form-group">
                                <label for="domicilio" class="col-form-label">DOMICILIO:</label>
                                <select class="form-control" id="domicilio">
                                <option>SI</option>
                                <option>NO</option>
                                </select>
                              </div>
                            </div>
                        </div>
                        <hr>

                       
                        <div class="row">
                            <div class="col-md-4 table-success">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">EMAIL</label>
                                    <select class="form-control" id="email">
                                    <option>SI</option>
                                    <option>NO</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-4 table-secondary">
                                 
                                  <div class="form-group">
                                    <label for="telefono" class="col-form-label">TELEFONO</label>
                                    <select class="form-control" id="telefono">
                                    <option>SI</option>
                                    <option>NO</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-4 table-primary">
                                  <div class="form-group">
                                    <label for="titulo1" class="col-form-label">TITULO</label>
                                    <select class="form-control" id="titulo1">
                                    <option>SI</option>
                                    <option>NO</option>
                                    </select>
                                  </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 table-danger">
                                 <div class="form-group">
                                    <label for="hijos" class="col-form-label">HIJOS EN ESCOLARIDAD</label>
                                    <select class="form-control" id="hijos">
                                    <option>SI</option>
                                    <option>NO</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-6 table-info">
                                  <div class="form-group">
                                    <label for="situacion" class="col-form-label">SITUACIÓN</label>
                                    <select class="form-control" id="situacion">
                                    <option>SI</option>
                                    <option>NO</option>
                                    </select>
                                  </div>
                            </div>
                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>SI SELECCIONO 'SI' LA SITUACIÓN</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 table-secondary">
                                <div class="form-group">
                                    <label for="nombreMateria" class="col-form-label">NOMBRE DE MATERIA/CARGO:</label>
                                    <select class="form-control" id="nombreMateria">
                                    <option>SI</option>
                                    <option>NO</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-4 table-warning">
                                <div class="form-group">
                                    <label for="situacionRevista" class="col-form-label">Situación de Revista:</label>
                                    <select class="form-control" id="situacionRevista">
                                    <option>SI</option>
                                    <option>NO</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-4 table-primary">
                                <div class="form-group">
                                    <label for="desdeHasta" class="col-form-label">Desde/Hasta:</label>
                                    <select class="form-control" id="desdeHasta">
                                    <option>SI</option>
                                    <option>NO</option>
                                    </select>
                                  </div>
                            </div>
                           
                        </div>
                        <hr>    
                    </div>
                </div>         
                
              


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-dark" onclick="imprimirFinal()"> <i class='fas fa-save'></i> Visualizar Planilla</button>
            </div>
     
    </div>
  </div>
</div>


 

 <script type="text/javascript">

      $('#imagenProceso').hide();
      $('#cargaCiclo').hide();
    var tablaDocente = $('#tablaDocente').DataTable({ 

          
    "destroy":true,  
   


        
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
        orientation: 'landscape'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger',
        orientation: 'landscape'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        className: 'btn btn-info',
        orientation: 'landscape'
      },
    ]         
    });



function imprimirPre(){


    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("QUE COLUMNAS SE IMPRIMEN");            
    $("#modal_Pregunta").modal("show"); 

}


function imprimirFinal(){


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


     dni= $("#dni").val();
     name= $("#name").val();  
     domicilio= $("#domicilio").val();  
     email= $("#email").val();  
     telefono= $("#telefono").val();  
     titulo1= $("#titulo1").val();  
     hijos= $("#hijos").val();
     situacion= $("#situacion").val();

     nombreMateria= $("#nombreMateria").val(); 
     situacionRevista= $("#situacionRevista").val(); 
     desdeHasta= $("#desdeHasta").val();                                               
                       
$("#modal_Pregunta").modal("hide"); 

console.log({dni:dni, domicilio:domicilio, email:email, telefono:telefono, titulo1:titulo1, hijos:hijos, situacion:situacion, nombreMateria:nombreMateria, situacionRevista:situacionRevista, desdeHasta:desdeHasta});
    $.ajax({
          type:"post",
          data:{dni:dni, domicilio:domicilio, email:email, telefono:telefono, titulo1:titulo1, hijos:hijos, situacion:situacion, nombreMateria:nombreMateria, situacionRevista:situacionRevista, desdeHasta:desdeHasta},
          url:'modulos/planillas/elementos/sessionImpr.php',
          success:function(r){ 

                 $.unblockUI();
                window.open('modulos/planillas/planillaDocente.php', '_blank'); 


            }
        });

}




 $.unblockUI();
</script>

