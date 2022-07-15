
 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

if (isset($_SESSION['idUsuario'])){


                                                        
        $id_docente=$_SESSION["idUsuario"];
        $tipoProfesor=$_SESSION["tipoProfesor"];
 
$consulta = "SELECT generar_pedido_docente.id_generar_pedido, generar_pedido_docente.id_docente, generar_pedido_docente.titpo, generar_pedido_docente.descripcion, generar_pedido_docente.email_envio, generar_pedido_docente.email_envio_copia, generar_pedido_docente.situacion, generar_pedido_docente.fecha, datos_docentes.nombre, datos_docentes.dni, datos_docentes.email, datos_docentes.telefono, datos_docentes.titulo FROM generar_pedido_docente INNER JOIN datos_docentes ON datos_docentes.idDocente= generar_pedido_docente.id_docente WHERE generar_pedido_docente.titpo='$tipoProfesor'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<h2>LISTA DE USUARIOS ADMINISTRADORES DEL SITIO</h2>
<br><br>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>

<hr>
    <table id="tabla_Administradores" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>N</th>
            <th>DETALLE DEL PEDIDO</th>
            <th>SITUACIÓN</th>  
            
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>
            <td><?php echo $dat['id_generar_pedido'] ?></td>
            <td>
                <b>Apellido y Nombre: </b><?php echo $dat['nombre'] ?>; <b>DNI: </b><?php echo $dat['dni'] ?><br>
                <b>Correo del Profesor: </b><?php echo $dat['email'] ?>; <b>Telefono: </b><?php echo $dat['telefono'] ?><br>
                <b>Fecha: </b><?php echo $dat['fecha'] ?><br><b>Tipo de Pedido: </b><?php echo $dat['titpo'] ?><br><b>Descripción de Pedido: </b><?php echo $dat['descripcion'] ?><br><b>Email donde se mando una copia: </b><?php echo $dat['email_envio_copia'] ?></td>
            <td><?php echo $dat['situacion'] ?></td>
          
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
                <th>N</th>
                <th>DETALLE DEL PEDIDO</th>
                <th>SITUACIÓN</th>  
            
        </tr>
    </tfoot>
</table>



<div class="modal fade" id="modalCRUD_Usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
                <div class="modal-body">

          
                <input type="text" class="form-control" id="id"  hidden=''>
                <input type="text" class="form-control" id="opcion" hidden=''>
                

                <div class="mb-3">
                <label for="situacion" class="col-form-label">Descripción:</label>
                <textarea class="form-control" rows="5" id="situacion"></textarea>
                </div>
                <hr>
                <div class="mb-3">
                <div id="tex"><label for="emailCopia" class="form-label">Se mandara una copia a este correo (Verificando)</label></div>
               
                <input type="email" class="form-control" id="emailCopia" aria-describedby="emailHelp">
                
                <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
              
                </div>
            
                   
                <hr>
             



        <div id="container-input">
            <div class="wrap-file">


              
                <div class="content-icon-camera">
                    <input type="file" id="file" name="file[]" multiple />
                    <div class="icon-camera"></div>
                </div>
                <div id="preview-images">
                    
                </div>
            </div>
            
           
        </div>


 



            </div>  
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="agregar_editar ()"> <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>








   
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();


    var myTable = $('#tabla_Administradores').DataTable({
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
          confirmButtonText: 'Responder',
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
    $("#situacion").val(dataFila[2]);
    $("#opcion").val(2);
    

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Usuario");            
    $("#modalCRUD_Usuario").modal("show");  


}


    var file = document.getElementById('file');
    var formData = new FormData();

    var cantidadArchivos=0;

   file.addEventListener('change', function (e) {

        for ( var i = 0; i < file.files.length; i++ ) {
            var thumbnail_id = Math.floor( Math.random() * 30000 ) + '_' + Date.now();

            nombreArchivo=file.files[i].name;
            createThumbnail(file, i, thumbnail_id,nombreArchivo);
            formData.append(thumbnail_id, file.files[i]);
            cantidadArchivos++;
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
            cantidadArchivos--;
        }
    });





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
   


        
        $.ajax({
            url: "modulos/gestionAcademicaDocente/generarPedidoAdmin/elementos/eliminar_pedido_Docente.php",
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



        var f = new Date();
        fecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
        situacion=$('#situacion').val();
        emailCopia= $('#emailCopia').val();



        if (situacion!='') {
            id= $("#id").val();
            opcion= $("#opcion").val();

    formData.append('id_generar_pedido', id);
    formData.append('fecha', fecha);
    formData.append('situacion', situacion);
    formData.append('emailCopia', emailCopia);
    formData.append('opcion', opcion);


        dataFila.push(fecha);
        dataFila.push(situacion);
   




if ((emailCopia!='') && (cantidadArchivos != 0)) {


                        if (verificacionEmail==1) {

                        Swal.fire({
                                  title: '¡Esta seguro de Generar un pedido!',
                                  text: "Una vez generado el pedido no se podra anular",
                                  icon: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Si, Generar el Pedido'
                                }).then((result) => {
                                  if (result.isConfirmed) {


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

                                    

                                    finalizarTramite(formData);
                                    $("#modalCRUD_GenerarPedido").modal("hide");


                                  }else{



                                     toastr.error('El pedido fue anulado');
                                     $("#modalCRUD_GenerarPedido").modal("hide");
                                     

                                  }
                                })


                        }else{

                                    toastr.error('Verifique que el Correo electrónico');


                        }


                    }else{

               

                            if ( (emailCopia!='') == false ) {

                                toastr.error('No se enviara ninguna copia  !!!');
                            }

                             if ( (cantidadArchivos != 0) == false ) {

                                toastr.error('No se está adjuntando ningún archivo !!!');
                            }





                                  Swal.fire({
                                  title: '¡Esta seguro de Generar un pedido!',
                                  text: "Una vez generado el pedido no se podra anular",
                                  icon: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Si, Generar el Pedido'
                                }).then((result) => {
                                  if (result.isConfirmed) {


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

                                    

                                    finalizarTramite(formData);
                                    $("#modalCRUD_GenerarPedido").modal("hide");


                                  }else{



                                     toastr.success('El pedido fue anulado');
                                     $("#modalCRUD_GenerarPedido").modal("hide");
                                 

                                  }
                                })





                    }



 }else{

    toastr.error('Uno de los campos está incompleto o no seleccionado !!!');

 }


}




function finalizarTramite(formData){



                $.ajax({
                
                url:'modulos/gestionAcademicaDocente/generarPedidoAdmin/elementos/enviarProfesor.php',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,

                success: function(respuesta){
                      
                numero= myTable.rows( '.selected' )[0][0]

          
                situac= 'Fecha: '+dataFila[3]+' Resolución: '+dataFila[4]

                myTable.row(":eq("+numero+")").data([dataFila[0],dataFila[1],situac]);
                    clearFormDataAndThumbnails();

                    
                        toastr.success('¡Operación exitosa!');
                        toastr.info('¡Petición exitosa!');
                        Swal.fire('Espere que el establecimiento se comunique con usted');
                  
                        


                   
                   
                    $.unblockUI();
                 },




});  


}






 $.unblockUI();
 

</script>



<?php } ?>

