 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();



$operacion=$_SESSION["operacion"];




$consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `ciclo`";
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
                <h3 class="card-title">Ciclo Lectivo</h3>

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
                  

                <div class="table-responsive">


                    <?php if (($operacion=='Lectura y Escritura') || ($_SESSION['cargo'] == 'Administrador')){ ?>


<button class="btn btn-info" title="NUEVO USUARIO" onclick="Agregar()"><i class='fas fa-spinner fa-spin'></i></button>
<button class="btn btn-danger" title="ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>


<?php } ?>


<hr>
    <table id="tabla_Administradores" class="table table display" style="width:100%">
    <thead>
        <tr>
              <th>N°</th> 
              <th>CICLO</th>
              <th>EDICION</th>

            
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>
            <td><?php echo $dat['id_ciclo'] ?></td>
            <td><?php echo $dat['ciclo'] ?></td>
            <td><?php echo $dat['edicion'] ?></td>
        
      
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
             <th>N°</th> 
              <th>CICLO</th>
              <th>EDICION</th>

            
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






  <?php if (($operacion=='Lectura y Escritura') || ($_SESSION['cargo'] == 'Administrador')){ ?>

<div class="modal fade" id="modalCRUD_Usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">
           
                <div class="form-group">
                <label for="ciclo_Copiar" class="col-form-label">COPIAR CICLO ANTERIOR:</label>

               
                <div id="ciclo_Visualizar"></div>
               
          
                </div>
                
                <div class="form-group">
                <label for="ciclo1" class="col-form-label">NUEVO CICLO:</label>
                <input type="number" class="form-control" id="ciclo1">
                </div>
                <div class="form-group">
                <label for="edicion" class="col-form-label">EDICIÓN DEL CICLO:</label>
   
                      <select class="form-select" id="edicion">
                <option>SI</option>
                <option>NO</option>
               
           
                </select> 


                </div>
               

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="guardarfINAL()"> <i class='fas fa-save'></i> Guardar</button>
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



     <?php if (($operacion=='Lectura y Escritura') || ($_SESSION['cargo'] == 'Administrador')){ ?>
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
          title: 'QUE DESEA HACER CON EL CICLO?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'EDITAR',
          denyButtonText: `ELIMINAR`,
        }).then((result) => {
          
          if (result.isConfirmed) {

                editar_FINAL_1();


          } else if (result.isDenied) {

                eliminar_FINAL();
          }
        })




    }else{

        toastr.warning('No selecciono ninguno');

    }

}



function remover () {

    $('#cicloLectivoFina').val('Seleccione un año lectivo');
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
   
     dataFila.push('');                        
     dataFila.push(3);
         console.log(dataFila)
        $.ajax({
            url: "modulos/herramientas/ciclo/elementos/crud_Ciclo.php",
            type: "POST",
            data: {dataFila:dataFila},
            success: function(r){
            
                if (r==1) {
                    myTable.rows('.selected').remove().draw();
                    toastr.warning('Se Elimino el ciclo '+dataFila[1]);
                    $.unblockUI(); 
                }else{
                     toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                }
               
            }
        });

        
     

}



function editar_FINAL_1 () {

  
       
         ret=`<select class="form-control" id="pregunta">
                <option>SI</option>
                <option>NO</option>
                </select></div>`;
     

      Swal.fire({
              title: 'EDITAR EL DOCENTE O PERSONAL TODO EL CICLO',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  pregunta = document.getElementById('pregunta').value;
              
       

                  editar_Final(pregunta,dataFila[0]);
                                  
                }
        });







}


function editar_Final(pregunta,id_ciclo) {
    
     
        $.ajax({
            url: "modulos/herramientas/ciclo/elementos/crud_editar.php",
            type: "POST",
            dataType: "json",
            data: {id_ciclo:id_ciclo, pregunta:pregunta},
            success: function(data){
            
                 id_ciclo = data[0].id_ciclo;            
            ciclo = data[0].ciclo;
            edicion = data[0].edicion;
         


                      dataFila=[];
                        dataFila.push(id_ciclo);
                        dataFila.push(ciclo);
                        dataFila.push(edicion);
                     

                numero= myTable.rows( '.selected' )[0][0];

                myTable.row(":eq("+numero+")").data([id_ciclo,ciclo,edicion]);
               
            }
        });

}



function Agregar () {

   
  

    

          $.ajax({
            url: "modulos/herramientas/ciclo/elementos/ciclo.php",
            type: "POST",
            data: {},
            success: function(r){
       
               $('#ciclo_Visualizar').html(r);
               $('#ciclo1').val('');

               $(".modal-header").css("background-color", "#1cc88a");
                $(".modal-header").css("color", "white");
                $(".modal-title").text("Ingresar un nuevo ciclo"); 
               
                
                $("#modalCRUD_Usuario").modal("show"); 

                 toastr.info('Cargar el Nuevo Ciclo Lectivo');


            }
        });

}





function guardarfINAL() {
            

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


    ciclo= $("#ciclo1").val();
    edicion= $("#edicion").val();
    ciclo_Copiar= $("#ciclo_Copiar").val();


 
    dataFila=[];
    dataFila.push(null);
    dataFila.push(ciclo);
    dataFila.push(edicion);
    dataFila.push(ciclo_Copiar);
    dataFila.push(1);


    console.log(dataFila);

    $.ajax({
        url: "modulos/herramientas/ciclo/elementos/crud_Ciclo.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){ 
            console.log(data)

            if (data==0) {
                toastr.error('El ciclo Lectivo ya esta Creado !!!');
                 $.unblockUI(); 
                return false;
            } 
            console.log(data);
            id_ciclo = data[0].id_ciclo;            
            ciclo = data[0].ciclo;
            edicion = data[0].edicion;
         


                      dataFila=[];
                        dataFila.push(id_ciclo);
                        dataFila.push(ciclo);
                        dataFila.push(edicion);
                        dataFila.push(ciclo_Copiar);
      
        
                myTable.row.add([id_ciclo,ciclo,edicion]).draw();
            
            Swal.fire({
                      icon: 'success',
                      title: 'Advertencia',
                      text: 'La base de dato de los encabezados no se puede copiar por motivos de datos del informe, deberá crear cada encabezado que ira en la libreta, ficha y el informe... Tampoco se copio las notas y informes del ciclo !'
                    })

             toastr.info('Se creo el nuevo ciclo '+ciclo+ ' los profesores y auxiliares '+edicion+' editar');
         
            $.unblockUI();   
        }        
    });

}


<?php } ?>
 

 

</script>



