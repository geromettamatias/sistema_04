





<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  <b>HISTORIA</b>
                </h3>
              </div>
              <div class="card-body">

            
             

                     <button id="edit" class="btn btn-secondary" onclick="edit()" type="button" title="EDITAR"><i class='fas fa-edit'></i></button>
                <button id="save" class="btn btn-primary" onclick="save()" type="button" title="PRECENTAR"><i class='fas fa-edit'></i></button>
                <button id="btnNuevo_Novedades" type="button" class="btn btn-danger" onclick="guardarFinal()" title="GUARDAR"><i class='fas fa-edit'></i></button>
                    


                <br> <hr>    



                  <b>Información:</b><div id="anunciosLeer" ></div>


                 

               
              </div>
              <!-- /.card -->
            </div>






 <script type="text/javascript">
 

$('#imagenProceso').hide();
anuncioAlumno();

    function edit() {
  $('#anunciosLeer').summernote({focus: true});
};

function save() {
  var markup = $('.click2edit').summernote('code');
  $('#anunciosLeer').summernote('destroy');
};



function guardarFinal(){
    $('#anunciosLeer').summernote('destroy');
    anunciosLeer= $("#anunciosLeer").html();
   

 console.log({anunciosLeer:anunciosLeer});

    $.ajax({
        url: "modulos/anuncios/alumnos/elementos/anuncioEditarAlumno.php",
        type: "POST",
        dataType: "json",
        data: {anunciosf:anunciosLeer},
        success: function(data){  
            console.log(data);

            informe = data.anuncio.informe;
           
            $('#anunciosLeer').summernote('destroy');
            $("#anunciosLeer").html(informe);
          

                  
        }        
    });
  
    
} 



function anuncioAlumno() {

   
  
        $.ajax({
        url: "modulos/anuncios/alumnos/elementos/anuncioLeerAlumno.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            informe = data.anuncio.informe;
           

            
            $("#anunciosLeer").html(informe);

          


                  
        }        
    });
}

 $.unblockUI();
</script>

