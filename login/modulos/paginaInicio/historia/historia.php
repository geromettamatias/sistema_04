


<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  <b>Datos</b>
                </h3>
              </div>
              <div class="card-body">

            
             
 



                  <b>Información:</b><div id="historiaLeer" ></div>


                 

               
              </div>
              <!-- /.card -->
            </div>






 <script type="text/javascript">
 

$('#imagenProceso').hide();
historia();





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

