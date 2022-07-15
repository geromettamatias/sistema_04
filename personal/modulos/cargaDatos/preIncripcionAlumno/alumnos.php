
<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();

        $operacion=$_SESSION["operacion"];



            $consulta = "SELECT `id_PreIncrip`, `dni_alumno`, `nombre_alumno`, `fecha_nacimiento`, `dni_tutor`, `nombre_tutor`, `correo`, `telefono`, `domicilio`, `localidad` FROM `inscripcion`";
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
                <h3 class="card-title">Tabla de Pre-Inscripción de Alumno</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover()"  type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            


                <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

<?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>

     <?php if ($operacion=='Lectura y Escritura'){ ?>


                <button class="btn btn-danger glyphicon glyphicon-pencil" id="eliminarMatricula" >Eliminar Seleción <i class='fas fa-edit'></i></button>

                <button class="btn btn-info glyphicon glyphicon-pencil" id="matricular" >Matricular Seleción <i class='fas fa-edit'></i></button>

<hr>
<?php    }  ?>
<?php    }  ?>
                   <table id="tablaAlumnoPreNuevoPre" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>

                            <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>

                                     <?php if ($operacion=='Lectura y Escritura'){ ?>

                            <th>Sel <input type="checkbox" onClick="ActivarCasillaIscrip(this);" value="0" /></th>

                            <?php    }  ?>
                             <?php    }  ?>

                            <th>N°</th> 
                            <th>DNI</th>
                            <th>Apellido y Nombre</th> 
                             <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>
                                <?php if ($operacion=='Lectura y Escritura'){ ?>
                            <th>Acciones</th>

                               <?php    }  ?>
                             <?php    }  ?>
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


                            <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>
                                <?php if ($operacion=='Lectura y Escritura'){ ?>


                             <td><label><input type='checkbox' class="seleTod marticul" value="<?php echo $dat['id_PreIncrip'] ?>" > AsClick</label></td>

                                <?php    }  ?>
                             <?php    }  ?>
                                
                            <td><?php echo $dat['id_PreIncrip'] ?></td>
                            <td><?php echo $dat['dni_alumno'] ?></td>
                            <td><?php echo $dat['nombre_alumno'] ?></td>

                            <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>
                                <?php if ($operacion=='Lectura y Escritura'){ ?>
                            <td></td>
                        <?php    }  ?>
                         <?php    }  ?>
                        </tr>
                    <?php   }  ?>                                
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



  <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>
                                <?php if ($operacion=='Lectura y Escritura'){ ?>

<div class="modal fade" id="modalCRUD_AlumnoPre" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="formPersonasAlumnoPre">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre_alumno" class="col-form-label">Normbre y Apellido:</label>
                        <input type="text" class="form-control" id="nombre_alumno">
                    </div>


                    <div class="form-group">
                        <label for="dni_alumno" class="col-form-label">DNI:</label>
                        <input type="text" class="form-control" id="dni_alumno">
                    </div>
               
                    <div class="form-group">
                        <label for="domicilio" class="col-form-label">Domicilio:</label>
                        <input type="text" class="form-control" id="domicilio">
                    </div>
                     <div class="form-group">
                        <label for="localidad" class="col-form-label">Localidad:</label>
                        <input type="text" class="form-control" id="localidad">
                    </div>
                   

                    <div class="form-group">
                        <label for="correo" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="correo">
                    </div>
              
                    <div class="form-group">
                        <label for="fecha_nacimiento" class="col-form-label">Fecha Nacimiento del Alumno:</label>
                        <input type="text" class="form-control" id="fecha_nacimiento">
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="col-form-label">Telefono:</label>
                        <input type="text" class="form-control" id="telefono">
                    </div>
                     
                    <div class="form-group">
                        <label for="nombre_tutor" class="col-form-label">Normbre y Apellido del Tutor:</label>
                        <input type="text" class="form-control" id="nombre_tutor">
                    </div>
                    <div class="form-group">
                        <label for="dni_tutor" class="col-form-label">DNI del Tutor:</label>
                        <input type="text" class="form-control" id="dni_tutor">
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

      
                                        
 
              <?php    }  ?>
  

    <?php    }  ?>
  

