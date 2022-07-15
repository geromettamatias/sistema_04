<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$operacion=$_SESSION["operacion"];


$consulta = "SELECT `id_correoSer`, `correo`, `pass`, `app`, `pass_app`, `host`, `port` FROM `correoservidor`";
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
                <h3 class="card-title">LISTA DE USUARIOS ADMINISTRADORES DEL SITIO</h3>

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
                  
        <?php if ($operacion=='Lectura y Escritura'){ ?>


                <button class="btn btn-info" title="NUEVO USUARIO" onclick="Agregar()"><i class='fas fa-user-plus'></i></button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>
<?php } ?>


<hr>
    <table id="tabla_correoSer" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>N°</th>
             <th>correo</th>
             <th>Contraseña</th>
             <th>app</th>
             <th>Contraseña app</th>
             <th>host</th>
             <th>port</th>
                
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>

            <td><?php echo $dat['id_correoSer'] ?></td>
            <td><?php echo $dat['correo'] ?></td>
            <td><?php echo base64_decode ($dat['pass']); ?></td>
            <td><?php echo $dat['app'] ?></td>
            <td><?php echo base64_decode ($dat['pass_app']); ?></td>
            <td><?php echo $dat['host'] ?></td>
            <td><?php echo $dat['port'] ?></td>


          
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
             <th>N°</th>
             <th>correo</th>
             <th>Contraseña</th>
             <th>app</th>
             <th>Contraseña app</th>
             <th>host</th>
             <th>port</th>
                
            
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







        <?php if ($operacion=='Lectura y Escritura'){ ?>



<div class="modal fade" id="modalCRUD_CorreoApp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <input type="text" class="form-control" id="id_correoSer" hidden='' >
                <input type="text" class="form-control" id="opcion" hidden=''>
                
                <div class="form-group">
                <label for="correo" class="col-form-label">correo:</label>
                <input type="text" class="form-control" id="correo">
                </div>
                <div class="form-group">
                <label for="pass" class="col-form-label">Pass:</label>
                <input type="text" class="form-control" id="pass">
                </div>
                <div class="form-group">
                <label for="app" class="col-form-label">App:</label>
                <input type="text" class="form-control" id="app">
                </div>
                <div class="form-group">
                <label for="pass_app" class="col-form-label">Pass_app:</label>
                <input type="text" class="form-control" id="pass_app">
                </div>

                 <div class="form-group">
                <label for="host" class="col-form-label">Host:</label>
                <input type="text" class="form-control" id="host">
                </div>

                 <div class="form-group">
                <label for="port" class="col-form-label">Port:</label>
                <input type="text" class="form-control" id="port">
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


    var myTable = $('#tabla_correoSer').DataTable({
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


         <?php if ($operacion=='Lectura y Escritura'){ ?>


var selector=0;
var dataFila=[];
var preguntar=0;

//  selecciono particular o grupal, agrego en un array 

$('#tabla_correoSer tbody').on('click', 'tr', function () {



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
          title: 'QUE DESEA HACER CON EL NUEVO CORREO?',
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


function remover () {

    
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}





function editar_FINAL () {

    $("#formPersonasUsuario").trigger("reset");
 

    $("#id_correoSer").val(dataFila[0]);
    $("#correo").val(dataFila[1]);
    $("#pass").val(dataFila[2]);
    $("#app").val(dataFila[3]);
    $("#pass_app").val(dataFila[4]);
    $("#host").val(dataFila[5]);
    $("#port").val(dataFila[6]);



    $("#opcion").val(2);
    

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Usuario");            
    $("#modalCRUD_CorreoApp").modal("show");  


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
            url: "modulos/cargaDatos/correosSer/elementos/crub_correosSe.php",
            type: "POST",
            data: {dataFila:dataFila},
            success: function(r){
            
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
    $(".modal-title").text("Ingresar datos del Usuario"); 
    $("#id_correoSer").val(null);
    $("#opcion").val(1);
    $("#modalCRUD_CorreoApp").modal("show"); 



}





function agregar_editar () {
            

           $("#modalCRUD_CorreoApp").modal("hide"); 
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


    id_correoSer= $("#id_correoSer").val();
    correo= $("#correo").val();
    pass= $("#pass").val();
    app= $("#app").val();
    pass_app= $("#pass_app").val();

    host= $("#host").val();
    port= $("#port").val();



    opcion= $("#opcion").val();

     dataFila=[];
    dataFila.push(id_correoSer);
    dataFila.push(correo);
    dataFila.push(pass);
    dataFila.push(app);
    dataFila.push(pass_app);

    dataFila.push(opcion);

    dataFila.push(host);
    dataFila.push(port);




    console.log(dataFila)

    $.ajax({
        url: "modulos/cargaDatos/correosSer/elementos/crub_correosSe.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
            console.log(data);
            id_correoSer = data[0].id_correoSer;            
            correo = data[0].correo;
            password = data[0].pass;
            pass=atob(password);
            app = data[0].app;
            password = data[0].pass_app;
            pass_app=atob(password);


            host = data[0].host;
            port = data[0].port;
       
            if (opcion==1) {
                myTable.row.add([id_correoSer,correo,pass,app,pass_app,host,port]).draw();
            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([id_correoSer,correo,pass,app,pass_app,host,port]);

            }

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}

<?php } ?>


 

</script>



