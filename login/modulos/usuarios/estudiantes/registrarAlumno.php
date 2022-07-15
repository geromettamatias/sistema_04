<hr>



 <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Registrar un nuevo Alumno/a</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

          <form id="formPersonasAlumno">
          
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>DNI-Alumno (SOLO NUMEROS)</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                    </div>
                    <input id="dniAlumnos2" type="text" class="form-control" data-inputmask='"mask": "99999999"' data-mask>
                  </div>
                  <!-- /.input group -->

                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  
                	 <label>APELIDO Y NOMBRE (Alumno)</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                    </div>
                    <input id="nombreAlumnos2" type="text" class="form-control">
                  </div>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>CUIL-Alumno (SOLO NUMEROS)</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                    </div>
                    <input id="cuilAlumnos2" type="text" class="form-control" data-inputmask='"mask": "99-99999999-99"' data-mask>
                  </div>
                  <!-- /.input group -->

                </div>
             
                <!-- /.form-group -->
              </div>
                <div class="col-md-6">
                <div class="form-group">
                  
                	<label>CORREO<div id="tex"></div></label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input id="emailAlumnos2" type="email" class="form-control">
                  </div>
                </div>
              </div>
            
            </div>





            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                   <label>DOMICILIO (Alumno)</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    </div>
                    <input id="domicilioAlumnos2" type="text" class="form-control">
                  </div>

                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            
            </div>
            <div class="row">
	              <div class="col-md-6">
	                <div class="form-group">
	                     <label>TELEFONO-Alumno: EJ:3624 653582</label>

	                  <div class="input-group">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
	                    </div>
	                    <input id="telefonoAlumnos2" type="text" class="form-control" data-inputmask='"mask": "(9999) 999999"' data-mask>
	                  </div>

	                </div>
	             
	                <!-- /.form-group -->
	              </div>
	              <!-- /.col -->
	              <div class="col-md-6">
	                <div class="form-group">
	                  
	                	 <label>Posee el Alumno Discapasidad, Cual?</label>

	                  <div class="input-group">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text"><i class="fas fa-wheelchair"></i></span>
	                    </div>
	                    <input id="discapasidadAlumnos2" type="text" class="form-control">
	                  </div>

	                </div>
	              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
             

                <label>Normbre y Apellido del Tutor</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                    </div>
                    <input id="nombreTutor2" type="text" class="form-control">
                  </div>



                </div>
             
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
             

                 <label>DNI-Tutor (SOLO NUMEROS)</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                    </div>
                    <input id="dniTutor2" type="text" class="form-control" data-inputmask='"mask": "99999999"' data-mask>
                  </div>



                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
             

               	    <label>TELEFONO-Tutor: EJ:3624 653582</label>

	                  <div class="input-group">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
	                    </div>
	                    <input id="TelefonoTutor2" type="text" class="form-control" data-inputmask='"mask": "(9999) 999999"' data-mask>
	                  </div>


                </div>
             
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
             

                 	<label>Orientación al que se inscribe:</label>
					    

					         <select class="form-control" id="idPlanEstudio" aria-describedby="idPlanEstudioHelp">
                             <?php


																include_once '../../bd/conexion.php';
																$objeto = new Conexion();
																$conexion = $objeto->Conectar();


                                $c1onsulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idPlan'] ?>"><?php echo $d1at['nombre'] ?></option>
                                <?php } ?>
                        </select>



                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">


                  <label>Fecha Nacimiento del Alumno:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    		<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input id="fechaNacimiento" type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                        
                    </div>
           



                </div>
             
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
             

                  <label>Nacido en</label>

	                  <div class="input-group">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text"><i  class= "fab fa-font-awesome" ></i> </span>
	                    </div>
	                    <input id="nacido" type="text" class="form-control">
	                  </div>


                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
             

                		<label>Procedencia del alumno</label>

	                  <div class="input-group">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text"><i class="fa fa-map"></i></span>
	                    </div>
	                    <input id="procedencia" type="text" class="form-control">
	                  </div>



                </div>
             
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
             

                  <label>Nacionalidad del Tutor</label>

	                  <div class="input-group">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text"><i class="fas fa-globe"></i></span>
	                    </div>
	                    <input id="nacionalidadTutor" type="text" class="form-control">
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
                    <input id="pass" type="text" class="form-control">
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
                    <input id="pass2" type="text" class="form-control">
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




 <script type="text/javascript">
 //Date and time picker
  $('[data-mask]').inputmask()

  $('#reservationdate').datetimepicker({
        format: 'L'
    });

 var verificacionEmail ='';

