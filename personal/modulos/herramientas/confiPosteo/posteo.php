

<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$operacion=$_SESSION["operacion"];



$consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos`";
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
                <h3 class="card-title"><i class="fas fa-edit"></i>
                  POSTEO <br>ACLARACIÓN: En el caso de las <b>Mesas de Examen</b> se Publicara la <b>nota</b> cuando se <b>deshabilite la inscripción</b> a las mismas!</h3>

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

            
                    <button class="btn btn-danger" title="EDITAR" onclick="editar()"><i class="fas fa-cog fa-spin"></i></button>
<?php } ?>
<hr>
    <table id="example" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>TIPO</th>
            <th>USUARIO</th>
            <th>POSTEO</th> 
            
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>
            <td><?php echo $dat['idFecha'] ?></td>
            <td><?php echo $dat['tipo'] ?></td>
            <td><?php echo $dat['usuario'] ?></td>
            <td><?php echo $dat['pregunta'] ?></td>
          
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
             <th>Id</th>
            <th>TIPO</th>
            <th>USUARIO</th>
            <th>POSTEO</th> 
            
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


<div class="modal fade" id="modalCRUD_Usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <input type="text" class="form-control" id="idFecha" hidden='' >
                 <div class="form-group">
                <label for="postear" class="col-form-label">POSTEAR ?</label>
                    <select class="form-control" id="postear">
                        <option value='SI'>SI</option>
                        <option value='NO'>NO</option>      
                    </select>
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


    var myTable = $('#example').DataTable({
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

$('#example tbody').on('click', 'tr', function () {



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


function editar(){


    if (preguntar==1) {

  

                editar_FINAL();


      


    }else{

        toastr.warning('No selecciono ninguno');

    }

}



function editar_FINAL () {

    $("#formPersonasUsuario").trigger("reset");
 

    $("#idFecha").val(dataFila[0]);
    $("#postear").val(dataFila[3]);
   
    

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Usuario");            
    $("#modalCRUD_Usuario").modal("show");  


}




function remover () {

   
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



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


    idFecha= $("#idFecha").val();
    postear= $("#postear").val();
 
     dataFila=[];
    dataFila.push(idFecha);
    dataFila.push(postear);

    
    console.log(dataFila)

    $.ajax({
        url: "modulos/herramientas/confiPosteo/elementos/crud_pos.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
           console.log(data);
            idFecha = data[0].idFecha;            
            tipo = data[0].tipo;
            usuario = data[0].usuario;
            pregunta = data[0].pregunta;
           
         
             numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([idFecha,tipo,usuario,pregunta]);

                    dataFila=[];
                    dataFila.push(idFecha);
                    dataFila.push(pregunta);
   
        
            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}



 <?php } ?>

</script>




