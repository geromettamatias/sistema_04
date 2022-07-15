
 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();



$cicloF=$_SESSION['cicloLectivo'];
$id_titulo=$_SESSION['id_titulo'];


$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 
$tituloGenera='';



$operacion=$_SESSION["operacion"];


$consulta = "SELECT `id_titulo`, `tituloGenera` FROM `confi_informe_titulo_2_$cicloLectivo` WHERE `id_titulo`='$id_titulo'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 foreach($data as $dat) {
        
     $tituloGenera=$dat['tituloGenera'];
}



$consulta = "SELECT `id_informe`, `tipo`, `titulo`, `pregunta`, `aclaracion`, `respuestas_posible`, `modalidad`, `id_titologeneral` FROM `confi_informe_2_$cicloLectivo` WHERE `id_titologeneral`='$id_titulo'";
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
            <div class="card card-danger">
              
              <div class="card-header">
                <h3 class="card-title">Pregunta: <?php echo $tituloGenera; ?></h3>
            

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
                  

                



<button class="btn btn-success" title="Regresar" onclick="redire()"><i class="fas fa-long-arrow-alt-left"></i></button>

<?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>



<button class="btn btn-info" title="NUEVO PREGUNTA" onclick="Agregar()"><i class='fas fa-edit'></i></button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>

<?php  } ?> 



<hr>
<div class="table-responsive-lg">
    <table id="tabla_Pregunta" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>N°</th>
             <th>MODALIDAD</th>
             <th>TIPO</th>
             <th>TITULO</th>
             <th>PREGUNTA</th>
             <th>ACLARACIÁN</th>
             <th>RESPUESTAS</th>
            
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>


            <td><?php echo $dat['id_informe'] ?></td>
            <td><?php echo $dat['modalidad'] ?></td>
            <td><?php echo $dat['tipo'] ?></td>
            <td><?php echo $dat['titulo'] ?></td>
            <td><?php echo $dat['pregunta'] ?></td>
            <td><?php echo $dat['aclaracion'] ?></td>
            <td><?php echo $dat['respuestas_posible'] ?></td>
   
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
             <th>N°</th>
             <th>MODALIDAD</th>
             <th>TIPO</th>
             <th>TITULO</th>
             <th>PREGUNTA</th>
             <th>ACLARACIÁN</th>
             <th>RESPUESTAS</th>
            
        </tr>
    </tfoot>
</table>

</div>





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



<div class="modal fade" id="modalCRUD_Pregunta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <input type="text" class="form-control" id="id" hidden=''>
                <input type="text" class="form-control" id="opcion" hidden=''>

                <div class="form-group">
                <label for="modalidad" class="col-form-label">Modalidad:</label>

                <select id="modalidad" class="form-select" multiple aria-label="multiple select example" multiple data-live-search="true">
                    
                  <option>1°1°PC</option>
                  <option>1°2°PC</option>
                  <option>1°3°PC</option>
                  <option>1°4°PC</option>
                  <option>1°5°PC</option>

                  <option>2°1°PC</option>
                  <option>2°2°PC</option>
                  <option>2°3°PC</option>
                  <option>2°4°PC</option>

                  <option>1°1°SC</option>
                  <option>1°2°SC</option>
                  <option>1°3°SC</option>

                  <option>2°1°SC</option>
                  <option>2°2°SC</option>

                  <option>3°1°SC</option>
                  <option>3°2°SC</option>

                  <option>4°1°SC</option>
                  <option>TODOS</option>

                  </select>
                </div>

                
                <div class="form-group">
                <label for="tipol" class="col-form-label">TIPO:</label>
                <select class="form-control" id="tipol">
                    <option>Pregunta Abierta</option>
                    <option>Multiple Choice (Una respuesta)</option>
                    <option>Multiple Choice (Multiple respuesta)</option>
                </select>
                </div>
                <div class="form-group">
                <label for="titulof" class="col-form-label">TITULO:</label>
                <input type="text" class="form-control" id="titulof">
                </div>

                <div class="form-group">
                <label for="pregunta" class="col-form-label">PREGUNTA:</label>
                <input type="text" class="form-control" id="pregunta">
                </div>
                <div class="form-group">
                <label for="aclaracion" class="col-form-label">ACLARACIÓN:</label>
                <input type="text" class="form-control" id="aclaracion">
                </div>

                <div class="form-group">
                <label for="respuesta" class="col-form-label">RESPUESTAS lo separa '||' (solo si es Multiple Choice)</label>
                <input type="text" class="form-control" id="respuesta">
                </div>

               
           
                

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="agregar_editar ()"> <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>