<script type="text/javascript">
$(document).ready(function(){
$('#imagenProceso').hide();
      $('#cargaCiclo').hide();
    var tablaAlumnoPre = $('#tablaAlumnoPreNuevoPre').DataTable({ 

          
                "destroy":true, 

                  <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>
                                <?php if ($operacion=='Lectura y Escritura'){ ?>

                    
                "columnDefs":[{
                   
                    "targets": -1,
                    "data":null,

                        
                    "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      <li><a title='Visualización' class="dropdown-item btnEditar_Alumno_datosPreInscripcio" href="javascript:void(0)">Visualizar datos del alumno</a></li>
                                      <li><a title='Modificar tola la fila' class="dropdown-item btnEditar_Alumno_Pre" href="javascript:void(0)">Editar</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item btnBorrar_AlumnoPre" href="javascript:void(0)">Eliminar</a></li>
                                    </ul>
                                  </div>
                                </div>`,
                   },],


<?php } ?>
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




                            <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>
                                <?php if ($operacion=='Lectura y Escritura'){ ?>

                                    

    $(document).on("click", ".btnEditar_Alumno_datosPreInscripcio", function(){
            fila = $(this).closest("tr");


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


         
            id_PreIncrip = parseInt(fila.find('td:eq(1)').text());

            $.ajax({
                url: "modulos/cargaDatos/preIncripcionAlumno/elementos/crud_AlumnosDatosLetura.php",
                type: "POST",
                dataType: "json",
                data: {id_PreIncrip:id_PreIncrip},
                 beforeSend: function() {
                                $("#imagenProceso").show();
                                
                                $('#cargaCiclo').show();
                              },
                success: function(data){  

                 
                
                    id_PreIncrip = data[0].id_PreIncrip;            
                    dni_alumno = data[0].dni_alumno;
                    nombre_alumno = data[0].nombre_alumno;

                    fecha_nacimiento = data[0].fecha_nacimiento;
                    dni_tutor = data[0].dni_tutor;
                    nombre_tutor = data[0].nombre_tutor;
                    correo = data[0].correo;
                    telefono = data[0].telefono;
                    domicilio= data[0].domicilio;
                    localidad = data[0].localidad;

                        Swal.fire({
                                title: 'Datos',
                                html:`<span>Apellido y Nombre del Alumno:`+nombre_alumno+`</span><br>
<span>DNI del Alumno:`+dni_alumno+`</span><br>
<span>Fecha Nacionalidad:`+fecha_nacimiento+`</span><br>


<span>Domicilio:`+domicilio+`</span><br>
<span>Localidad:`+localidad+`</span><br>
<span>Email del Alumno:`+correo+`</span><br>
<span>Telefono del Alumno:`+telefono+`</span><br>
<span>Apellido y Nombre del Tutor:`+nombre_tutor+`</span><br>
<span>DNI del Tutor:`+dni_tutor+`</span><br>`, 


                                focusConfirm: false,
                                showCancelButton: true,                         
                                }).then((result) => {
                              
                          }); 
                       
                   $("#imagenProceso").hide();
                                
                                $('#cargaCiclo').hide();



 $.unblockUI();         
                      
        }        
    });
  
});

// 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Alumno_Pre", function(){
    fila = $(this).closest("tr");

 
           id_PreIncrip = parseInt(fila.find('td:eq(1)').text());


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
                url: "modulos/cargaDatos/preIncripcionAlumno/elementos/crud_AlumnosDatosLetura.php",
                type: "POST",
                dataType: "json",
                data: {id_PreIncrip:id_PreIncrip},
                 beforeSend: function() {
                                $("#imagenProceso").show();
                                
                                $('#cargaCiclo').show();
                              },
                success: function(data){  

                    `id_PreIncrip`, `dni_alumno`, `nombre_alumno`, `fecha_nacimiento`, `dni_tutor`, `nombre_tutor`, `correo`, `telefono`, `domicilio`, `localidad`

                
                    id_PreIncrip = data[0].id_PreIncrip;            
                    dni_alumno = data[0].dni_alumno;
                    nombre_alumno = data[0].nombre_alumno;

                    fecha_nacimiento = data[0].fecha_nacimiento;
                    dni_tutor = data[0].dni_tutor;
                    nombre_tutor = data[0].nombre_tutor;
                    correo = data[0].correo;
                    telefono = data[0].telefono;
                    domicilio= data[0].domicilio;
                    localidad = data[0].localidad;

            $("#dni_alumno").val(dni_alumno);
            $("#nombre_alumno").val(nombre_alumno);
            $("#fecha_nacimiento").val(fecha_nacimiento);
            $("#dni_tutor").val(dni_tutor);
            $("#nombre_tutor").val(nombre_tutor);
            


            $("#correo").val(correo);
            $("#telefono").val(telefono);
            $("#domicilio").val(domicilio);
            $("#localidad").val(localidad);
            
            $("#imagenProceso").hide();
                                
                                $('#cargaCiclo').hide();   
        }        
    });



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del alumno y tutor");            
    $("#modalCRUD_AlumnoPre").modal("show");  


 $.unblockUI();
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_AlumnoPre", function(){    
    fila = $(this);
    idAlumnos = parseInt($(this).closest("tr").find('td:eq(1)').text());

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
 

    opcion = 3 ;//borrar

    eliminarAntesPlanAlumnoPR(id_PreIncrip,opcion);
  
});
    




function eliminarAntesPlanAlumnoPR(id_PreIncrip,opcion) {

  

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

    eliminarAntesPlanAlumnoFinalPR(id_PreIncrip,opcion);
  }else{



 $.unblockUI();
  }
})



      
     
}


function  eliminarAntesPlanAlumnoFinalPR(id_PreIncrip,opcion){

        $.ajax({
            url: "modulos/cargaDatos/preIncripcionAlumno/elementos/crud_datos_Plan_Alumnos.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id_PreIncrip:id_PreIncrip},
            beforeSend: function() {
                                $("#imagenProceso").show();
                               
                                $('#cargaCiclo').show();
                              },
            success: function(res){
                
               console.log(res);
            }
        });

        tablaAlumnoPre.row(fila.parents('tr')).remove().draw();

      
        $("#imagenProceso").hide();
                               
                                $('#cargaCiclo').hide(); 


 $.unblockUI();

     
}




$("#formPersonasAlumnoPre").submit(function(e){
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

    dni_alumno = $.trim($("#dni_alumno").val());
    nombre_alumno = $.trim($("#nombre_alumno").val());
    fecha_nacimiento = $.trim($("#fecha_nacimiento").val());
    dni_tutor = $.trim($("#dni_tutor").val());
    nombre_tutor = $.trim($("#nombre_tutor").val());
    correo = $.trim($("#correo").val());
    telefono = $.trim($("#telefono").val());
   
    domicilio = $.trim($("#domicilio").val());
    localidad = $.trim($("#localidad").val());
   
         $.ajax({
        url: "modulos/cargaDatos/preIncripcionAlumno/elementos/crud_datos_Plan_Alumnos.php",
        type: "POST",
        dataType: "json",
        data: {id_PreIncrip:id_PreIncrip, dni_alumno:dni_alumno, nombre_alumno:nombre_alumno, fecha_nacimiento:fecha_nacimiento, dni_tutor:dni_tutor, nombre_tutor:nombre_tutor, correo:correo, telefono:telefono, domicilio:domicilio, localidad:localidad, opcion:opcion},
        beforeSend: function() {
                                $("#imagenProceso").show();
                               
                                $('#cargaCiclo').show();
                              },
        success: function(data){  
            console.log(data);
             id_PreIncrip = data[0].id_PreIncrip;            
                    dni_alumno = data[0].dni_alumno;
                    nombre_alumno = data[0].nombre_alumno;

                    id='<td><label><input type="checkbox" class="seleTod marticul" value="'+id_PreIncrip+'" > AsClick</label></td>';



      tablaAlumnoPre.row(fila).data([id,id_PreIncrip,dni_alumno,nombre_alumno]).draw();
             $("#imagenProceso").hide();
                                
                                $('#cargaCiclo').hide(); 
            
        }        
    });
    $("#modalCRUD_AlumnoPre").modal("hide"); 

     $.unblockUI();   
    
});    
    

<?php } ?>
<?php } ?>
    
});









$(document).on("click", "#eliminarMatricula", function(){

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

        botonMuchosEliminarDos();
      });


 function botonMuchosEliminarDos() {
        Swal.fire({
          title: 'Esta seguro de No Inscribir a estos alumno/s ?',
          text: "Los alumnos perderan todas las notas de la Libreta digital",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'No Inscribir'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Operación éxitosa',
              'success'
            )

          $("#imagenProceso").show();
        
          botonMuchosEliminarDosFiFinal();
        }else{

 $.unblockUI();
        }
      })
      }





      function botonMuchosEliminarDosFiFinal() {
     
        opcion=3;

        $(".marticul:checked").each(function() {

          id_PreIncrip = $(this).val();
          fila=$(this);
          
     
          if (id_PreIncrip!=0) {

               
               

                 $.ajax({
                        url: "modulos/cargaDatos/preIncripcionAlumno/elementos/crud_datos_Plan_Alumnos.php",
                        type: "POST",
                        dataType: "json",
                        data: {opcion:opcion, id_PreIncrip:id_PreIncrip},
                   
                        success: function(res){
                            console.log(res);
                           
                        }
                    });
                  tablaAlumnoPreNuevoPre= $('#tablaAlumnoPreNuevoPre').DataTable();
                  tablaAlumnoPreNuevoPre.row(fila.parents('tr')).remove().draw();
           
            
          }

        });


        toastr.success('Muy Bien !!! Proceso Realizado exitosamente.')
        $("#imagenProceso").hide();


 $.unblockUI();
     
      }





$(document).on("click", "#matricular", function(){

  

        botoMatriculacionDos();
      });


 function botoMatriculacionDos() {
        Swal.fire({
          title: 'Esta seguro de No Inscribir a estos alumno/s ?',
          text: "Los alumnos perderan todas las notas de la Libreta digital",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'No Inscribir'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Operación éxitosa',
              'success'
            )

          $("#imagenProceso").show();
        
          botonMuchoMatriculacionFi();
        }else{


        }
      })
      }



      function botonMuchoMatriculacionFi(){



           $.ajax({
                     url: "modulos/cargaDatos/preIncripcionAlumno/elementos/buscarPlan.php",
                        type: "POST",
                        
                        data: {},
                    
                        success: function(boton){
                            console.log(boton);


                             ret=`<select class="form-control" id="planEstudio">
               
                `+boton+`
                </select>`;
     

                  Swal.fire({
                          title: 'Plan de Estudio',
                          html:ret, 
                          focusConfirm: false,
                          showCancelButton: true,                         
                          }).then((result) => {
                            if (result.value) {                                             
                              planEstudio = document.getElementById('planEstudio').value;
                          
                   

                              botonMuchoMatriculacionFiFinal(planEstudio);
                                              
                            }
                    });
                           
                        }
                    });


            


      }
      function botonMuchoMatriculacionFiFinal(planEstudio) {
     
        opcion=5;


        $(".marticul:checked").each(function() {

          id_PreIncrip = $(this).val();
        
          fila=$(this);
            
          if (id_PreIncrip!=0) {

               
              
                 $.ajax({
                        url: "modulos/cargaDatos/preIncripcionAlumno/elementos/crud_datos_Plan_Alumnos.php",
                        type: "POST",
                       
                        data: {opcion:opcion, id_PreIncrip:id_PreIncrip, planEstudio:planEstudio},
                    
                        success: function(res){
                            
                           console.log(res);
                        }
                    });
                 tablaAlumnoPreNuevoPre= $('#tablaAlumnoPreNuevoPre').DataTable();
                  tablaAlumnoPreNuevoPre.row(fila.parents('tr')).remove().draw();
           
            
          }

        });


        toastr.success('Muy Bien !!! Proceso Realizado exitosamente.')
        $("#imagenProceso").hide();
     
      }




  function ActivarCasillaIscrip(casilla){
    miscasillas=document.getElementsByClassName('seleTod'); //Rescatamos controles tipo Input
    for(i=0;i<miscasillas.length;i++) //Ejecutamos y recorremos los controles
      {
        if(miscasillas[i].type == "checkbox") // Ejecutamos si es una casilla de verificacion
        {
          miscasillas[i].checked=casilla.checked; // Si el input es CheckBox se aplica la funcion ActivarCasillaIscrip
        }
      }
    }


function remover () {

  
    $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}




 $.unblockUI();
</script>

