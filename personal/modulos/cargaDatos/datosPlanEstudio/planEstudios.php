<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();

        $operacion=$_SESSION["operacion"];



        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
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
                <h3 class="card-title">Carga de Plan de Estudio</h3>

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

                <?php if ($operacion=='Lectura y Escritura'){ ?>

                <button id="btnNuevo_Plan" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo Ciclo Lectivo"><i class='fas fa-edit'></i></button><br> <hr>    


  <?php } ?>




                                          <table id="tablaPlan" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°Plan</th>
                                <th>N°Inst</th>
                                <th>Orientación (Nombre)</th>
                                <th>N° Resolución</th> 

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
                                <td><?php echo $dat['idPlan'] ?></td>
                                <td><?php echo $dat['idInstitucion'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['numero'] ?></td>
                           
                                    
                                    
                                </td>
           
                                 <?php if ($operacion=='Lectura y Escritura'){ ?>
                                <td></td>
                                <?php
                                }
                            ?>   
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


<div class="modal fade" id="modalCRUD_Plan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  <form id="formPersonasPlan">    
                         
                <div class="modal-body">
                <div id="seleInstituto"></div>    
                         
           

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


    $('#seleInstituto').load('modulos/cargaDatos/datosPlanEstudio/elementos/selecInstitucion.php');

    var tablaPlan = $('#tablaPlan').DataTable({ 

    "destroy":true,    
    <?php if ($operacion=='Lectura y Escritura'){ ?>
        
    "columnDefs":[{
        "targets": -1,
        "data":null,

         

        "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item btnEditar_Plan" href="javascript:void(0)">Editar</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item btnBorrar_Plan" href="javascript:void(0)">Eliminar</a></li>
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

  <?php if ($operacion=='Lectura y Escritura'){ ?>


$("#btnNuevo_Plan").click(function(){

    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo plan de estudio");            
    $("#modalCRUD_Plan").modal("show"); 

    idPlan=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Plan", function(){
    fila = $(this).closest("tr");

 
    idPlan = parseInt(fila.find('td:eq(0)').text());
    institucionPlan = fila.find('td:eq(1)').text();
    nombrePlan = fila.find('td:eq(2)').text();
    numeroPlan = fila.find('td:eq(3)').text();
    

    
    $("#institucionPlan").val(institucionPlan);
    $("#nombrePlan").val(nombrePlan);
    $("#numeroPlan").val(numeroPlan);


    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar plan de estudio");            
    $("#modalCRUD_Plan").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Plan", function(){    
    fila = $(this);
    idPlan = parseInt($(this).closest("tr").find('td:eq(0)').text());


    nombrePlan = $(this).closest("tr").find('td:eq(1)').text();

    opcion = 3 ;//borrar

    eliminarAntesPlan(idPlan,nombrePlan,opcion);
  
});
    







function eliminarAntesPlan(idPlan,nombrePlan,opcion) {

  

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

    eliminarDefinitivoPlan(idPlan,nombrePlan,opcion);
  }
})



      
     
}


function  eliminarDefinitivoPlan(idPlan,nombrePlan,opcion){


    var respuesta = confirm("¿Está seguro de eliminar el Plan de estudio: "+nombrePlan+"?");
    if(respuesta){
        
        $.ajax({
            url: "modulos/cargaDatos/datosPlanEstudio/elementos/crud_datos_Plan.php",
            type: "POST",
            dataType: "json",
             beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnNuevo_Plan").disabled = true;
                                $(".btnGroupDrop1").attr("disabled", true);
                                $('#cargaCiclo').show();
                              },
            data: {opcion:opcion, idPlan:idPlan},
            success: function(){
            
               
            }
        });

        tablaPlan.row(fila.parents('tr')).remove().draw();
        $("#imagenProceso").hide();
                                document.getElementById("btnNuevo_Plan").disabled = false;
                                $(".btnGroupDrop1").attr("disabled", false);
                                $('#cargaCiclo').hide();


    } 
}





$("#formPersonasPlan").submit(function(e){
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
 
    institucionPlan = $.trim($("#institucionPlan").val());
    nombrePlan = $.trim($("#nombrePlan").val());
    numeroPlan = $.trim($("#numeroPlan").val());   
    console.log({institucionPlan:institucionPlan, nombrePlan:nombrePlan, numeroPlan:numeroPlan, opcion:opcion, idPlan:idPlan});
    $.ajax({
        url: "modulos/cargaDatos/datosPlanEstudio/elementos/crud_datos_Plan.php",
        type: "POST",
        dataType: "json",
         beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnNuevo_Plan").disabled = true;
                                $(".btnGroupDrop1").attr("disabled", true);
                                $('#cargaCiclo').show();
                              },
        data: {institucionPlan:institucionPlan, nombrePlan:nombrePlan, numeroPlan:numeroPlan, opcion:opcion, idPlan:idPlan},
        success: function(data){  
            console.log(data);
            idPlan = data[0].idPlan;            
            institucionPlan = data[0].idInstitucion;
            nombrePlan = data[0].nombre;
            numeroPlan = data[0].numero;
            
            if(opcion == 1){tablaPlan.row.add([idPlan,institucionPlan,nombrePlan,numeroPlan]).draw();}
            else{tablaPlan.row(fila).data([idPlan,institucionPlan,nombrePlan,numeroPlan]).draw();}

             $("#imagenProceso").hide();
                                document.getElementById("btnNuevo_Plan").disabled = false;
                                $(".btnGroupDrop1").attr("disabled", false);
                                $('#cargaCiclo').hide();
            
        }        
    });
    $("#modalCRUD_Plan").modal("hide");   
     $.unblockUI(); 
    
});    
    

  <?php } ?>

    
});



 $.unblockUI();
</script>