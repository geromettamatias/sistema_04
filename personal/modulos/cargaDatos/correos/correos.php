

 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$operacion=$_SESSION["operacion"];



 
$consulta = "SELECT `id_correos`, `tipo`, `correo`, `usuario` FROM `correos`";
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
                <h3 class="card-title">Gestión-Correos</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button  type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

                
                <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

            
                    <?php if ($operacion=='Lectura y Escritura'){ ?>


                <button id="btnNuevo_correos" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo Ciclo Lectivo"><i class='fas fa-edit'></i></button><br> <hr>    


<?php } ?>

                  <table id="tablaCorreos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>TIPO</th>
                                <th>EMAIL</th>
                                <th>USUARIO</th> 

                                  <?php if ($operacion=='Lectura y Escritura'){ ?>
 
                                <th>BOTON</th>


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
                             
                                <td><?php echo $dat['id_correos'] ?></td>
                                <td><?php echo $dat['tipo'] ?></td>
                                <td><?php echo $dat['correo'] ?></td>
                                <td><?php echo $dat['usuario'] ?></td>

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



<div class="modal fade" id="modalCRUD_Correos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
   <form id="form_correos">    
                         
            <div class="modal-body">

                <div class="mb-3">
                <label for="tipo" class="col-form-label">TIPO:</label>
                <input type="text" class="form-control" id="tipo">
                </div>
               

                
                     <div class="mb-3">
                <label for="usuarios" class="col-form-label">USUARIOS:</label>
                       <select class="form-control" id="usuarios">
                        <option>Profesor</option>
                        <option>Estudiante</option>
                        
                
                        </select>

                </div>
                
                <div class="mb-3">
                <div id="tex"><label for="emailCopia" class="form-label">Se mandara una copia a este correo (Verificando)</label></div>
               
                <input type="email" class="form-control" id="emailCopia" aria-describedby="emailHelp">
                
                <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
              

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


   <?php if ($operacion=='Lectura y Escritura'){ ?>



      //  validar campo Email

 var verificacionEmail ='';

document.getElementById('emailCopia').addEventListener('input', function() {
    campo = event.target;
   
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {

      $('#tex').html('<label for="emailCopia" class="form-label">Se mandara una copia a este correo (<span style="color:#2471A3";>El correo es Válido</span>)</label>');
      verificacionEmail=1;
    } else {
      verificacionEmail=0; 
      $('#tex').html('<label for="emailCopia" class="form-label">Se mandara una copia a este correo (<span style="color:#FF0000";>El correo es Incorrecto</span>)</label>'); 
    
    }
});


// 

<?php } ?>


    var tablaCorreos = $('#tablaCorreos').DataTable({ 

              <?php if ($operacion=='Lectura y Escritura'){ ?>


      
    "columnDefs":[{
       
        "targets": -1,
           "pageLength" : 2, 
        "data":null,



        "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item btnEditar_correo" href="javascript:void(0)">Editar</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item btnBorrar_correo" href="javascript:void(0)">Eliminar</a></li>
                                    </ul>
                                  </div>`,

                             


       },

      

       ],

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

// visualizar datos de la tabla extras


// 
    <?php if ($operacion=='Lectura y Escritura'){ ?>


$("#btnNuevo_correos").click(function(){

    $("#form_correos").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar un nuevo correo");            
    $("#modalCRUD_Correos").modal("show"); 

    id_correos=null;
    opcion = 1; //alta
}); 


var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_correo", function(){
    fila = $(this).closest("tr");

 
    id_correos = parseInt(fila.find('td:eq(0)').text());
    tipo = fila.find('td:eq(1)').text();
    emailCopia = fila.find('td:eq(2)').text();
    usuarios = fila.find('td:eq(3)').text();

    $("#tipo").val(tipo);
    $("#emailCopia").val(emailCopia);
    $("#usuarios").val(usuarios);
 


    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos de este correo");            
    $("#modalCRUD_Correos").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_correo", function(){    
    fila = $(this);
    id_correos = parseInt($(this).closest("tr").find('td:eq(0)').text());
 

    opcion = 3 ;//borrar

    eliminarCorreo(id_correos,opcion);
  
});
    












function eliminarCorreo(id_correos,opcion) {

  

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
   

    eliminarCorreoFinal(id_correos,opcion);
  }
})



      
     
}


function  eliminarCorreoFinal(id_correos,opcion){

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
   
        
        $.ajax({
            url: "modulos/cargaDatos/correos/elementos/crud_correos.php",
            type: "POST",
            dataType: "json",
            beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnNuevo_correos").disabled = true;
                                $(".botonesModif").attr("disabled", true);
                                $('#cargaCiclo').show();
                              },
            data: {opcion:opcion, id_correos:id_correos},
            success: function(){
            
               
            }
        });

        tablaCorreos.row(fila.parents('tr')).remove().draw();
        $("#imagenProceso").hide();
                                document.getElementById("btnNuevo_correos").disabled = false;
                                $(".botonesModif").attr("disabled", false);
                                $('#cargaCiclo').hide(); 


      toastr.info('Excelente !!');
       $.unblockUI();
   

  
}




$("#form_correos").submit(function(e){
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
 
    tipo= $.trim($("#tipo").val());
    usuarios= $.trim($("#usuarios").val());
    emailCopia= $.trim($("#emailCopia").val());
   


    console.log({usuarios:usuarios,emailCopia:emailCopia, tipo:tipo, opcion:opcion, id_correos:id_correos});

    $.ajax({
        url: "modulos/cargaDatos/correos/elementos/crud_correos.php",
        type: "POST",
        dataType: "json",
        beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnNuevo_correos").disabled = true;
                                $(".botonesModif").attr("disabled", true);
                                $('#cargaCiclo').show();
                              },
        data: {usuarios:usuarios,emailCopia:emailCopia, tipo:tipo, opcion:opcion, id_correos:id_correos},
        success: function(data){  
            console.log(data);


            id_correos = data[0].id_correos;            
            tipo = data[0].tipo;
            correo = data[0].correo;
            usuario = data[0].usuario;
           

            
            if(opcion == 1){tablaCorreos.row.add([id_correos,tipo,correo,usuario]).draw();}
            else{tablaCorreos.row(fila).data([id_correos,tipo,correo,usuario]).draw();}  

            $("#imagenProceso").hide();
                                document.getElementById("btnNuevo_correos").disabled = false;
                                $(".botonesModif").attr("disabled", false);
                                $('#cargaCiclo').hide();           
        }        
    });
    $("#modalCRUD_Correos").modal("hide"); 
     $.unblockUI();   
    
});    
    

<?php } ?>
    
});

 $.unblockUI();
</script>

