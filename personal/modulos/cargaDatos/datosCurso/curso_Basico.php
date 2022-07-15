
<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$operacion=$_SESSION["operacion"];



if ((isset($_SESSION['cursoSeleB'])) && (isset($_SESSION['cicloLectivo']))){


$cursoSeleB=$_SESSION['cursoSeleB'];

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 









$consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `ciclo`='$cursoSeleB' AND `idPlan`='básico'";
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
                <h3 class="card-title">Tabla de Cursos del Básico</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            

                <div id="cargaCicloTres"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

                     <?php if ($operacion=='Lectura y Escritura'){ ?>



            <?php if ($edicion=='SI'){ ?>
                <button id="btnNuevo_Cursos" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo Ciclo Lectivo"><i class='fas fa-edit'></i></button><br> <hr>    

<?php } ?>

<?php } ?>

                 <table id="tablaCursos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°Curso</th> 
                                <th>N°Plan</th>
                                <th>Ciclo</th> 
                                <th>Nombre</th>  
                                <th>Horarios</th>  

                                  <?php if ($operacion=='Lectura y Escritura'){ ?>
                     
                                <th>Acciones</th>

                                  <?php
                                }
                            ?> 
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
                              
                                <td><?php echo $dat['idCurso'] ?></td>
                                <td><?php echo $dat['idPlan'] ?></td>
                                <td><?php echo $dat['ciclo'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td> 
                    
                                <td>
                                    <button  class="btn btn-danger glyphicon glyphicon-pencil" onclick="horarios(<?php echo $dat['idCurso'] ?>)">Horarios</button>

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





<div class="modal fade" id="modalCRUD_Cursos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="formPersonasCursos">    
                         
            <div class="modal-body">
                

                <div class="form-group">
                <label for="cursosNombre" class="col-form-label">Normbre Curso:</label>
                <input type="text" class="form-control" id="cursosNombre">
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
  $('#imagenProceso').hide();
      $('#cargaCiclo').hide();
    function horarios(idCurso){


          $.ajax({
            url: "modulos/cargaDatos/datosCurso/seccion-parte.php",
            type: "POST",
          
            data: {idCurso:idCurso},
            success: function(data){


            $('#imagenProceso').show();
            
            $('#tablaInstitucional').load('modulos/cargaDatos/datosCurso/parte-asignatura.php');
           $('#imagenProceso').hide();
            }
        });




        
    }

$(document).ready(function(){
 $('#imagenProceso').hide();
      $('#cargaCicloTres').hide();


    var tablaCursos = $('#tablaCursos').DataTable({ 

    "destroy":true,
    "pageLength" : 2, 

       <?php if ($operacion=='Lectura y Escritura'){ ?>

 
    "columnDefs":[{
        "targets": -1,
        "data":null,

          

        "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item btnEditar_Cursos" href="javascript:void(0)">Editar</a></li>
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


<?php if ($operacion=='Lectura y Escritura'){ ?>



$("#btnNuevo_Cursos").click(function(){

    $("#formPersonasCursos").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Curso");            
    $("#modalCRUD_Cursos").modal("show"); 

    idCurso=null;
    opcion = 1; //alta
}); 



$(document).on("click", ".btn_diasFechas", function(e){
    e.preventDefault();

    fila = $(this).closest("tr");

 
    idCurso = parseInt(fila.find('td:eq(0)').text());
    idPlan = fila.find('td:eq(1)').text();
    ciclo = fila.find('td:eq(2)').text();
    nombre = fila.find('td:eq(3)').text();


    FechaDia(idCurso,idPlan,ciclo,nombre); 
    
});




var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Cursos", function(){
    fila = $(this).closest("tr");

 
    idCurso = parseInt(fila.find('td:eq(0)').text());
    idPlan = fila.find('td:eq(1)').text();
    ciclo = fila.find('td:eq(2)').text();
    nombre = fila.find('td:eq(3)').text();

    
    $("#cursosNombre").val(nombre);



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar nombre del Curso");            
    $("#modalCRUD_Cursos").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Asignnatura", function(){    
    fila = $(this);
    idCurso = parseInt($(this).closest("tr").find('td:eq(0)').text());

    console.log(fila);
    nombre = $(this).closest("tr").find('td:eq(3)').text();

    opcion = 3 ;//borrar

    eliminarAntesPlanCurso(idCurso,nombre,opcion);
  
});
    




function eliminarAntesPlanCurso(idCurso,nombre,opcion) {

  

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

    eliminarAntesPlanCursoFinal(idCurso,nombre,opcion);
  }
})



      
     
}


function  eliminarAntesPlanCursoFinal(idCurso,nombre,opcion){


   
        
        $.ajax({
            url: "modulos/cargaDatos/datosCurso/elementos/crud_datos_Plan_Cursos.php",
            type: "POST",
            dataType: "json",
              beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnNuevo_Cursos").disabled = true;
                                $(".btnGroupDrop1").attr("disabled", true);
                                $('#cargaCicloTres').show();
                              },

            data: {opcion:opcion, idCurso:idCurso},
            success: function(){
            
               
            }
        });

        tablaCursos.row(fila.parents('tr')).remove().draw();
        $("#imagenProceso").hide();
                                document.getElementById("btnNuevo_Cursos").disabled = false;
                                $(".btnGroupDrop1").attr("disabled", false);
                                $('#cargaCicloTres').hide();

}




$("#formPersonasCursos").submit(function(e){
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
    nombre = $.trim($("#cursosNombre").val());
    ciclo = $.trim($("#cursoSeleB").val());
    

    console.log({idPlan:idPlan, nombre:nombre,  opcion:opcion, idCurso:idCurso, ciclo:ciclo});
    $.ajax({
        url: "modulos/cargaDatos/datosCurso/elementos/crud_datos_Plan_Cursos.php",
        type: "POST",
        dataType: "json",
        beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnNuevo_Cursos").disabled = true;
                                $(".btnGroupDrop1").attr("disabled", true);
                                $('#cargaCicloTres').show();
                              },
        data: {idPlan:idPlan, nombre:nombre,  opcion:opcion, idCurso:idCurso, ciclo:ciclo},
        success: function(data){  
            console.log(data);
            idCurso = data[0].idCurso;            
            idPlan = data[0].idPlan;
            nombre = data[0].nombre;
            ciclo = data[0].ciclo;

            boton=' <button  class="btn btn-danger glyphicon glyphicon-pencil" onclick="horarios('+idCurso+')">Horarios</button>';
       
            
            if(opcion == 1){tablaCursos.row.add([idCurso,idPlan,ciclo,nombre,boton]).draw();}
            else{tablaCursos.row(fila).data([idCurso,idPlan,ciclo,nombre,boton]).draw();} 

            $("#imagenProceso").hide();
                                document.getElementById("btnNuevo_Cursos").disabled = false;
                                $(".btnGroupDrop1").attr("disabled", false);
                                $('#cargaCicloTres').hide();           
        }        
    });
    $("#modalCRUD_Cursos").modal("hide");    


 $.unblockUI();
    
});    
    

<?php } ?>


    
});


function remover () {

    $('#cursoSeleB').val('Seleccione ciclo');
    $('#cicloLectivo').val('Seleccione un año lectivo');

    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  




}





 $.unblockUI();
</script>


<?php  } ?>







