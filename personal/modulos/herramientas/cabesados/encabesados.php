<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


$operacion=$_SESSION["operacion"];



if (isset($_SESSION['cicloLectivo'])){
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


$consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde`, `tipo` FROM `cabezera_libreta_digital_$cicloLectivo`";
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
                <h3 class="card-title">ENCABEZADO DE LIBRETA, FICHA E INFORME</h3>

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
                  

            

<?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>
<button class="btn btn-info" title="NUEVO ENCABEZADO" onclick="Agregar()"><i class='fas fa-marker'></i></button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>

<?php } ?>
<hr>
    <table id="tabla_CABEZADO" class="table table display" style="width:100%">
    <thead>
           <tr>
                                <th>N°</th> 
                                <th>ENCABEZADO</th>
                                <th>DESCRIP</th>
                                <th>EDITAR POR DOCENTE</th>
                                <th>LIBRETA/FICHA</th>
                                <th>TIPO</th>
         
                            
                            </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>
            <td><?php echo $dat['idCabezera'] ?></td>
            <td><?php echo $dat['nombre'] ?></td>
            <td><?php echo $dat['descri'] ?></td>
            <td><?php echo $dat['editarDocente'] ?></td>
            <td><?php echo $dat['corresponde'] ?></td>
            <td><?php echo $dat['tipo'] ?></td>
           
           
        
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
           <tr>
                                <th>N°</th> 
                                <th>ENCABEZADO</th>
                                <th>DESCRIP</th>
                                <th>EDITAR POR DOCENTE</th>
                                <th>LIBRETA/FICHA</th>
                                <th>TIPO</th>
                          
                            
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

<div class="modal fade" id="modalCRUD_cABEZADO" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
       


            <div class="modal-body">
                <input type="text" class="form-control" id="idCabezera" hidden='' >
                <input type="text" class="form-control" id="opcion" hidden=''>
                <input type="text" class="form-control" id="cabezeraViejo" hidden=''>

         
                <div class="form-group">
                <label for="cabezera" class="form-label">NOMBRE:</label>
                <input type="text" class="form-control" id="cabezera">
                </div>
     
             
                <div class="form-group">
                <label for="descrip" class="form-label">DESCRIP:</label>
                   <select class="form-select" id="descrip">
                      <option>NUMERICO</option>
                      <option>TEXTO</option>
                      <option>INFORME</option>
                
                    </select>
                </div>
                <div class="form-group">
                <label for="corresponde" class="form-label">FICHA/LIBRETA:</label>
                <select id="corresponde" class="form-select" aria-label=".form-select-lg">
                  <option value="FICHA/LIBRETA">FICHA/LIBRETA</option>
                  <option value="FICHA">FICHA</option>
                  <option value="INFORME">INFORME</option>       
                </select>
                </div>
                <div class="form-group">
                <label for="tipo" class="form-label">TIPO:</label>
                <select id="tipo" class="form-select" aria-label=".form-select-lg">
                    <option value="CALIF-LETRA-NUMERO(EP,NUMERO)">CALIF-LETRA-NUMERO(Ej "EP" es 1 a 5 // 6 a 10 solo numero)</option>
                  <option value="CALIF-LETRA-(EP,A)">CALIF-LETRA-(Ej "EP" es 1 a 5 y "A" es 6 a 10)</option>
                  <option value="CALIF-LETRA-(EP,A,S)">CALIF-LETRA-(Ej "EP" es 1 a 5 y "A" es de 6 a 7 y "S" es de 8 a 10)</option>
                  <option value="SOLO-NOMERO">SOLO-NOMERO</option>
                  <option value="TEXTO">TEXTO</option>  
                     
                </select>
                </div>
           
            
                <div class="form-group">
                <label for="ediDocente" class="form-label">EL PROFESOR CARGAR:</label>
                <select id="ediDocente" class="form-select" aria-label=".form-select-lg">
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>      
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


    var myTable = $('#tabla_CABEZADO').DataTable({
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

$('#tabla_CABEZADO tbody').on('click', 'tr', function () {



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





function remover () {

    $('#cicloLectivo').val('Seleccione un año lectivo');
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}


function editar_FINAL () {



   $("#idCabezera").val(dataFila[0]);
   
   $("#cabezera").val(dataFila[1]);
   $("#cabezeraViejo").val(dataFila[1]);
   $("#descrip").val(dataFila[2]);
   $("#ediDocente").val(dataFila[3]);
   $("#corresponde").val(dataFila[4]);
   $("#tipo").val(dataFila[5]);
   
    $("#opcion").val(2);




    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Usuario");            
    $("#modalCRUD_cABEZADO").modal("show");  


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
   
     dataFila.push('');                       
     dataFila.push(3);
        
        $.ajax({
            url: "modulos/herramientas/cabesados/elementos/crud_CABEZERA.php",
            type: "POST",
            dataType: "json",
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

   
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar datos del Usuario"); 
    $("#idCabezera").val(null);
    $("#opcion").val(1);
    $("#modalCRUD_cABEZADO").modal("show"); 





}





function agregar_editar () {
            

           $("#modalCRUD_cABEZADO").modal("hide"); 
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


    idCabezera= $("#idCabezera").val();
    cabezera= $("#cabezera").val();
    descrip= $("#descrip").val();
    ediDocente= $("#ediDocente").val();
    corresponde= $("#corresponde").val();
    tipo= $("#tipo").val();
    opcion= $("#opcion").val();
    cabezeraViejo= $("#cabezeraViejo").val();


    dataFila=[];
    dataFila.push(idCabezera);
    dataFila.push(cabezera);
    dataFila.push(descrip);
    dataFila.push(ediDocente);
    dataFila.push(corresponde);
    dataFila.push(tipo);
    dataFila.push(cabezeraViejo);
    dataFila.push(opcion);




    console.log(dataFila);

    $.ajax({
        url: "modulos/herramientas/cabesados/elementos/crud_CABEZERA.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){ 

            if (data==0) {
                 toastr.info('No se puede editar');
                $.unblockUI(); 
                 return false;
            }

            console.log(data);
            idCabezera = data[0].idCabezera;            
            nombre = data[0].nombre;
            descri = data[0].descri;
            editarDocente = data[0].editarDocente;
           
            corresponde = data[0].corresponde;
            tipo = data[0].tipo;
   
                dataFila=[];
                dataFila.push(idCabezera);
                dataFila.push(cabezera);
                dataFila.push(descrip);
                dataFila.push(editarDocente);
                dataFila.push(corresponde);
                dataFila.push(tipo);
           

            if (opcion==1) {
                myTable.row.add([idCabezera,cabezera,descrip,ediDocente,corresponde,tipo]).draw();
            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([idCabezera,cabezera,descrip,ediDocente,corresponde,tipo]);

            }

            
            toastr.info('Se creo el nuevo encabezado '+cabezera);
            $.unblockUI();   
        }        
    });

}


<?php } ?>
 

</script>

<?php  } ?> 

