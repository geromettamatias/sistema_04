


  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Datos del Aplicativo</h3>

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
                  

            


                <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

            
             
                <input type="text" id="servidor" value="<?php echo $_SERVER['HTTP_HOST']; ?>"  hidden="">

               
<button type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal" id="btnEditar"><i class='fas fa-edit'></i> </button><br><hr>



    
<div class="table-responsive">        
  <table  class="table table-striped table-bordered" cellspacing="0" width="100%">

                        <thead>
                            <tr> 
                                                  
                         
                                <th scope="col">TITULO</th>
                                <th scope="col">TITULO DEL MENÚ</th>
                                <th scope="col">IMAGEN</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                          
                            
                                <tr class="table-success">
                                    <td id="tituloFF"></td>
                                    <td id="tituloMenuFF"></td>
                                    <td ><button class="btn btn-info btnReVisor_pdf">VER</button></td>
                             
                                    
                                </tr>
                          
                        </tbody>
                    </table>
                  

               
              </div>
              <!-- /.card -->
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










<div class="modal fade" id="modalCRUD_DATOS" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="formDato">    
                         
            <div class="modal-body">




                                  <div class="input-group input-group-sm mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">TITULO:</span></div>

                                    <input id="tituloS" name="text" type="text" class="form-control"   placeholder="TITULO DEL SITIO" required>
                                  </div>

                                  <div class="input-group input-group-sm mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">TITULO DEL MENÚ:</span></div>

                                    <input id="tituloMenuS" name="text" type="text" class="form-control"  placeholder="TITULO DEL SITIO" required>
                                  </div>


                       

                                <div class="input-group input-group-sm mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><img style="width: 30px;" src="modulos/cargaDatos/datosSitio//pdf1.png" class="card-img-top" id="mostrarimagen"> IMAGEN PNG:</span></div>


                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="seleccionararchivo" name="seleccionararchivo" lang="es" accept="application/png" title="Solo formato PNG" >

                                      <label class="custom-file-label" for="seleccionararchivo"> Ej: logo.png</label>
                                    </div>

                                    <br><br>


                                           <div class="input-group input-group-sm mb-3">
                                  <div class="input-group-prepend">
                                   

                                    <dir id="informvarT"></dir>

                                  </div>


                                    
                                  </div>





                              
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




  <script type="text/javascript">
   $(document).ready(function() { 
   $('#imagenProceso').hide();
      $('#cargaCiclo').hide();
    datosIntitucion();

document.getElementById("seleccionararchivo").addEventListener("change", () => {
           

            // selecionamos la imagen
            var imagenPrevisualizacion = document.querySelector("#mostrarimagen");

            //  verificamos que sea PDF
            var archivoInput=document.getElementById("seleccionararchivo");
            var archivoRuta = archivoInput.value;
            var extPermitidas= /(.png)$/i;

            if (!extPermitidas.exec(archivoRuta)) {
                Swal.fire('Mensaje De Advertencia',"Solo se puede subir documentos PDF","warning");
                 imagenPrevisualizacion.src = "modulos/cargaDatos/datosSitio/pdf1.png";
                 $('#informvarT').html('');

                 $('#seleccionararchivo').val("");

            }else{
            // 
            
            archivo = $("#seleccionararchivo").val();
            $('#informvarT').html("Dirección: "+archivo);
            imagenPrevisualizacion.src = 'modulos/cargaDatos/datosSitio/pdf.png';


            }
        });



//  visor

var fila; //capturar la fila para editar o borrar el registro
    



$(document).on("click", ".btnReVisor_pdf", function(){



    $.ajax({
        url: "modulos/cargaDatos/datosSitio/elementos/datoAplicativoLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
         beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnEditar").disabled = true;
                                $('#cargaCiclo').show();
                              },
        success: function(data){  
       
            titulo = data.titulo;
            tituloMenu = data.tituloMenu;
            url = data.url;
            
         
         servidor=$("#servidor").val();

         vari= 'http://'+servidor+'/sistema/elementos/'+url;


         window.open(vari, '_blank');


         $("#imagenProceso").hide();
                                document.getElementById("btnEditar").disabled = false;
                                $('#cargaCiclo').hide();
         
     
                  
        }        
    });
   

                                  
                            
   
});








// fin del visor






$("#btnEditar").click(function(){

    
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar");            
    $("#modalCRUD_DATOS").modal("show"); 


    
}); 




    $("#formDato").submit(function(e){
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

    

            var tituloS = $("#tituloS").val();
       var tituloMenuS = $("#tituloMenuS").val();
       var archivo = $("#seleccionararchivo").val();

       if (archivo) {

              var formData= new FormData();
            var png = $("#seleccionararchivo")[0].files[0];

             var imagenEliminar = $("#tituloMenuURL").val();




             formData.append('imagenEliminar',imagenEliminar);

            formData.append('png',png);
            formData.append('tituloS',tituloS);
            formData.append('tituloMenuS',tituloMenuS);

           $('#tituloMenuURL').val(png["name"]);

            $.ajax({
                
                url:'modulos/cargaDatos/datosSitio/elementos/datoAplicativoEditar.php',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
                beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnEditar").disabled = true;
                                $('#cargaCiclo').show();
                              },
                error : function(xhr, status) {
                    alert('Disculpe, existió un problema');
                },

                // código a ejecutar sin importar si la petición falló o no
                complete : function(xhr, status) {
                   
                  
                },
                success: function(respuesta){

                    $("#imagenProceso").hide();
                                document.getElementById("btnEditar").disabled = false;
                                $('#cargaCiclo').hide();

                    if (respuesta!=0) {


                      
                      datosIntitucion();
                      $('#titulo').html('<title>'+tituloS+'</title>');    
                      $("#tituloMenu").html(tituloMenuS);
                                 

                                             

                     }else{
                        alert("Error");
                    }

                     




              

                }
            });

       
   
    $("#modalCRUD_DATOS").modal("hide");  

    
    
                                          
}else{

  
            var formData= new FormData();
            var png = $("#tituloMenuURL").val();




            formData.append('png',png);
            formData.append('tituloS',tituloS);
            formData.append('tituloMenuS',tituloMenuS);

           
            $.ajax({
                
                url:'modulos/cargaDatos/datosSitio/elementos/datoAplicativoEditar2.php',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
                beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnEditar").disabled = true;
                                $('#cargaCiclo').show();
                              },
                error : function(xhr, status) {
                    alert('Disculpe, existió un problema');
                },

                // código a ejecutar sin importar si la petición falló o no
                complete : function(xhr, status) {
                   
                 
                },
                success: function(respuesta){

                    $("#imagenProceso").hide();
                                document.getElementById("btnEditar").disabled = false;
                                $('#cargaCiclo').hide();

                    if (respuesta!=0) {


                  
                      datosIntitucion();
                      $('#titulo').html('<title>'+tituloS+'</title>');    
                      $("#tituloMenu").html(tituloMenuS);
                                  

                     }else{
                        alert("Error");
                    }

                     




              

                }
            });

       
   
    $("#modalCRUD_DATOS").modal("hide");  


}


$.unblockUI();
});

 


   

});    



