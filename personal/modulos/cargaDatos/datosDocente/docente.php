
<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();

$operacion=$_SESSION["operacion"];



        $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes`";
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
                <h3 class="card-title">LISTA DOCENTE Y NO DOCENTE</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">


  <?php if (($operacion=='Lectura y Escritura') || ($_SESSION['cargo'] == 'Administrador')){ ?>

<h5>Carga Por Planilla <a download="docente" href="modulos/cargaDatos/datosDocente/docente.csv">MODELO EXCEL FORMATO (CSV DELIMITADO POR COMAS)</a></h5>
  <div id="container-input">
            <div class="wrap-file">


              
                <div class="content-icon-camera">


                    <input class="btn btn-success" type="file" id="file" name="file[]" accept=".csv" />
                    <div class="icon-camera"></div>
                </div>
                <div id="preview-images">
                    
                </div>
            </div>
            
           
        </div>


        <button type="submit" class="btn btn-dark" onclick="publicar()"> <i class='fas fa-save'></i> SUBIR ARCHIVO</button>
<hr><br>




<?php } ?>





                    <hr>
                  

             <?php if ($operacion=='Lectura y Escritura'){ ?>

                    <button class="btn btn-info" title="NUEVO DOCENTE" onclick="Agregar()"><i class='fas fa-user-plus'></i> NUEVO DOCENTE</button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i> EDITAR/ELIMINAR</button>

<button class="btn btn-warning" title="CAMBIAR DE ESTADO" onclick="estadoCambiar()"><i class="fas fa-sync fa-spin"></i> CAMBIAR DE ESTADO</button>

<?php } ?>



<button class="btn btn-info" title="CARGA HORAS/CARGOS" onclick="cagrarHorasCargo()"><i class="fas fa-paperclip"></i>CARGA HORAS/CARGOS</button>

<hr>

<div class="table-responsive">
    <table id="tabla_Administradores" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>N°</th>
             <th>ESTADO</th>
             <th>DNI</th>
             <th>DOCENTE</th>
             <th>CONTRASEÑA</th>
             <th>DOMICILIO</th>
             <th>EMAIL</th>
             <th>TELEFONO</th>
             <th>TITULO</th>
             <th>C/HIJO</th>    
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>
            <td><?php echo $dat['idDocente'] ?></td>
            <td><?php 

                $estado=$dat['estado'];

                if ($estado=='DESACTIVO') {
                    echo '<font color="red">DESACTIVO</font>';
                }else if($estado=='ACTIVO'){

                    echo '<font color="green">ACTIVO</font>';

                }


                ?></td>
            <td><?php echo $dat['dni'] ?></td>
            <td><?php echo $dat['nombre'] ?></td>
            <td><?php echo base64_decode ($dat['passwordDocente']); ?></td>
            <td><?php echo $dat['domicilio'] ?></td>
            <td><?php echo $dat['email'] ?></td>
            <td><?php echo $dat['telefono'] ?></td>
            <td><?php echo $dat['titulo'] ?></td>
            <td><?php echo $dat['hijos'] ?></td>
          


        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
             <th>N°</th>
             <th>ESTADO</th>
             <th>DNI</th>
             <th>DOCENTE</th>
             <th>CONTRASEÑA</th>
             <th>DOMICILIO</th>
             <th>EMAIL</th>
             <th>TELEFONO</th>
             <th>TITULO</th>
             <th>C/HIJO</th> 
            
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


<div class="modal fade" id="modalCRUD_DOCENTE" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <input type="text" class="form-control" id="idDocente" hidden='' >
                <input type="text" class="form-control" id="opcion" hidden=''>

                    <div class="form-group">
                    <label for="estado" class="col-form-label">Estado:</label>
                    <select class="form-control" id="estado">
                    <option>ACTIVO</option>
                    <option>DESACTIVO</option>
                   
                    </select>
                </div>
                       
                
                     <div class="form-group">
                <label for="nombreAlumnos2" class="col-form-label">Normbre y Apellido:</label>
                <input type="text" class="form-control" id="nombreD">
                </div>
                <div class="form-group">
                <label for="dniAlumnos2" class="col-form-label">DNI:</label>
                <input type="text" class="form-control" id="dniD">
                </div>
               
                <div class="form-group">
                <label for="domicilioAlumnos2" class="col-form-label">Domicilio:</label>
                <input type="text" class="form-control" id="domicilioD">
                </div>
                <div class="form-group">
                <label for="emailAlumnos2" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="emailD">
                </div>
                <div class="form-group">
                <label for="telefonoAlumnos2" class="col-form-label">Telefono:</label>
                <input type="text" class="form-control" id="telefonoD">
                </div>
                <div class="form-group">
                <label for="discapasidadAlumnos2" class="col-form-label">Titulo:</label>
                <input type="text" class="form-control" id="tituloD">
                </div>

                <div class="form-group">
                <label for="hijos" class="col-form-label">Posee Hijos en escolaridad? Indique en que nivel :</label>
                <input type="text" class="form-control" id="hijos">
                </div>
          
                <div class="form-group">
                <label for="passwordDocente" class="col-form-label">Contraseña:</label>
                <input type="text" class="form-control" id="passwordDocente">
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














  <?php if ($operacion=='Lectura y Escritura'){ ?>



function estadoCambiar(){


    if (preguntar==1) {



        idDocente=dataFila[0];  
        
        dni = dataFila[2];
        nombre = dataFila[3];
        password = dataFila[4];
        domicilio = dataFila[5];
        email = dataFila[6];
        telefono = dataFila[7];
        titulo = dataFila[8];
        hijos = dataFila[9];


        estado=dataFila[1];
     

        if (estado=='<font color="red">DESACTIVO</font>') {
            estado='<font color="green">ACTIVO</font>';
            estadoF='ACTIVO';
            
        }else if(estado=='<font color="green">ACTIVO</font>'){
            estado='<font color="red">DESACTIVO</font>';
            estadoF='DESACTIVO';
        }


         dataFila=[];
                        dataFila.push(idDocente);
                        dataFila.push(estado);
                        dataFila.push(dni);
                        dataFila.push(nombre);
                        dataFila.push(password);
                        dataFila.push(domicilio);
                        dataFila.push(email);
                        dataFila.push(telefono);
                        dataFila.push(titulo);
                        dataFila.push(hijos);


            console.log(dataFila);
  


                numero= myTable.rows( '.selected' )[0][0];


               

                myTable.row(":eq("+numero+")").data([idDocente,estado,dni,nombre,password,domicilio,email,telefono,titulo,hijos]);

            
           
    
        $.ajax({
            url: "modulos/cargaDatos/datosDocente/elementos/cambiarEstado.php",
            type: "POST",
            data: {idDocente:idDocente,estado:estadoF},
               success: function(data){  
           
           

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        } 
        });





    }else{

        toastr.warning('No selecciono ninguno');

    }

}






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


$("#idDocente").val(dataFila[0]);

estado=dataFila[1];



if (estado=='DESACTIVO') {
    estadoF = '<font color="red">DESACTIVO</font>';
    
}else if(estado=='ACTIVO'){

    estadoF = '<font color="green">ACTIVO</font>';
}
                  


                   



$("#dniD").val(dataFila[2]);
$("#nombreD").val(dataFila[3]);
$("#passwordDocente").val(dataFila[4]);
$("#domicilioD").val(dataFila[5]);
$("#emailD").val(dataFila[6]);
$("#telefonoD").val(dataFila[7]);
$("#tituloD").val(dataFila[8]);
$("#hijos").val(dataFila[9]);
$("#opcion").val(2);
    

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del docente");            
    $("#modalCRUD_DOCENTE").modal("show");  


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
            url: "modulos/cargaDatos/datosDocente/elementos/crud_datos_Plan_Docente.php",
            type: "POST",
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


$("#dniD").val('');
$("#nombreD").val('');
$("#passwordDocente").val('');
$("#domicilioD").val('');
$("#emailD").val('');
$("#telefonoD").val('');
$("#tituloD").val('');
$("#hijos").val('');
    
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar datos del docente"); 
    $("#idDocente").val(null);
    $("#opcion").val(1);
    $("#modalCRUD_DOCENTE").modal("show"); 



}





function agregar_editar () {
            

           $("#modalCRUD_DOCENTE").modal("hide"); 

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



idDocente=$("#idDocente").val();
estado=$("#estado").val();
dniD=$("#dniD").val();
nombreD=$("#nombreD").val();
passwordDocente=$("#passwordDocente").val();
domicilioD=$("#domicilioD").val();
emailD=$("#emailD").val();
telefonoD=$("#telefonoD").val();
tituloD=$("#tituloD").val();
hijos=$("#hijos").val();
opcion= $("#opcion").val();






    dataFila=[];
    dataFila.push(idDocente);
    dataFila.push(estado);
    dataFila.push(dniD);
    dataFila.push(nombreD);
    dataFila.push(passwordDocente);
    dataFila.push(domicilioD);
    dataFila.push(emailD);
    dataFila.push(telefonoD);
    dataFila.push(tituloD);
    dataFila.push(hijos);
    dataFila.push(opcion);

    console.log(dataFila)

    $.ajax({
        url: "modulos/cargaDatos/datosDocente/elementos/crud_datos_Plan_Docente.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
            console.log(data);
            idDocente = data[0].idDocente;            
            dni = data[0].dni;
            nombre = data[0].nombre;
            domicilio = data[0].domicilio;
            email = data[0].email;
            telefono = data[0].telefono;
            titulo = data[0].titulo;
            passwordDocente = data[0].passwordDocente;
            password=atob(passwordDocente);

            hijos = data[0].hijos;
            estado = data[0].estado;


                     dataFila=[];
                        dataFila.push(idDocente);
                        dataFila.push(estado);
                        dataFila.push(dni);
                        dataFila.push(nombre);
                        dataFila.push(password);
                        dataFila.push(domicilio);
                        dataFila.push(email);
                        dataFila.push(telefono);
                        dataFila.push(titulo);
                        dataFila.push(hijos);


                        if (estado=='DESACTIVO') {
                            estadoF = '<font color="red">DESACTIVO</font>';

                        }else if(estado=='ACTIVO'){

                            estadoF = '<font color="green">ACTIVO</font>';
                        }
                  


            if (opcion==1) {
                myTable.row.add([idDocente,estadoF,dni,nombre,password,domicilio,email,telefono,titulo,hijos]).draw();
            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([idDocente,estadoF,dni,nombre,password,domicilio,email,telefono,titulo,hijos]);

            }

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}



 

























    var formData = new FormData();

    var cantidadArchivos=0;

   file.addEventListener('change', function (e) {

        for ( var i = 0; i < file.files.length; i++ ) {
            var thumbnail_id = Math.floor( Math.random() * 30000 ) + '_' + Date.now();

            nombreArchivo=file.files[i].name;
            createThumbnail(file, i, thumbnail_id,nombreArchivo);
            formData.append(thumbnail_id, file.files[i]);
            cantidadArchivos=1;
        }

        

        e.target.value = '';

    });


  
 var createThumbnail = function (file, iterator, thumbnail_id,nombreArchivo) {
        var thumbnail = document.createElement('div');


        thumbnail.classList.add('thumbnail', thumbnail_id);
        thumbnail.dataset.id = thumbnail_id;

        // thumbnail.setAttribute('style', `background-image: url(${ URL.createObjectURL( file.files[iterator] ) })`);   imagen
        
     document.getElementById('preview-images').appendChild(thumbnail);
        createCloseButton(thumbnail_id,nombreArchivo);
    }

    var createCloseButton = function (thumbnail_id,nombreArchivo) {
        var closeButton = document.createElement('div');
        closeButton.classList.add('close-button');
        closeButton.innerText = '*) ELIMINAR: '+nombreArchivo;
        document.getElementsByClassName(thumbnail_id)[0].appendChild(closeButton);
    }

    var clearFormDataAndThumbnails = function () {
        for ( var key of formData.keys() ) {
            formData.delete(key);
            cantidadArchivos=0;
        }

        cantidadArchivos=0;

        document.querySelectorAll('.thumbnail').forEach(function (thumbnail) {
            thumbnail.remove();
        });
    }

    document.body.addEventListener('click', function (e) {
        if ( e.target.classList.contains('close-button') ) {
            e.target.parentNode.remove();
            formData.delete(e.target.parentNode.dataset.id);
            cantidadArchivos=0;
        }
    });






    function publicar(){

     
          if (cantidadArchivos==0) {
            toastr.error('No hay archivo seleccionado');
            return false;
          }


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
    


                    $.ajax({
                
               url:'modulos/cargaDatos/datosDocente/elementos/registrar.php',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
                
                success: function(respuesta){
                    
                    console.log(respuesta);

                    if (respuesta==1) {

                         $('#contenidoCursos').html('');
                        $('#tablaInstitucional').html('');
                        
                        $('#buscarTablaInstitucional').html('');
                        $('#contenidoAyuda').html(''); 
                        $('#tablaInstitucional').load('modulos/cargaDatos/datosDocente/docente.php');
    
                        toastr.success('¡Operación exitosa!');
                        toastr.info('¡Petición exitosa!');
                       

                    }else if (respuesta==2) {

                      
                        toastr.error('No podes editar cuando esta cerrado el ciclo');
                      

                    }else if (respuesta==2) {

                      
                        toastr.error('No podes editar cuando esta cerrado el ciclo');
                      

                    }else if (respuesta=='La variable ciclo no esta') {

                      
                        toastr.error('La variable ciclo no esta');
                      

                    }else if (respuesta=='La variable curso no esta') {

                      
                        toastr.error('La variable curso no esta');
                      

                    }else{

                      
                        toastr.error('error de Servidor');
                      

                    }


                       
                    clearFormDataAndThumbnails();

                       

                        $.unblockUI();
                 },




});  
    }











 <?php } ?>




function cagrarHorasCargo(){



    if (preguntar==1) {



        idDocente=dataFila[0];  
        

    
        
   $.ajax({
          type:"post",
          data:'idDocente=' + idDocente,
          url:'modulos/cargaDatos/datosDocente/elementos/tablaasignDpce.php',
          success:function(r){ 


              ret=`<select class="form-control" id="cicloLectivoFina">
               
                `+r+`
                </select></div>`;
     

                  Swal.fire({
                          title: 'AÑO LECTIVO',
                          html:ret, 
                          focusConfirm: false,
                          showCancelButton: true,                         
                          }).then((result) => {
                            if (result.value) {                                             
                              cicloLectivoFina = document.getElementById('cicloLectivoFina').value;
                          
                              asignacionDocenteFinal(cicloLectivoFina,idDocente);
                                              
                            }
                    });

 
            
      


      }
        });





    }else{

        toastr.warning('No selecciono ninguno');

    }

}




function asignacionDocenteFinal(cicloLectivoFina,idDocente) {

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



     $.ajax({
          type:"post",
          data:'idDocente=' + idDocente + '&cicloLectivoFina=' + cicloLectivoFina,
          url:'modulos/cargaDatos/datosDocente/elementos/docenteSEL.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){  
           
         
            $('#contenidoCursos').html('');
            $('#tablaInstitucional').html('');
            
            $('#buscarTablaInstitucional').html('');
            $('#contenidoAyuda').html(''); 
            $('#tablaInstitucional').load('modulos/cargaDatos/datosDocente/dj.php');
             $('#imagenProceso').hide();
          }
        });


}








</script>



