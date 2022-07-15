

<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  <b>DATOS DEL DIRECTIVO</b>
                </h3>
              </div>
              <div class="card-body">


                 <div class="col-12 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  <i class="fas fa-school"></i> Director
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col">
                      <br>
                      
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-address-card"></i></span> <div id="nombreDirectivos"></div></li>
                         <li class="small"><span class="fa-li"><i class="fas fa-edit"></i></span> <div id="datosDirectivos"></div></li>
                       
                      </ul>
                    </div>
                    
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                   
                    
                      <i class="fas fa-stream"></i> Cualquier duda debe concurrir al establecimiento 
                    
                  </div>
                </div>
              </div>
            </div>


                  <div class="col-12 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  <i class="fas fa-school"></i> Vice-Director
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col">
                      <br>
                      
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-address-card"></i></span> <div id="nombreviceDirector"></div></li>
                         <li class="small"><span class="fa-li"><i class="fas fa-edit"></i></span> <div id="datosviceDirector"></div></li>
                       
                      </ul>
                    </div>
                    
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                   
                    
                      <i class="fas fa-stream"></i> Cualquier duda debe concurrir al establecimiento 
                    
                  </div>
                </div>
              </div>
            </div>




                  <div class="col-12 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  <i class="fas fa-school"></i> Asesor Pedag.
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col">
                      <br>
                      
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-address-card"></i></span> <div id="nombreasesora"></div></li>
                         <li class="small"><span class="fa-li"><i class="fas fa-edit"></i></span> <div id="datosasesora"></div></li>
                       
                      </ul>
                    </div>
                    
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                   
                    
                      <i class="fas fa-stream"></i> Cualquier duda debe concurrir al establecimiento 
                    
                  </div>
                </div>
              </div>
            </div>

         

         

        

               
              </div>
              <!-- /.card -->
            </div>









 <script type="text/javascript">





    
$('#imagenProceso').hide();
datosDirectivosAdmin();








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