function datosIntitucion() {

   
  
    $.ajax({
        url: "modulos/cargaDatos/datosSitio/elementos/datoAplicativoLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btnEditar").disabled = true;
                                $('#cargaCiclo').show();
                              },
        success: function(data){  
       
            titulo = data.titulo;
            tituloMenu = data.tituloMenu;
            url = data.url;
            
          
   
            $("#tituloFF").html(titulo);   
            $("#tituloMenuFF").html(tituloMenu);
          
            $('#tituloS').val(titulo); 
            $('#tituloMenuS').val(tituloMenu);

         
            $('#logoImagenF').val('<img src="../elementos/'+url+'" type="reset"  style="width: 40%;" class="mx-auto d-block">');


            var imagenPrevisualizacion = document.querySelector("#mostrarimagenLo");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacion.src = "../elementos/"+url+"";


             var imagenPrevisualizacionFFF = document.querySelector("#mostrarimagenLoFFF");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacionFFF.src = "../elementos/"+url+"";    




           // var imagenPrevisualizacion = document.querySelector("#logoImagen");

            //  verificamos que sea PDF
           
             //    imagenPrevisualizacion.src = ""+url+"";


             $("#imagenProceso").hide();
                                document.getElementById("btnEditar").disabled = false;
                                $('#cargaCiclo').hide();


                  
        }        
    });
}



 $.unblockUI();

</script>



