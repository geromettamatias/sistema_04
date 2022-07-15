


<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  <b>Datos</b>
                </h3>
              </div>
              <div class="card-body">

            
             

                     <button id="edit" class="btn btn-secondary" onclick="edit()" type="button" title="EDITAR"><i class='fas fa-edit'></i></button>
                <button id="save" class="btn btn-primary" onclick="save()" type="button" title="PRECENTAR"><i class='fas fa-edit'></i></button>
                <button id="btnNuevo_Novedades" type="button" class="btn btn-danger" onclick="guardarFinal()" title="GUARDAR"><i class='fas fa-edit'></i></button>
                    


                <br> <hr>    



                  <b>Información:</b><div id="historiaLeer" ></div>


                 

               
              </div>
              <!-- /.card -->
            </div>






 <script type="text/javascript">
 

$('#imagenProceso').hide();
historia();

    function edit() {
  $('#historiaLeer').summernote({focus: true});
};

function save() {
  var markup = $('.click2edit').summernote('code');
  $('#historiaLeer').summernote('destroy');
};



function guardarFinal(){
    $('#historiaLeer').summernote('destroy');
    historiaLeer= $("#historiaLeer").html();
   

 console.log({historiaLeer:historiaLeer});

    $.ajax({
        url: "modulos/paginaInicio/historia/elementos/historiaEditar.php",
        type: "POST",
        dataType: "json",
        data: {historiaf:historiaLeer},
        success: function(data){  
            console.log(data);

            informe = data.historia.informe;
           
            $('#historiaLeer').summernote('destroy');
            $("#historiaLeer").html(informe);
          

                  
        }        
    });
  
    
} 



function historia() {

   
  
        $.ajax({
        url: "modulos/paginaInicio/historia/elementos/historiaLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            informe = data.historia.informe;
           

            
            $("#historiaLeer").html(informe);

          


                  
        }        
    });
}

 $.unblockUI();
</script>

