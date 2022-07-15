
<hr>

 <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Registrar un nuevo Docente</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

          <form id="formDatos">
          
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>DNI (SOLO NUMEROS)</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                    </div>
                    <input id="dniDocente" type="text" class="form-control" data-inputmask='"mask": "99999999"' data-mask>
                  </div>
                  <!-- /.input group -->

                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  
                	 <label>APELIDO Y NOMBRE</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                    </div>
                    <input id="nombreDocente" type="text" class="form-control">
                  </div>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                   <label>DOMICILIO</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    </div>
                    <input id="domicilioDocente" type="text" class="form-control">
                  </div>

                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  
                	<label>CORREO<div id="tex"></div></label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input id="emailDocente" type="email" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
	              <div class="col-md-6">
	                <div class="form-group">
	                     <label>TELEFONO: EJ:3624 653582</label>

	                  <div class="input-group">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
	                    </div>
	                    <input id="telefonoDocente" type="text" class="form-control" data-inputmask='"mask": "(9999) 999999"' data-mask>
	                  </div>

	                </div>
	             
	                <!-- /.form-group -->
	              </div>
	              <!-- /.col -->
	              <div class="col-md-6">
	                <div class="form-group">
	                  
	                	 <label>TITULO QUE POSEE</label>

	                  <div class="input-group">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
	                    </div>
	                    <input id="tituloDocente" type="text" class="form-control">
	                  </div>

	                </div>
	              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
             

                <label>POSEE HIJOS EN ESCOLARIDADPosee Hijos en escolaridad? Indique en que nivel:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-users-cog"></i></span>
                    </div>
                    <input id="hijos" type="text" class="form-control">
                  </div>



                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                      <label>NUEVA CONTRASEÑA</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="nuevaContraseña" type="text" class="form-control">
                  </div>

                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  
                <label>REPETIR LA NUEVA CONTRASEÑA</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="nuevaContraseña2" type="text" class="form-control">
                  </div>

                </div>
              </div>
            </div>
            <hr>
            <div class="row">
             			
               		<div class="col-md-12">
                		<div class="form-group">
                			<button type="submit" class="btn btn-outline-success btn-block">Register</button>
                		</div>
                	</div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                

                	<a href="#" class="btn btn-block btn-primary">
					          <i href="javascript:void(0)" class="fab fa-facebook mr-2"></i>
					          Regístrese usando Facebook
					        </a>


                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  

                  <a href="#" class="btn btn-block btn-danger">
					          <i href="javascript:void(0)" class="fab fa-google-plus mr-2"></i>
					          Regístrese usando Google+
					        </a>
               

                </div>
              </div>
            </div>



          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Los datos son confidenciales, solo la institución podrá visualizarlo por motivos administrativos. 
          </div>
        </div>
        </div>


</section>


<hr>



<hr>
 <script type="text/javascript">



 $('[data-mask]').inputmask()

 var verificacionEmail ='';

document.getElementById('emailDocente').addEventListener('input', function() {
    campo = event.target;
   
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {

      $('#tex').html('<span style="color:#2471A3";>El correo es Válido</span>');
      verificacionEmail=1;
    } else {
      verificacionEmail=0; 
      $('#tex').html('<span style="color:#FF0000";>El correo es Incorrecto</span>'); 
    
    }
});





$(document).ready(function(){



var Toast = Swal.mixin({
		      toast: true,
		      position: 'top-end',
		      showConfirmButton: false,
		      timer: 5000
		    });




$('#imagenProceso').hide();
  



		$("#formDatos").submit(function(e){
		    e.preventDefault();   


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
 
		 
	
		   	nombreDocente = $.trim($("#nombreDocente").val());
		    dniDocente = $.trim($("#dniDocente").val());
		    domicilioDocente = $.trim($("#domicilioDocente").val());
		    emailDocente = $.trim($("#emailDocente").val());
		    telefonoDocente = $.trim($("#telefonoDocente").val());
		    tituloDocente = $.trim($("#tituloDocente").val());
		    nuevaContraseña = $.trim($("#nuevaContraseña").val());
		    nuevaContraseña2 = $.trim($("#nuevaContraseña2").val());
		    hijos = $.trim($("#hijos").val());


		    dniDocentePru = dniDocente.split('_');
		    
		 

		  if (dniDocentePru.length==1) {

		   if (nuevaContraseña==nuevaContraseña2) {



		   	if ((hijos!='') && (nombreDocente!='') && (domicilioDocente!='') && (emailDocente!='') && (telefonoDocente!='') && (tituloDocente!='') && (nuevaContraseña!='') && (dniDocente!='')) {

		  
		    $.ajax({
		          type:"post",
		          data:'nombreDocente=' + nombreDocente + '&domicilioDocente=' + domicilioDocente + '&emailDocente=' + emailDocente + '&telefonoDocente=' + telefonoDocente + '&tituloDocente=' + tituloDocente + '&nuevaContraseña=' + nuevaContraseña + '&dniDocente=' + dniDocente + '&hijos=' + hijos,
		          url:'modulos/usuarios/docentes/elementos/registrarDocente.php',
		          success:function(r){

		          	if (r==1) {
		          		toastr.success('Operación exitosa, ahora ingrese con su DNI y Contraseña');

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

							          
							        $('#imagenProceso').show();
							        $('#contenidoAyuda').html(''); 
							        $('#buscarTablaInstitucional').html('');
							        $('#tablaInstitucional').load('modulos/usuarios/docentes/loginDocente.php');

		          	}else{

		          			if (r==0) {

		        

		          				 Toast.fire({
									        icon: 'warning',
									        title: 'El Docente ya está Registrado, debe recuperar la contraseña o concurrir al establecimiento'
									      })

		          			}else{

		          					toastr.error('No se puede registrar, problema con el Servidor, intente más tarde');

		          			}






		          		
		          	}
		           	
		          	 $.unblockUI();
		        }
		     });



		  }else{

		  	 Toast.fire({
        icon: 'error',
        title: 'Uno de los campos esta vacío'
      })

		  	
		  			 $.unblockUI();
		  }


		  }else{

		 
		  	 Toast.fire({
        icon: 'error',
        title: 'Las contraseñas no son iguales'
      })
		  	 $.unblockUI();
		  }


		  }else{

		  
		  
       Toast.fire({
        icon: 'error',
        title: 'El DNI debe tener 8 digitos, si tiene menos debe completar con cero Ej: 01374984'
      })
		  	


		  	 $.unblockUI();
		  }






		}); 


 
	
$.unblockUI();
    
});




</script>