<?php } ?>






   
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();


    var myTable = $('#tabla_Pregunta').DataTable({
        "destroy":true,
         "pageLength" : 2,    
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


<?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>




var selector=0;
var dataFila=[];
var preguntar=0;

//  selecciono particular o grupal, agrego en un array 

$('#tabla_Pregunta tbody').on('click', 'tr', function () {



            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                preguntar=0;
            }else{
                myTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                preguntar=1;
            }
   
            dataFila = myTable.row( this ).data();

console.log(myTable.rows( '.selected' )[0][0]);

} );


function editarEliminar(){


    if (preguntar==1) {

  Swal.fire({
          title: 'QUE DESEA HACER CON ESTA PREGUNTA?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'EDITAR',
          denyButtonText: `ELIMINAR`,
        }).then((result) => {
          
          if (result.isConfirmed) {

                editar_FINAL();


          } else if (result.isDenied) {

                eliminar_FINAL();
          }
        })


    }else{

        toastr.warning('No selecciono ninguno');

    }

}



function editar_FINAL () {

    $("#formPersonasUsuario").trigger("reset");
 
    console.log(dataFila);
    $("#id").val(dataFila[0]);
    $("#opcion").val(2);

 

    modalidad = dataFila[1].split(','); 

    $("#modalidad").val(modalidad);
    $("#tipol").val(dataFila[2]);
    $("#titulof").val(dataFila[3]);
    $("#pregunta").val(dataFila[4]);
    $("#aclaracion").val(dataFila[5]);
    $("#respuesta").val(dataFila[6]);
   
    
    

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos de la Pregunta");            
    $("#modalCRUD_Pregunta").modal("show");  


}


function remover () {

    $('#cicloLectivo').val('Seleccione un año lectivo');
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}




function eliminar_FINAL(){


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
   

     dataFila.push(3);



        $.ajax({
            url: "modulos/herramientas/conf_informe_2_hoja/elementos/crud_pregunta.php",
            type: "POST",
            data: {dataFila:dataFila},
            success: function(r){
                console.log(r);
            
                if (r==1) {
                    myTable.rows('.selected').remove().draw();
                    toastr.info('Excelente !!');
                    $.unblockUI(); 
                }else{
                     toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                }
               
            }
        });

        
     

}






function Agregar () {

    $("#formPersonasUsuario").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar una nueva pregunta"); 
    $("#id").val(null);
    $("#opcion").val(1);
    $("#modalCRUD_Pregunta").modal("show"); 



}





function agregar_editar () {
            

           $("#modalCRUD_Pregunta").modal("hide"); 
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


    modalidad= $("#modalidad").val();
    modalidad=modalidad.toString();
    tipol= $("#tipol").val();
    id= $("#id").val();
    opcion= $("#opcion").val();

    titulof= $("#titulof").val();
    aclaracion= $("#aclaracion").val();

    pregunta= $("#pregunta").val();
    respuesta= $("#respuesta").val();

    dataFila=[];
    dataFila.push(id);
    dataFila.push(modalidad);
    dataFila.push(tipol);
    dataFila.push(titulof);
    dataFila.push(pregunta);
    dataFila.push(aclaracion);
    dataFila.push(respuesta);
    dataFila.push(opcion);


console.log(dataFila);
    
    $.ajax({
        url: "modulos/herramientas/conf_informe_2_hoja/elementos/crud_pregunta.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
            console.log(data);
            id_informe = data[0].id_informe;
            modalidad = data[0].modalidad;            
            tipo = data[0].tipo;
            titulo = data[0].titulo;
            pregunta = data[0].pregunta;
            aclaracion = data[0].aclaracion;
            respuestas_posible = data[0].respuestas_posible;
          
                dataFila=[];
                dataFila.push(id_informe);
                dataFila.push(modalidad);
                dataFila.push(tipo);
                dataFila.push(titulo);
                dataFila.push(pregunta);
                dataFila.push(aclaracion);
                dataFila.push(respuestas_posible);
            

            if (opcion==1) {
                myTable.row.add([id_informe,modalidad,tipo,titulo,pregunta,aclaracion,respuestas_posible]).draw();

              


            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([id_informe,modalidad,tipo,titulo,pregunta,aclaracion,respuestas_posible]);

               

            }

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}
<?php } ?>



function redire(){


 $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('modulos/herramientas/conf_informe_2_hoja/tituloGenerales.php');
              $('#contenidoAyuda').html(''); 
            

              $('#imagenProceso').hide();
}
 

</script>



