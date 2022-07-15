
<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();
        $operacion=$_SESSION["operacion"];


        $consulta = "SELECT `idDocente`, `dni`, `nombre`, `estado` FROM `datos_docentes` WHERE `estado`='DESACTIVO'";
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
                <h3 class="card-title">Habilitar Docente</h3>

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

                    <button class="btn btn-warning glyphicon glyphicon-pencil" title="SELECCIONAR O DESELECCIONAR LOS DOCENTES" onclick="seleccionarTODO()"><i class='fas fa-check-circle'></i></button>

       
<button onclick="activarDocente()" type="button" class="btn btn-info" data-toggle="modal" title="ACTIVAR DOCENTE"><i class='fas fa-user-plus'></i></button>

<button onclick="desamatricularDocente()" type="button" class="btn btn-danger" data-toggle="modal" title="DESMATRICULAR DOCENTE"><i class='fas fa-trash'></i></button>
<hr>

<?php } ?>

    <table id="example" class="table table display" style="width:100%">
     <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>DNI</th>
                                <th>Apellido y Nombre</th> 
                                <th>ESTADO</th> 
                           
                            </tr>
                    </thead>
     <tbody>

                            <?php 
                                                     
                            foreach($data as $dat) {    
                            ?>
                            <tr>
                             
                                <td><?php echo $dat['idDocente'] ?></td>
                                <td><?php echo $dat['dni'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['estado'] ?></td>
                              
                            </tr>
                               <?php
                                }
                            ?>    
    <tfoot>
        <tr>
            <th>N°</th> 
            <th>DNI</th>
            <th>Apellido y Nombre</th> 
            <th>ESTADO</th> 
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


<script type="text/javascript">

 $.unblockUI();

     $('#imagenProceso').hide();
      $('#cargaCiclo').hide();

    var myTable = $('#example').DataTable({
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

<?php if ($operacion=='Lectura y Escritura'){ ?>


//  inicio el array y el selector (total)
var arrayContieneLosElementosAEliminar =[];
var selector=0;



//  selecciono particular o grupal, agrego en un array 

$('#example tbody').on('click', 'tr', function () {
        
        // selecciona en datatable
         $(this).toggleClass('selected');

   
    // obtengo los valores
    var dataFila = myTable.row( this ).data();
    //verifico con el dato si esta dentro del array, busco y si tiene indice
    index = arrayContieneLosElementosAEliminar.indexOf(dataFila[0]);
    // verifico si posee indice no puede dar -1
    if (index > -1) {
        // elimino el elemento seleccionado con el indice encontrado
        arrayContieneLosElementosAEliminar.splice(index, 1);
    }else{
        // agrego elemento al array
        arrayContieneLosElementosAEliminar.push(dataFila[0]);

    }
console.log(arrayContieneLosElementosAEliminar); 


} );

//  fin seleccion particular o grupal

//  seleccinar total
function seleccionarTODO () {

    //  selecciono y selecciono todo, reinicio el array y agrego los elementos nuevamente...

    if ((selector % 2) == 0) {
             $("tr").addClass(" odd selected");
            arrayContieneLosElementosAEliminar=[];

            myTable.rows().data().each(function (value) {
                var dataFila_total= value[0];
                arrayContieneLosElementosAEliminar.push(dataFila_total);
            });

    }else{

            $("tr").removeClass(" odd selected");
            
            myTable.rows().data().each(function (value) {
                var dataFila_total= value[0];
                arrayContieneLosElementosAEliminar=[];
            });
    }

selector++;

console.log(arrayContieneLosElementosAEliminar); 


}

//  fino selecciono total

  function activarDocente() {
        Swal.fire({
          title: 'Esta seguro de la Activacion de estos Docentes',
          text: "Los docentes podran logearce y gestionar",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ACTIVAR'
        }).then((result) => {
          if (result.isConfirmed) {
            activarDocente_Final();
        }
      })
      }


      function activarDocente_Final() {

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
    

            myTable.rows('.selected').remove().draw();
               

                $.ajax({
                  type:"post",
                  data:{arrayContieneLosElementosAEliminar:arrayContieneLosElementosAEliminar, opcion:1},
                  url:'modulos/cargaDatos/habilitarDocente/elementos/crud_datos_Plan_Docente.php',
                  success:function(respuesta){

                        if (respuesta==1) {
                            toastr.success('Se activo con exito  !!!');
                        }else{
                            toastr.error('Error del Servidor');
                        }
                        
                        $.unblockUI();
             
                  }
                });

       
      }









  function desamatricularDocente() {
        Swal.fire({
          title: 'Esta seguro de la Activacion de estos Docentes',
          text: "Los docentes podran logearce y gestionar",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Desmatricular'
        }).then((result) => {
          if (result.isConfirmed) {
            desamatricularDocente_Final();
        }
      })
      }


      function desamatricularDocente_Final() {

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
    

            myTable.rows('.selected').remove().draw();
               

                $.ajax({
                  type:"post",
                  data:{arrayContieneLosElementosAEliminar:arrayContieneLosElementosAEliminar, opcion:2},
                  url:'modulos/cargaDatos/habilitarDocente/elementos/crud_datos_Plan_Docente.php',
                  success:function(respuesta){

                        if (respuesta==1) {
                            toastr.success('Se Desmatriculación con exito  !!!');
                        }else{
                            toastr.error('Error del Servidor');
                        }
                        
                        $.unblockUI();
             
                  }
                });

       
      }

<?php } ?>

function remover () {

  
    $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}



</script>


