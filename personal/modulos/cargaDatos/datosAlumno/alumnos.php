
<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();

        $operacion=$_SESSION["operacion"];




            $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos`";
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
                <h3 class="card-title">Tabla de Registro de Alumno</h3>

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
                  

                   

                <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

               <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>
                <button id="btnNuevo_Alumno" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo Alumno"><i class='fas fa-edit'></i></button><br> <hr>    

   <?php    }  ?>

                   <table id="tablaAlumnoNuevo" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>N°</th> 
                            <th>DNI</th>
                            <th>Apellido y Nombre</th> 
                            <th>Acciones</th>
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

                            <td><?php echo $dat['idAlumnos'] ?></td>
                            <td><?php echo $dat['dniAlumnos'] ?></td>
                            <td><?php echo $dat['nombreAlumnos'] ?></td>
                            <td></td>
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


<div class="modal fade" id="modalCRUD_Alumno" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="formPersonasAlumno">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombreAlumnos2" class="col-form-label">Normbre y Apellido:</label>
                        <input type="text" class="form-control" id="nombreAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="dniAlumnos2" class="col-form-label">DNI:</label>
                        <input type="text" class="form-control" id="dniAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="cuilAlumnos2" class="col-form-label">CUIL:</label>
                        <input type="text" class="form-control" id="cuilAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="domicilioAlumnos2" class="col-form-label">Domicilio:</label>
                        <input type="text" class="form-control" id="domicilioAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="emailAlumnos2" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="emailAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="telefonoAlumnos2" class="col-form-label">Telefono:</label>
                        <input type="text" class="form-control" id="telefonoAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="discapasidadAlumnos2" class="col-form-label">Discapasidad:</label>
                        <input type="text" class="form-control" id="discapasidadAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="nombreTutor2" class="col-form-label">Normbre y Apellido del Tutor:</label>
                        <input type="text" class="form-control" id="nombreTutor2">
                    </div>
                    <div class="form-group">
                        <label for="dniTutor2" class="col-form-label">DNI del Tutor:</label>
                        <input type="text" class="form-control" id="dniTutor2">
                    </div>
                    <div class="form-group">
                        <label for="TelefonoTutor2" class="col-form-label">Telefono del Tutor:</label>
                        <input type="text" class="form-control" id="TelefonoTutor2">
                    </div>
                    <div class="form-group">
                        <label for="idPlanEstudio" class="col-form-label">Orientación al que se inscribe:</label>
                        <select class="form-control" id="idPlanEstudio">
                             <?php

                                $c1onsulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idPlan'] ?>"><?php echo $d1at['nombre'] ?></option>
                                <?php } ?>
                        </select>
                    </div>
                

                <div class="form-group">
                        <label for="fechaNacimiento" class="col-form-label">Fecha Nacimiento:</label>
                        <input type="text" class="form-control" id="fechaNacimiento">
                    </div>
                <div class="form-group">
                        <label for="nLegajo" class="col-form-label">N° Legajo:</label>
                        <input type="text" class="form-control" id="nLegajo">
                    </div>
                <div class="form-group">
                        <label for="nacido" class="col-form-label">N° Nacido en:</label>
                        <input type="text" class="form-control" id="nacido">
                    </div>
                <div class="form-group">
                        <label for="procedencia" class="col-form-label">Procedencia del alumno:</label>
                        <input type="text" class="form-control" id="procedencia">
                    </div>

                <div class="form-group">
                        <label for="nacionalidadTutor" class="col-form-label">Nacionalidad del Tutor:</label>
                        <input type="text" class="form-control" id="nacionalidadTutor">
                    </div>

                    <div class="form-group">
                        <label for="pass" class="col-form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="pass">
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

  

<script type="text/javascript">
$(document).ready(function(){
$('#imagenProceso').hide();
      $('#cargaCiclo').hide();
    var tablaAlumno = $('#tablaAlumnoNuevo').DataTable({ 

          
                "destroy":true,
                "pageLength" : 2,    
                "columnDefs":[{
                   
                    "targets": -1,
                    "data":null,
                   
                    "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      <li><a title='Visualización' class="dropdown-item btnEditar_Alumno_datos" href="javascript:void(0)">Visualizar datos del alumno</a></li>
                                      
                                      <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET')){  ?>

                                      <li><a title='Modificar tola la fila' class="dropdown-item btnEditar_Alumno" href="javascript:void(0)">Editar</a></li>

                                      

                                      <li><a title='Eliminar tola la fila' class="dropdown-item btnBorrar_Alumno" href="javascript:void(0)">Eliminar</a></li>

                                      <?php    }  ?>

                                    </ul>
                                  </div>
                                </div>`,
                   },],



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


    $(document).on("click", ".btnEditar_Alumno_datos", function(){
            fila = $(this).closest("tr");

         
            idAlumnos = parseInt(fila.find('td:eq(0)').text());

            $.ajax({
                url: "modulos/cargaDatos/datosAlumno/elementos/crud_AlumnosDatosLetura.php",
                type: "POST",
                dataType: "json",
                data: {idAlumnos:idAlumnos},
                 beforeSend: function() {
                                $("#imagenProceso").show();
                                
                              },
                success: function(data){  
                
                    idAlumnos = data[0].idAlumnos;            
                    nombreAlumnos = data[0].nombreAlumnos;
                    dniAlumnos = data[0].dniAlumnos;

                    cuilAlumnos = data[0].cuilAlumnos;
                    domicilioAlumnos = data[0].domicilioAlumnos;
                    emailAlumnos = data[0].emailAlumnos;
                    telefonoAlumnos = data[0].telefonoAlumnos;
                    discapasidadAlumnos = data[0].discapasidadAlumnos;
                    nombreTutor= data[0].nombreTutor;
                    dniTutor = data[0].dniTutor;
                    TelefonoTutor = data[0].TelefonoTutor;
               
                    nombre = data[0].nombre;


                    fechaNacimiento = data[0].fechaNa;
                    nLegajo = data[0].nLegajos;
                    nacido = data[0].nacido;
                    procedencia = data[0].procedencia;
                    nacionalidadTutor = data[0].nacionalidadTutor;

                    password=atob(data[0].pass);


                        Swal.fire({
                                title: 'Datos',
                                html:`<span>Apellido y Nombre del Alumno:`+nombreAlumnos+`</span><br>
<span>DNI del Alumno:`+dniAlumnos+`</span><br>
<span>Cuil:`+cuilAlumnos+`</span><br>
<span>Domicilio:`+domicilioAlumnos+`</span><br>
<span>Email del Alumno:`+emailAlumnos+`</span><br>
<span>Telefono del Alumno:`+telefonoAlumnos+`</span><br>
<span>Discapasidad del Alumno:`+discapasidadAlumnos+`</span><br>
<span>Apellido y Nombre del Tutor:`+nombreTutor+`</span><br>
<span>DNI del Tutor:`+dniTutor+`</span><br>
<span>Telefono del Tutor:`+TelefonoTutor+`</span><br>
<span>Plan:`+nombre+`</span><br>
<span>Fecha Nacionalidad:`+fechaNacimiento+`</span><br>
<span>N° Legajo:`+nLegajo+`</span><br>
<span>Nacido en (del alumno):`+nacido+`</span><br>
<span>Procedencia del alumno:`+procedencia+`</span><br>
<span>Nacionalidad del Tutor:`+nacionalidadTutor+`</span><br>
<span>Contraseña: `+password+`</span>`, 


                                focusConfirm: false,
                                showCancelButton: true,                         
                                }).then((result) => {
                              
                          }); 
                       
                   $("#imagenProceso").hide();
                                         
                      
        }        
    });
  
});