document.getElementById('emailAlumnos2').addEventListener('input', function() {
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
  


$("#formPersonasAlumno").submit(function(e){
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

 
    nombreAlumnos = $.trim($("#nombreAlumnos2").val());
    dniAlumnos = $.trim($("#dniAlumnos2").val());
    cuilAlumnos = $.trim($("#cuilAlumnos2").val());
    domicilioAlumnos = $.trim($("#domicilioAlumnos2").val());
    emailAlumnos = $.trim($("#emailAlumnos2").val());
    telefonoAlumnos = $.trim($("#telefonoAlumnos2").val());
    discapasidadAlumnos = $.trim($("#discapasidadAlumnos2").val());
   
    nombreTutor = $.trim($("#nombreTutor2").val());
    dniTutor = $.trim($("#dniTutor2").val());
    telefonoTutor = $.trim($("#TelefonoTutor2").val());
    idPlanEstudio = $.trim($("#idPlanEstudio").val());

     fechaNacimiento = $.trim($("#fechaNacimiento").val());
    nLegajo = 'SIN-DATOS';
    nacido = $.trim($("#nacido").val());
    procedencia = $.trim($("#procedencia").val());
    nacionalidadTutor = $.trim($("#nacionalidadTutor").val());
    pass = $.trim($("#pass").val());
    pass2 = $.trim($("#pass2").val());

    console.log({nombreAlumnos:nombreAlumnos, dniAlumnos:dniAlumnos, cuilAlumnos:cuilAlumnos, domicilioAlumnos:domicilioAlumnos, emailAlumnos:emailAlumnos, telefonoAlumnos:telefonoAlumnos, discapasidadAlumnos:discapasidadAlumnos, nombreTutor:nombreTutor, dniTutor:dniTutor, TelefonoTutor:telefonoTutor, idPlanEstudio:idPlanEstudio, fechaNacimiento:fechaNacimiento, nLegajo:nLegajo, nacido:nacido, procedencia:procedencia, nacionalidadTutor:nacionalidadTutor, pass:pass});
 
     dniAlumnosPru = dniAlumnos.split('_');
		 dniTutorPru = dniTutor.split('_');
		       
		 cuilAlumnosPru = cuilAlumnos.split('_');

		 telefonoAlumnosPru = telefonoAlumnos.split('_');
		 telefonoTutorPru = telefonoTutor.split('_');

		 
		 if ((telefonoAlumnosPru.length==1) && (telefonoTutorPru.length==1)) {
		    	
		 if (cuilAlumnosPru.length==1) {
		 if ((dniAlumnosPru.length==1) && (dniTutorPru.length==1)) {


 			  if (pass==pass2) {


 
		   	if ((nombreAlumnos!='') && (dniAlumnos!='') && (cuilAlumnos!='') && (domicilioAlumnos!='') && (emailAlumnos!='') && (telefonoAlumnos!='') && (discapasidadAlumnos!='') && (nombreTutor!='') && (dniTutor!='') && (TelefonoTutor!='') && (idPlanEstudio!='') && (fechaNacimiento!='') && (nLegajo!='') && (nacido!='') && (procedencia!='') && (nacionalidadTutor!='') && (pass!='')) {


		   			alert(1)

    $.ajax({
        
        url: "modulos/usuarios/estudiantes/elementos/registrar.php",
        type: "POST",
        dataType: "json",
        data: {nombreAlumnos:nombreAlumnos, dniAlumnos:dniAlumnos, cuilAlumnos:cuilAlumnos, domicilioAlumnos:domicilioAlumnos, emailAlumnos:emailAlumnos, telefonoAlumnos:telefonoAlumnos, discapasidadAlumnos:discapasidadAlumnos, nombreTutor:nombreTutor, dniTutor:dniTutor, TelefonoTutor:TelefonoTutor, idPlanEstudio:idPlanEstudio, fechaNacimiento:fechaNacimiento, nLegajo:nLegajo, nacido:nacido, procedencia:procedencia, nacionalidadTutor:nacionalidadTutor, pass:pass},
        success: function(data){ 


                   	if (data==1) {
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
							        $('#tablaInstitucional').load('modulos/usuarios/estudiantes/loginEstudiante.php');

		          	}else{

		          			if (data==0) {

		          				toastr.warning('El Alumno ya está Registrado, debe recuperar la contraseña o concurrir al establecimiento');

		          			}else{

		          					toastr.error('No se puede registrar, problema con el Servidor, intente más tarde');

		          			}






		          		
		          	}
                                 
            
        }        
    });
   

   }else{

		  			toastr.error('Uno de los campos esta vacío');
		  			 $.unblockUI();
		  }

	 }else{

		  	toastr.error('Las contraseñas no son iguales');
		  	 $.unblockUI();
		  }


		}else{

		  	if ((dniAlumnosPru.length!=1) && (dniTutorPru.length!=1)) {
		  			
		  			Toast.fire({
					        icon: 'error',
					        title: 'El DNI (Alumno y Tutor) debe tener 8 digitos, si tiene menos debe completar con cero Ej: 01374984'
					      })

		  	}else{

		  				if ((dniTutorPru.length==1)) {

		  						Toast.fire({
					        icon: 'error',
					        title: 'El DNI (Alumno) debe tener 8 digitos, si tiene menos debe completar con cero Ej: 01374984'
					     		 })

					  	}else{
					  			Toast.fire({
					        icon: 'error',
					        title: 'El DNI (Tutor) debe tener 8 digitos, si tiene menos debe completar con cero Ej: 01374984'
					     		 })
					  		
					  	}
		  	}
		  
   


		  	 $.unblockUI();
		  }

			}else{
		  	
		  			Toast.fire({
					        icon: 'error',
					        title: 'El CUL (Alumno) debe tener 11 digitos, si tiene menos debe completar con cero Ej:27-01374984-00'
					     		 })
			}


			}else{
		  	
		  			Toast.fire({
					        icon: 'error',
					        title: 'El Telefono del Alumno o Tutor esta incompleto'
					     		 })
			}

 $.unblockUI();   
    
});    
    


 
	
$.unblockUI();
    
});




</script>


