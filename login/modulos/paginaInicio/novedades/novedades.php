


<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  <b>NOVEDADES</b>
                </h3>
              </div>
              <div class="card-body">

            
              



                  <b>Información:</b><div id="novedadesLeer" ></div>


                 
                    </div>
              <!-- /.card -->
            </div>










 <script type="text/javascript">

$('#imagenProceso').hide();
novedades();



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


</script>