// 


$("#btnNuevo_Alumno").click(function(){

    $("#formPersonasAlumno").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar datos del alumno y tutor");            
    $("#modalCRUD_Alumno").modal("show"); 

    idAlumnos=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Alumno", function(){
    fila = $(this).closest("tr");

 
    idAlumnos = parseInt(fila.find('td:eq(0)').text());

    $.ajax({
        url: "modulos/cargaDatos/datosAlumno/elementos/crud_AlumnosDatosLetura.php",
        type: "POST",
        dataType: "json",
        data: {idAlumnos:idAlumnos},
        beforeSend: function() {
                                $("#imagenProceso").show();
                                
                              },
        success: function(data){  

            idAlumnos = data[0].idAlumnos;            
            nombreAlumnos = data[0].nombreAlumnos;
            dniAlumnos = data[0].dniAlumnos;

            cuilAlumnos = data[0].cuilAlumnos;
            domicilioAlumnos = data[0].domicilioAlumnos;
            emailAlumnos = data[0].emailAlumnos;
            telefonoAlumnos = data[0].telefonoAlumnos;
            discapasidadAlumnos = data[0].discapasidadAlumnos;
            nombreTutor= data[0].nombreTutor;
            dniTutor = data[0].dniTutor;
            TelefonoTutor = data[0].TelefonoTutor;
            idPlanEstudio = data[0].idPlanEstudio;

              fechaNacimiento = data[0].fechaNa;
                    nLegajo = data[0].nLegajos;
                    nacido = data[0].nacido;
                    procedencia = data[0].procedencia;
                    nacionalidadTutor = data[0].nacionalidadTutor;
                      password=atob(data[0].pass);


            $("#fechaNacimiento").val(fechaNacimiento);
            $("#nLegajo").val(nLegajo);
            $("#nacido").val(nacido);
            $("#procedencia").val(procedencia);
            $("#nacionalidadTutor").val(nacionalidadTutor);
            


            $("#nombreAlumnos2").val(nombreAlumnos);
            $("#dniAlumnos2").val(dniAlumnos);
            $("#cuilAlumnos2").val(cuilAlumnos);
            $("#domicilioAlumnos2").val(domicilioAlumnos);
            $("#emailAlumnos2").val(emailAlumnos);
            $("#telefonoAlumnos2").val(telefonoAlumnos);
            $("#discapasidadAlumnos2").val(discapasidadAlumnos);
            
            $("#nombreTutor2").val(nombreTutor);
            $("#dniTutor2").val(dniTutor);
            $("#TelefonoTutor2").val(TelefonoTutor);
            $("#pass").val(password);

          
            $("#idPlanEstudio").val(idPlanEstudio);
            $("#imagenProceso").hide();
                                   
        }        
    });



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del alumno y tutor");            
    $("#modalCRUD_Alumno").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Alumno", function(){    
    fila = $(this);
    idAlumnos = parseInt($(this).closest("tr").find('td:eq(0)').text());
 

    opcion = 3 ;//borrar

    eliminarAntesPlanAlumno(idAlumnos,opcion);
  
});
    



