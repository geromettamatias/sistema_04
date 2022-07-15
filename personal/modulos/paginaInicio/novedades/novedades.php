

<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  <b>NOVEDADES</b>
                </h3>
              </div>
              <div class="card-body">

            
                

                <button id="edit" class="btn btn-secondary" onclick="edit()" type="button" title="EDITAR"><i class='fas fa-edit'></i></button>
                <button id="save" class="btn btn-primary" onclick="save()" type="button" title="PRECENTAR"><i class='fas fa-edit'></i></button>
                <button id="btnNuevo_Novedades" type="button" class="btn btn-danger" onclick="guardarFinal()" title="GUARDAR"><i class='fas fa-edit'></i></button>
                    


                <br> <hr>    



                  <b>Información:</b><div id="novedadesLeer" ></div>


                 
                    </div>
              <!-- /.card -->
            </div>










 <script type="text/javascript">

$('#imagenProceso').hide();
novedades();

    function edit() {
  $('#novedadesLeer').summernote({focus: true});
};

function save() {
  var markup = $('.click2edit').summernote('code');
  $('#novedadesLeer').summernote('destroy');
};



function guardarFinal(){
    $('#novedadesLeer').summernote('destroy');
    novedadesLeer= $("#novedadesLeer").html();
   

 console.log({novedadesLeer:novedadesLeer});

    $.ajax({
        url: "modulos/paginaInicio/novedades/elementos/novedadesEditar.php",
        type: "POST",
        dataType: "json",
        data: {novedadesf:novedadesLeer},
        success: function(data){  
            console.log(data);

            informe = data.novedades.informe;
           
            $('#novedadesLeer').summernote('destroy');
            $("#novedadesLeer").html(informe);
          

                  
        }        
    });
  
    
} 



function novedades() {

   
  
        $.ajax({
        url: "modulos/paginaInicio/novedades/elementos/novedadesLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            informe = data.novedades.informe;
       
            $("#novedadesLeer").html(informe);
         

                  
        }        
    });
}

 $.unblockUI();
</script>

