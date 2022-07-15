
 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

if  (isset($_SESSION['idUsuario'])) {


                                                        
        $id_docente=$_SESSION["idUsuario"];
        $cargo=$_SESSION["cargo"];
  


 
$consulta = "SELECT `id_generar_pedido`, `id_docente`, `titpo`, `descripcion`, `email_envio`, `email_envio_copia`, `fecha`, `cargo` FROM `generar_pedido_administracion` WHERE `id_docente`='$id_docente' AND `cargo`='$cargo'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<h2>LISTA DE USUARIOS ADMINISTRADORES DEL SITIO</h2>
<br><br>
<button class="btn btn-info" title="NUEVO Pedido" onclick="Agregar()"><i class='fas fa-user-plus'></i></button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>
<button class="btn btn-danger" title="Seleccionar TODO o NINGUNO" onclick="seleccionarTODO()" class="obtener">Select/NoSelect</button>

<hr>
    <table id="tabla_Administradores" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>N</th>
             <th>Detalle de Pedido</th>
            
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>
            <td><?php echo $dat['id_generar_pedido'] ?></td>
            <td><b>Fecha: </b><?php echo $dat['fecha'] ?><br><b>Tipo de Pedido: </b><?php echo $dat['titpo'] ?><br><b>Descripción de Pedido: </b><?php echo $dat['descripcion'] ?><br><b>Email donde se mando una copia: </b><?php echo $dat['email_envio_copia'] ?></td>
          
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
                <th>N</th>
                 <th>Detalle de Pedido</th>  
            
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
      
             
                <input type="text" class="form-control" id="id"  >
                <input type="text" class="form-control" id="opcion" >
                
                    <div class="modal-body">

                <?php
       
                  $cat="";

 
                  $consulta = "SELECT DISTINCT `tipo` FROM `correos`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $tipo=$da1t['tipo'];

                     $cat.="<option>".$tipo."</option>";


                  }

                ?>


                
                <div class="mb-3">
                <label for="tipo" class="col-form-label">Tipo de Pedido:</label>
                       <select class="form-control" id="tipo">
                        
                        <?php echo $cat;  ?>
                        
                        </select>

                </div>
                <hr>
                <div class="mb-3">
                <label for="descripcion" class="col-form-label">Descripción:</label>
                <textarea class="form-control" rows="5" id="descripcion"></textarea>
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


function Agregar () {

    $("#formPersonasUsuario").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar datos del Usuario"); 
    $("#id").val(null);
    $("#opcion").val(1);
    $("#modalCRUD_Usuario").modal("show"); 



}





var arrayContieneLosElementosAEliminar =[];
var selector=0;



//  selecciono particular o grupal, agrego en un array 

$('#tabla_Administradores tbody').on('click', 'tr', function () {
        
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


    console.log(arrayContieneLosElementosAEliminar.length);

} );











function editarEliminar(){


    if (arrayContieneLosElementosAEliminar.length!=0) {
Swal.fire({
  title: 'Eliminar este registro',
  text: "se eliminara este registro",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI'
}).then((result) => {
  if (result.isConfirmed) {
         eliminar_FINAL();
  }
})



    }else{

        toastr.warning('No selecciono ninguno');

    }















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
            url: "modulos/gestionAcademicaDocente/generarPedido/elementos/enviarEliminar.php",
            type: "POST",
            data: {arrayContieneLosElementosAEliminar:arrayContieneLosElementosAEliminar},
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
       
                tipo=$('#tipo').val();
                descripcion= $('#descripcion').val();
                emailCopia= $('#emailCopia').val();
                id= $("#id").val();
                opcion= $("#opcion").val();


    formData.append('id_generar_pedido', id);
    formData.append('fecha', fecha);
    formData.append('tipo', tipo);
    formData.append('descripcion', descripcion);
    formData.append('emailCopia', emailCopia);
    formData.append('opcion', opcion);



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






}




function finalizarTramite(formData){

                $.ajax({
                
                url:'modulos/gestionAcademicaDocente/generarPedido/elementos/enviar.php',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,

                success: function(respuesta){

                v=respuesta.split('|||&|||');

             
                id_generar_pedido = v[1];
                fecha = v[2];
                titpo = v[3];
                descripcion = v[4];
                email_envio_copia = v[5];
                      
                numero= myTable.rows( '.selected' )[0][0];

          
                situac= `
                <td><b>Fecha: </b>`+fecha+`<br><b>Tipo de Pedido: </b>`+titpo+`<br><b>Descripción de Pedido: </b>`+descripcion+`<br><b>Email donde se mando una copia: </b>`+email_envio_copia+`</td>`
                    console.log(situac);

                    myTable.row.add([id_generar_pedido,situac]).draw();

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