function remover () {

  
    $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}



function eliminarAntesPlanAlumno(idAlumnos,opcion) {

  

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

    eliminarAntesPlanAlumnoFinal(idAlumnos,opcion);
  }
})



      
     
}


function  eliminarAntesPlanAlumnoFinal(idAlumnos,opcion){

        $.ajax({
            url: "modulos/cargaDatos/datosAlumno/elementos/crud_datos_Plan_Alumnos.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idAlumnos:idAlumnos},
            beforeSend: function() {
                                $("#imagenProceso").show();
                                
                              },
            success: function(){
                
               
            }
        });

        tablaAlumno.row(fila.parents('tr')).remove().draw();

        idPlanEstudio='';
        $("#imagenProceso").hide();
                                 

     
}




$("#formPersonasAlumno").submit(function(e){
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

 
    nombreAlumnos = $.trim($("#nombreAlumnos2").val());
    dniAlumnos = $.trim($("#dniAlumnos2").val());
    cuilAlumnos = $.trim($("#cuilAlumnos2").val());
    domicilioAlumnos = $.trim($("#domicilioAlumnos2").val());
    emailAlumnos = $.trim($("#emailAlumnos2").val());
    telefonoAlumnos = $.trim($("#telefonoAlumnos2").val());
    discapasidadAlumnos = $.trim($("#discapasidadAlumnos2").val());
   
    nombreTutor = $.trim($("#nombreTutor2").val());
    dniTutor = $.trim($("#dniTutor2").val());
    TelefonoTutor = $.trim($("#TelefonoTutor2").val());
    idPlanEstudio = $.trim($("#idPlanEstudio").val());

     fechaNacimiento = $.trim($("#fechaNacimiento").val());
    nLegajo = $.trim($("#nLegajo").val());
    nacido = $.trim($("#nacido").val());
    procedencia = $.trim($("#procedencia").val());
    nacionalidadTutor = $.trim($("#nacionalidadTutor").val());
    pass = $.trim($("#pass").val());

 
 



    $.ajax({
        
        url: "modulos/cargaDatos/datosAlumno/elementos/crud_datos_Plan_Alumnos.php",
        type: "POST",
        dataType: "json",
        data: {nombreAlumnos:nombreAlumnos, dniAlumnos:dniAlumnos, cuilAlumnos:cuilAlumnos, domicilioAlumnos:domicilioAlumnos, emailAlumnos:emailAlumnos, telefonoAlumnos:telefonoAlumnos, discapasidadAlumnos:discapasidadAlumnos, nombreTutor:nombreTutor, dniTutor:dniTutor, TelefonoTutor:TelefonoTutor,  opcion:opcion, idAlumnos:idAlumnos, idPlanEstudio:idPlanEstudio, fechaNacimiento:fechaNacimiento, nLegajo:nLegajo, nacido:nacido, procedencia:procedencia, nacionalidadTutor:nacionalidadTutor, pass:pass},
        beforeSend: function() {
                                $("#imagenProceso").show();
                                
                              },
        success: function(data){ 

        console.log(data) 

            idAlumnos = data[0].idAlumnos;            
            nombreAlumnos = data[0].nombreAlumnos;
            dniAlumnos = data[0].dniAlumnos;
            idPlanEstudio = data[0].idPlanEstudio;
            if(opcion == 1){tablaAlumno.row.add([idAlumnos,dniAlumnos,nombreAlumnos]).draw();}
            else{tablaAlumno.row(fila).data([idAlumnos,dniAlumnos,nombreAlumnos]).draw();} 
             $("#imagenProceso").hide();
                                 
            
        }        
    });
    $("#modalCRUD_Alumno").modal("hide"); 

 $.unblockUI();   
    
});    
    

    
});


 $.unblockUI();

</script>

