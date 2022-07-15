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

$consulta = "SELECT `idUsu`, `cargo`, `nombre`, `dni`, `correo`, `nivelCurso`, `operacion`, `pass` FROM `personal_eet16`";
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
                <h3 class="card-title">LISTA DE USUARIOS</h3>

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
<div class="table-responsive">
    <table id="tabla_Administradores" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>N°</th>
             <th>CARGO</th>
             <th>NOMBRE</th>
             <th>DNI</th>
             <th>CORREO</th>
             <th>CURSOS ASIG</th>
             <th>OPERACIÓN</th>
             <th>CONTRASEÑA</th>

            
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>
            <td><?php echo $dat['idUsu'] ?></td>
            <td><?php echo $dat['cargo'] ?></td>
            <td><?php echo $dat['nombre'] ?></td>
            <td><?php echo $dat['dni'] ?></td>
            <td><?php echo $dat['correo'] ?></td>
            <td><?php echo $dat['nivelCurso'] ?></td>
            <td><?php echo $dat['operacion'] ?></td>
            <td><?php echo base64_decode ($dat['pass']); ?></td>
          
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
             <th>N°</th>
             <th>CARGO</th>
             <th>NOMBRE</th>
             <th>DNI</th>
             <th>CORREO</th>
             <th>CURSOS ASIG</th>
             <th>OPERACIÓN</th>
             <th>CONTRASEÑA</th>
            
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







                  
<?php if ($operacion=='Lectura y Escritura'){ ?>

    

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
                  <label for="nombre" class="col-form-label">APELLIDO Y NOMBRE:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="dni" class="col-form-label">DNI:</label>
                <input type="number" class="form-control" id="dni">
                </div>
                <div class="form-group">
                <label for="usuario" class="col-form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario">
                </div>
                <div class="form-group">
                <label for="pass" class="col-form-label">Contraseña:</label>
                <input type="text" class="form-control" id="pass">
                </div>
           
        

                <div class="form-group">
                <label for="cargo" class="col-form-label">TIPO DE USUARIO:</label>
                <select class="form-select" id="cargo">

                <option>SUPERVISOR</option>
                <option>AUXILIAR</option>
                <option>REGENTE</option>
                <option>VICE-DIR</option>
                <option>SECRET</option>
                <option>PERSONAL ASISTENCIA DOCENT</option>
                <option>PERSONAL TITULO</option>
                <option>Administrador</option>
                </select> 
                </div>
                
                 <div class="form-group">


                    <?php
                  
            

                  $cat="";


                  $consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` ORDER BY `nombre`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $nombre=$da1t['nombre'];
                   

                     $cat.="<option>".$nombre."</option>";


                  }

                ?>



                    

                <label for="nivelCurso" class="col-form-label">CURSO QUE TENDRA ACCESO (En caso de administrar alumnos, en caso de hacer administración docente, coloque todos)</label><br>
               

          
                <select id="nivelCurso" class="form-select" multiple aria-label="multiple select example" multiple data-live-search="true">
                    
                  <?php echo $cat;  ?>
                  <option>TODOS</option>

                  </select>

                </div>


                 <div class="form-group">
                <label for="operacion" class="col-form-label">PRIVILEGIOS:</label>

                <select id="operacion" class="form-select">

                <option>Lectura</option>
                <option>Lectura y Escritura</option>
                </select> 
                </div>



                       <div  class="form-group">
                <div id="tex"><label for="emailCopia" class="form-label">Se mandara una copia a este correo (Verificando)</label></div>
               
                <input type="email" class="form-control" id="emailCopia" aria-describedby="emailHelp">
                
                <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
              
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



<?php } ?>


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


<?php if ($operacion=='Lectura y Escritura'){ ?>


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

    $("#formPersonasUsuario").trigger("reset");
 

    $("#id").val(dataFila[0]);
    $("#opcion").val(2);
    $("#cargo").val(dataFila[1]);
    $("#nombre").val(dataFila[2]);
    $("#dni").val(dataFila[3]);
    $("#emailCopia").val(dataFila[4]);
    $("#nivelCurso").val(dataFila[5].split(','));
    $("#operacion").val(dataFila[6]);
    $("#pass").val(dataFila[7]);



    

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
   

     dataFila.push(3);
        
        $.ajax({
            url: "modulos/herramientas/usuarios/elementos/crud_usuario_personal.php",
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
    $("#id").val(null);
    $("#opcion").val(1);
    $("#modalCRUD_Usuario").modal("show"); 



}


<?php } ?>


function remover () {

    $('#cicloLectivoFina').val('Seleccione un año lectivo');
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}




<?php if ($operacion=='Lectura y Escritura'){ ?>

  


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


    id= $("#id").val();
    opcion= $("#opcion").val();
    cargo= $("#cargo").val();
    nombre= $("#nombre").val();
    dni= $("#dni").val();
    emailCopia= $("#emailCopia").val();
    nivelCurso= $("#nivelCurso").val();
    operacion= $("#operacion").val();
    pass= $("#pass").val();

    nivelCurso=nivelCurso.join();

    dataFila=[];
    dataFila.push(id);
    dataFila.push(cargo);
    dataFila.push(nombre);
    dataFila.push(dni);
    dataFila.push(emailCopia);
    dataFila.push(nivelCurso);
    dataFila.push(operacion);
    dataFila.push(pass);
    dataFila.push(opcion);

    console.log(dataFila);
    $.ajax({
        url: "modulos/herramientas/usuarios/elementos/crud_usuario_personal.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
            console.log(data);
            idUsu = data[0].idUsu;            
            cargo = data[0].cargo;
            nombre = data[0].nombre;
            dni = data[0].dni;
            correo = data[0].correo;
            nivelCurso = data[0].nivelCurso;
            operacion = data[0].operacion;
            nombre = data[0].nombre;
            pass = data[0].pass;
            password=atob(pass);

                    dataFila=[];
                    dataFila.push(idUsu);
                    dataFila.push(cargo);
                    dataFila.push(nombre);
                    dataFila.push(dni);
                    dataFila.push(correo);
                    dataFila.push(nivelCurso);
                    dataFila.push(operacion);
                    dataFila.push(password);
                  



            if (opcion==1) {
                myTable.row.add([idUsu,cargo,nombre,dni,correo,nivelCurso,operacion,password]).draw();
            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([idUsu,cargo,nombre,dni,correo,nivelCurso,operacion,password]);

            }

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}

<?php } ?>

 

</script>



