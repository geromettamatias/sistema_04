

<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  <b>DATOS DEL DIRECTIVO</b>
                </h3>
              </div>
              <div class="card-body">

            
                <button id="btnNuevo_Directivo" type="button" class="btn btn-success" data-toggle="modal" title="DATOS- Editar"><i class='fas fa-edit'></i></button><br> <hr>    



                    <u><b>Director</b></u>
                 <b>Nombre y Apellido:</b><div id="nombreDirectivos" style="color:#FF0000";></div>
                 <b>Datos:</b><div id="datosDirectivos" style="color:#FF0000";></div><hr>
                 <u><b>Vice-Director</b></u>
                 <b>Nombre y Apellido:</b><div id="nombreviceDirector" style="color:#FF0000";></div>
                 <b>Datos:</b><div id="datosviceDirector" style="color:#FF0000";></div><hr>
                 <u><b>Asesor Pedag.</b></u>
                 <b>Nombre y Apellido:</b><div id="nombreasesora" style="color:#FF0000";></div>
                 <b>Datos:</b><div id="datosasesora" style="color:#FF0000";></div>



               
              </div>
              <!-- /.card -->
            </div>





<div class="modal fade" id="modalCRUD_DatosDirectivos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="formDatosDirec">    
                         
            <div class="modal-body">
                

                <div class="form-group">
                <label for="nombreDirectivosf" class="col-form-label">Nombre del Director:</label>
                <input type="text" class="form-control" id="nombreDirectivosf">
                </div>
                <div class="form-group">
                <label for="datosDirectivosf" class="col-form-label">Datos del Director:</label>
                <input type="text" class="form-control" id="datosDirectivosf">
                </div>
                <div class="form-group">
                <label for="nombreviceDirectorf" class="col-form-label">Nombre del Vice-Director:</label>
                <input type="text" class="form-control" id="nombreviceDirectorf">
                </div>
                <div class="form-group">
                <label for="datosviceDirectorf" class="col-form-label">Datos del Vice-Director:</label>
                <input type="text" class="form-control" id="datosviceDirectorf">
                </div>
                <div class="form-group">
                <label for="nombreasesoraf" class="col-form-label">Nombre del Asesor:</label>
                <input type="text" class="form-control" id="nombreasesoraf">
                </div>
                <div class="form-group">
                <label for="datosasesoraf" class="col-form-label">Datos del Asesor:</label>
                <input type="text" class="form-control" id="datosasesoraf">
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
$(document).ready(function(){






    
$('#imagenProceso').hide();
datosDirectivosAdmin();

$("#btnNuevo_Directivo").click(function(){

    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Edite los Datos del Directivos");            
    $("#modalCRUD_DatosDirectivos").modal("show");

    datosDirectivosAdmin(); 


}); 






$("#formDatosDirec").submit(function(e){
    e.preventDefault();    
 
    nombreDirectivos= $("#nombreDirectivosf").val();
    datosDirectivos= $("#datosDirectivosf").val();

    nombreviceDirector= $("#nombreviceDirectorf").val();
    datosviceDirector= $("#datosviceDirectorf").val();

    nombreasesora= $("#nombreasesoraf").val();
    datosasesora= $("#datosasesoraf").val();

 console.log({nombreDirectivos:nombreDirectivos, datosDirectivos:datosDirectivos, nombreviceDirector:nombreviceDirector, datosviceDirector:datosviceDirector, nombreasesora:nombreasesora, datosasesora:datosasesora});

    $.ajax({
        url: "modulos/paginaInicio/directivos/elementos/DatosDirectivos.php",
        type: "POST",
        dataType: "json",
        data: {nombreDirectivos:nombreDirectivos, datosDirectivos:datosDirectivos, nombreviceDirector:nombreviceDirector, datosviceDirector:datosviceDirector, nombreasesora:nombreasesora, datosasesora:datosasesora},
        success: function(data){  
            console.log(data);

            nombreDirectivos = data.director.nombreDirectivos;
            datosDirectivos = data.director.datosDirectivos;

            nombreviceDirector = data.viceDirector.nombreviceDirector;
            datosviceDirector = data.viceDirector.datosviceDirector;

            nombreasesora = data.asesora.nombreasesora;
            datosasesora = data.asesora.datosasesora;

            $("#nombreDirectivos").html(nombreDirectivos);
            $("#nombreDirectivosf").val(nombreDirectivos);  
            $("#datosDirectivos").html(datosDirectivos);
            $("#datosDirectivosf").val(datosDirectivos);

            $("#nombreviceDirector").html(nombreviceDirector);
            $("#nombreviceDirectorf").val(nombreviceDirector);  
            $("#datosviceDirector").html(datosviceDirector);
            $("#datosviceDirectorf").val(datosviceDirector);
            
            $("#nombreasesora").html(nombreasesora);
            $("#nombreasesoraf").val(nombreasesora);  
            $("#datosasesora").html(datosasesora);
            $("#datosasesoraf").val(datosasesora);

                  
        }        
    });
    $("#modalCRUD_DatosDirectivos").modal("hide");    
    
});    
    

    
});



function datosDirectivosAdmin() {

   
  
    $.ajax({
        url: "modulos/paginaInicio/directivos/elementos/DatosDirectivosLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            nombreDirectivos = data.director.nombreDirectivos;
            datosDirectivos = data.director.datosDirectivos;

            nombreviceDirector = data.viceDirector.nombreviceDirector;
            datosviceDirector = data.viceDirector.datosviceDirector;

            nombreasesora = data.asesora.nombreasesora;
            datosasesora = data.asesora.datosasesora;

            $("#nombreDirectivos").html(nombreDirectivos);
            $("#nombreDirectivosf").val(nombreDirectivos);  
            $("#datosDirectivos").html(datosDirectivos);
            $("#datosDirectivosf").val(datosDirectivos);

            $("#nombreviceDirector").html(nombreviceDirector);
            $("#nombreviceDirectorf").val(nombreviceDirector);  
            $("#datosviceDirector").html(datosviceDirector);
            $("#datosviceDirectorf").val(datosviceDirector);
            
            $("#nombreasesora").html(nombreasesora);
            $("#nombreasesoraf").val(nombreasesora);  
            $("#datosasesora").html(datosasesora);
            $("#datosasesoraf").val(datosasesora);

                  
        }        
    });
}

 $.unblockUI();
</script>

