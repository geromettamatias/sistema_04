<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


$operacion=$_SESSION["operacion"];


$consulta = "SELECT `id_titulo`, `tituloGenera` FROM `confi_informe_titulo_2_$cicloLectivo`";
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
                <h3 class="card-title">Lista Titulos Generales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button  onclick="remover()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            

<?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>

<button class="btn btn-info" title="NUEVO USUARIO" onclick="Agregar()"><i class='fas fa-text-width'></i></button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>




<button class="btn btn-warning" title="Configurar Primer Hoja del Informe" onclick="primerInfor()"><i class="fas fa-reply"></i></button>

<?php } ?>

<hr>
    <table id="tabla_Administradores" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>TITULO GENERAL</th>
            <th>CARGAR</th>
            
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>

            <td><?php echo $dat['id_titulo'] ?></td>
            <td><?php echo $dat['tituloGenera'] ?></td>
            <td><button class="btn btn-success" title="CargarPregunta" onclick="cargarPregunta(<?php echo $dat['id_titulo'] ?>)"><i class="fas fa-cog fa-spin"></i></button></td>






        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>

             <th>ID</th>
             <th>TITULO GENERAL</th>
             <th>CARGAR</th>
            
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


<div class="modal fade" id="modalCRUD_Usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <input type="text" class="form-control" id="id" hidden='' >
                <input type="text" class="form-control" id="opcion" hidden=''>
                
                <div class="form-group">
                <label for="tituloGenera" class="col-form-label">TITULO GENERAL:</label>
                <input type="text" class="form-control" id="tituloGenera">
                </div>
                
                <div class="form-group">
                 <div id="seleccionPregunta"></div>
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


    var myTable = $('#tabla_Administradores').DataTable({
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

$('#tabla_Administradores tbody').on('click', 'tr', function () {



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
          title: 'QUE DESEA HACER CON EL USUARIO?',
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


    $("#id").val(dataFila[0]);
    $("#tituloGenera").val(dataFila[1]);
    $("#opcion").val(2);
    

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Usuario");            
    $("#modalCRUD_Usuario").modal("show");  


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
   



    id=dataFila[0];
    tituloGenera=dataFila[1];
    opcion=3;

    dataFila=[];
    dataFila.push(id);
    dataFila.push(tituloGenera);
    dataFila.push(opcion);


        
        $.ajax({
            url: "modulos/herramientas/conf_informe_2_hoja/elementos/crud_titulos.php",
            type: "POST",
            data: {dataFila:dataFila},
            success: function(r){
               
                if (r==1) {
                    myTable.rows('.selected').remove().draw();
                    toastr.info('Excelente !!');
                     dataFila=[];
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
    $(".modal-title").text("Ingresar datos del Usuario"); 
    $("#id").val(null);
    $("#opcion").val(1);
    $("#modalCRUD_Usuario").modal("show"); 



}


function remover () {

    $('#cicloLectivo').val('Seleccione un año lectivo');
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}











function primerInfor(){

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


  
        $('#tablaInstitucional').load('modulos/herramientas/conf_informe/tituloGenerales.php');


}









function agregar_editar () {
            

           $("#modalCRUD_Usuario").modal("hide"); 
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


    tituloGenera= $("#tituloGenera").val();
    id= $("#id").val();
    opcion= $("#opcion").val();

    dataFila=[];
    dataFila.push(id);
    dataFila.push(tituloGenera);
    dataFila.push(opcion);


    console.log(dataFila)

    $.ajax({
        url: "modulos/herramientas/conf_informe_2_hoja/elementos/crud_titulos.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
            console.log(data);
            id_titulo = data[0].id_titulo;            
            tituloGenera = data[0].tituloGenera;
              

                    ataFila=[];
                    dataFila.push(id_titulo);
                    dataFila.push(tituloGenera);

                    boton='<button class="btn btn-success" title="CargarPregunta" onclick="cargarPregunta('+id_titulo+')"><i class="fas fa-cog fa-spin"></i></button>';
                  



            if (opcion==1) {
                myTable.row.add([id_titulo,tituloGenera,boton]).draw();
            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([id_titulo,tituloGenera,boton]);

            }

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}

<?php } ?>

function cargarPregunta(id_titulo){


 

                   $.ajax({
            url: "modulos/herramientas/conf_informe_2_hoja/elementos/sessionFinal.php",
            type: "POST",
            data: {id_titulo:id_titulo},
            success: function(r){
            
                if (r==1) {
                    

                    $('#tablaInstitucional').html(''); 
                       $('#tablaInstitucional').load('modulos/herramientas/conf_informe_2_hoja/conf_informe.php');
                      $('#contenidoAyuda').html(''); 
                    

                      $('#imagenProceso').hide();



                    toastr.info('Excelente !!');
                    $.unblockUI(); 
                }else{
                     toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                }
               
            }
        });
}
 

</script>



