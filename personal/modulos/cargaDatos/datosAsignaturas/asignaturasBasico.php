
 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$operacion=$_SESSION["operacion"];



 
$consulta = "SELECT `idAsig`, `idPlan`, `nombre`, `ciclo`, `cantidadHoraCatedra` FROM `plan_datos_asignaturas` WHERE `idPlan`='básico'";
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
                <h3 class="card-title">Gestión-Usuarios Adminstrador del sitio (solo Administrador)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  
                           
                <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

                <button id="btn_regresar_asignatura" type="button" class="btn btn-info" data-toggle="modal"><i class='fas fa-reply-all'></i> Regresar</button>
                      <h1>Tabla de Asignatura del Básico</h1>
                     <p><b>Aclaración:</b>Las asignatura del correspondiente a 1ro y 2do corresponde a todos los Planes de estudios registrados...</p>

                   <?php if ($operacion=='Lectura y Escritura'){ ?>


                <button id="btnNuevo_Asignatura" type="button" class="btn btn-success" data-toggle="modal"><i class='fas fa-edit'></i></button><br> <hr>

                <?php } ?>


                   <table id="tablaAsignnatura" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°Asi</th> 
                                <th>N°Plan</th>
                                <th>Ciclo</th> 
                                <th>Nombre</th>
                                <th>H-C</th> 

                                 <?php if ($operacion=='Lectura y Escritura'){ ?>

                        
                                <th>Acciones</th>

                                <?php } ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                            
                            $colorFinal='';

                            $contadorColores=0;
                                                     
                            foreach($data as $dat) {
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
                                
                                <td><?php echo $dat['idAsig']; ?></td>
                                <td><?php echo $dat['idPlan']; ?></td>
                                <td><?php echo $dat['ciclo']; ?></td>
                                <td><?php echo $dat['nombre']; ?></td>

                                <td><?php echo $dat['cantidadHoraCatedra']; ?></td>  
                 
             <?php if ($operacion=='Lectura y Escritura'){ ?>

                        
                                <td></td>

                                <?php } ?>

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





  <?php if ($operacion=='Lectura y Escritura'){ ?>





<div class="modal fade" id="modalCRUD_Asignatura" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
   <form id="formPersonasPlanAsignatura">    
                         
            <div class="modal-body">
               

                <div class="form-group">
                <label for="ciclosss" class="col-form-label">Corresponde al:</label>
                <select class="form-control" id="ciclosss">
                <option>1° AÑO (1° AÑO P.C.)</option>
                <option>2° AÑO (2° AÑO P.C.)</option>
               
                </select>
                </div> 


                <div class="form-group">
                <label for="cue" class="col-form-label">Asignatura:</label>
                <input type="text" class="form-control" id="asigantura">
                </div> 
                <div class="form-group">
                <label for="cue" class="col-form-label">Cantidad Hora Catedra:</label>
                <input type="number" class="form-control" id="horaCatedra">
                </div>               
               

            </div>    
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark"> <i class='fas fa-save'></i> Guardar</button>
            </div>
        </form> 
    </div>
  </div>
</div>

 
<?php } ?>


 <script type="text/javascript">
$(document).ready(function(){

    $('#imagenProceso').hide();
      $('#cargaCiclo').hide();

    var tablaAsignnatura = $('#tablaAsignnatura').DataTable({ 

    "destroy":true,

       <?php if ($operacion=='Lectura y Escritura'){ ?>


    "columnDefs":[{
        "targets": -1,
        "data":null,
               "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item btnEditar_Asignnatura" href="javascript:void(0)">Editar</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item btnBorrar_Asignnatura" href="javascript:void(0)">Eliminar</a></li>
                                    </ul>
                                  </div>
                                </div>`,  



       }],

        <?php } ?>
        
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



 $("#btn_regresar_asignatura").click(function(){
        $('#imagenProceso').show();
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
       
        $('#tablaInstitucional').load('modulos/cargaDatos/datosAsignaturas/asignaturas_Selec.php');

        $('#imagenProceso').hide(); 
});


                    <?php if ($operacion=='Lectura y Escritura'){ ?>

$("#btnNuevo_Asignatura").click(function(){

    $("#formPersonasPlanAsignatura").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Asignatura");            
    $("#modalCRUD_Asignatura").modal("show"); 

  
    idAsig=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    







$(document).on("click", ".btnEditar_Asignnatura", function(){
    fila = $(this).closest("tr");

 
    idAsig = parseInt(fila.find('td:eq(0)').text());
    idPlan = fila.find('td:eq(1)').text();
    ciclo = fila.find('td:eq(2)').text();
    nombre = fila.find('td:eq(3)').text();
    horaCatedra = fila.find('td:eq(4)').text();

    

    $("#idPlanAsignatura").val(idPlan);
    $("#ciclosss").val(ciclo);
    $("#asigantura").val(nombre);
    $("#horaCatedra").val(horaCatedra);



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar nombre de la Asignatura");            
    $("#modalCRUD_Asignatura").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Asignnatura", function(){    
    fila = $(this);
    idAsig = parseInt($(this).closest("tr").find('td:eq(0)').text());


    nombre = $(this).closest("tr").find('td:eq(3)').text();

    opcion = 3 ;//borrar

    eliminarAntesPlanAsignatura(idAsig,nombre,opcion);
  
});
    




function eliminarAntesPlanAsignatura(idAsig,nombre,opcion) {

  

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
    Swal.fire(
      'Deleted!',
      'Operación éxitosa',
      'success'
    )

    eliminarAntesPlanAsignaturaFinal(idAsig,nombre,opcion);
  }
})



      
     
}


function  eliminarAntesPlanAsignaturaFinal(idAsig,nombre,opcion){


    var respuesta = confirm("¿Está seguro de eliminar la asignatura: "+nombre+"?");
    if(respuesta){
        
        $.ajax({
            url: "modulos/cargaDatos/datosAsignaturas/elementos/crud_datos_Plan_Asignaturas.php",
            type: "POST",
            dataType: "json",
            beforeSend: function() {

                                $("#imagenProceso").show();
                                document.getElementById("btn_regresar_asignatura").disabled = true;
                                document.getElementById("btnNuevo_Asignatura").disabled = true;
                                $(".btnGroupDrop1").attr("disabled", true);
                                $('#cargaCiclo').show();
                              },
            data: {opcion:opcion, idAsig:idAsig},
            success: function(){
            
               
            }
        });

        tablaAsignnatura.row(fila.parents('tr')).remove().draw();
        $("#imagenProceso").hide();
                                document.getElementById("btn_regresar_asignatura").disabled = false;
                                document.getElementById("btnNuevo_Asignatura").disabled = false;
                                $(".btnGroupDrop1").attr("disabled", false);
                                $('#cargaCiclo').hide();

    } 
}




$("#formPersonasPlanAsignatura").submit(function(e){
    e.preventDefault();    

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
 
    idPlan = 'básico';
    nombre = $.trim($("#asigantura").val());
    ciclo = $.trim($("#ciclosss").val());
    horaCatedra = $.trim($("#horaCatedra").val());
    


    console.log({idPlan:idPlan, nombre:nombre,  opcion:opcion, idAsig:idAsig, ciclo:ciclo, horaCatedra:horaCatedra});
    $.ajax({
        url: "modulos/cargaDatos/datosAsignaturas/elementos/crud_datos_Plan_Asignaturas.php",
        type: "POST",
        dataType: "json",
        beforeSend: function() {

                                $("#imagenProceso").show();
                                document.getElementById("btn_regresar_asignatura").disabled = true;
                                document.getElementById("btnNuevo_Asignatura").disabled = true;
                                $(".btnGroupDrop1").attr("disabled", true);
                                $('#cargaCiclo').show();
                              },
        data: {idPlan:idPlan, nombre:nombre,  opcion:opcion, idAsig:idAsig, ciclo:ciclo, horaCatedra:horaCatedra},
        success: function(data){  
            console.log(data);
            idAsig = data[0].idAsig;            
            idPlan = data[0].idPlan;
            nombre = data[0].nombre;
            ciclo = data[0].ciclo;
            cantidadHoraCatedra = data[0].cantidadHoraCatedra;
       
            

            if(opcion == 1){tablaAsignnatura.row.add([idAsig,idPlan,ciclo,nombre,cantidadHoraCatedra]).draw();}
            else{tablaAsignnatura.row(fila).data([idAsig,idPlan,ciclo,nombre,cantidadHoraCatedra]).draw();}


            $("#imagenProceso").hide();
                                document.getElementById("btn_regresar_asignatura").disabled = false;
                                document.getElementById("btnNuevo_Asignatura").disabled = false;
                                $(".btnGroupDrop1").attr("disabled", false);
                                $('#cargaCiclo').hide();
            
        }        
    });
    $("#modalCRUD_Asignatura").modal("hide");    

     $.unblockUI();
    
});    
    

<?php } ?>

    
});


   $.unblockUI();
</script>


