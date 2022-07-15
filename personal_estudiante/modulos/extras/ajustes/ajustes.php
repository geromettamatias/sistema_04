
<!--INICIO del cont principal-->
<div class="container">

 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


$s_usuarioEstudiante=$_SESSION["s_usuarioEstudiante"];


$consulta = "SELECT datosalumnos.idAlumnos, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos, datosalumnos.cuilAlumnos, datosalumnos.domicilioAlumnos, datosalumnos.emailAlumnos, datosalumnos.telefonoAlumnos, datosalumnos.discapasidadAlumnos, datosalumnos.nombreTutor, datosalumnos.dniTutor, datosalumnos.TelefonoTutor, plan_datos.nombre AS 'plan' FROM datosalumnos INNER JOIN plan_datos ON plan_datos.idPlan = datosalumnos.idPlanEstudio WHERE datosalumnos.dniAlumnos= '$s_usuarioEstudiante'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) { 

    $idAlumno=$dat['idAlumnos'];
    $dniAlumnos=$dat['dniAlumnos'];
    $nombreAlumnos=$dat['nombreAlumnos'];
    $cuilAlumnos=$dat['cuilAlumnos'];
    $domicilioAlumnos=$dat['domicilioAlumnos'];
    $emailAlumnos=$dat['emailAlumnos'];
    $telefonoAlumnos=$dat['telefonoAlumnos'];
    $discapasidadAlumnos=$dat['discapasidadAlumnos'];
    $nombreTutor=$dat['nombreTutor'];
    $dniTutor=$dat['dniTutor'];
    $TelefonoTutor=$dat['TelefonoTutor'];
    $nombrePLAN=$dat['plan'];

}






?>

<input hidden="" value="<?php echo $idAlumno; ?>" id="idAlumno">












<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  AJUSTES
                </h3>
              </div>
              <div class="card-body">

                

                El alumno esta inscripto en el Plan: <?php echo $nombrePLAN; ?>
                <hr>
                DATOS PERSONALES <hr>	


                  <form id="formDatos">
					  <div class="mb-3">
					    <label for="dniAlumno" class="form-label">DNI del Alumno</label>
					    <input type="text" class="form-control" id="dniAlumno" aria-describedby="dniHelp" value="<?php echo $dniAlumnos; ?>" title='No se Puede Editar el DNI- debera hablar con el administrador' readonly>
					    <div id="dniHelp" class="form-text">El numero de DNI es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="nombreAlumno" class="form-label">Apellido y Nombre del Alumno</label>
					    <input type="text" class="form-control" id="nombreAlumno" aria-describedby="nombreAlumnoHelp" value="<?php echo $nombreAlumnos; ?>" required>
					    <div id="nombreAlumnoHelp" class="form-text">El nombre y apellido del Alumno es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="cuilAlumnos" class="form-label">Cuil del Alumno</label>
					    <input type="text" class="form-control" id="cuilAlumnos" aria-describedby="cuilAlumnosHelp" value="<?php echo $cuilAlumnos; ?>" required>
					    <div id="cuilAlumnosHelp" class="form-text">El cuil del Alumno es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="domicilioAlumno" class="form-label">Domicilio del Alumno</label>
					    <input type="text" class="form-control" id="domicilioAlumno" aria-describedby="domicilioHelp" value="<?php echo $domicilioAlumnos; ?>" required>
					    <div id="domicilioHelp" class="form-text">El domicilio del Alumno es obligatorio</div>
					  </div>
					 <div class="mb-3">
					    <label for="emailAlumno" class="form-label">Correo Electronico del Alumno</label>
					    <input type="email" class="form-control" id="emailAlumno" aria-describedby="emailAlumnoHelp" value="<?php echo $emailAlumnos; ?>" required>
					    <div id="emailAlumnoHelp" class="form-text">El Email del Alumno es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="telefonoAlumno" class="form-label">Telefono del Alumno</label>
					    <input type="text" class="form-control" id="telefonoAlumno" aria-describedby="telefonoAlumnoHelp" value="<?php echo $telefonoAlumnos; ?>" required>
					    <div id="telefonoAlumnoHelp" class="form-text">El Telefono del Alumno es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="discapasidadAlumnos" class="form-label">El alumno posse alguna discapacidad</label>
					    <input type="text" class="form-control" id="discapasidadAlumnos" aria-describedby="discapasidadAlumnosHelp" value="<?php echo $discapasidadAlumnos; ?>" required>
					    <div id="discapasidadAlumnosHelp" class="form-text">Este campo es obligatorio</div>
					  </div>

					  <div class="mb-3">
					    <label for="nombreTutor" class="form-label">Apellido y Nombre del Tutor</label>
					    <input type="text" class="form-control" id="nombreTutor" aria-describedby="nombreTutorHelp" value="<?php echo $nombreTutor; ?>" required>
					    <div id="nombreTutorHelp" class="form-text">El nombre y apellido del Tutor es obligatorio</div>
					  </div>

					  <div class="mb-3">
					    <label for="dniTutor" class="form-label">DNI del Tutor</label>
					    <input type="text" class="form-control" id="dniTutor" aria-describedby="dniTutorHelp" value="<?php echo $dniTutor; ?>" required>
					    <div id="dniTutorHelp" class="form-text">El numero de DNI del tutor es obligatorio</div>
					  </div>

					  <div class="mb-3">
					    <label for="TelefonoTutor" class="form-label">Telefono del Tutor</label>
					    <input type="text" class="form-control" id="TelefonoTutor" aria-describedby="TelefonoTutorHelp" value="<?php echo $TelefonoTutor; ?>" required>
					    <div id="TelefonoTutorHelp" class="form-text">El Telefono del Tutor es obligatorio</div>
					  </div>

					  	                 <div class="mb-3">
					    <label for="pass_verificacion" class="form-label">Contraseña:</label>
					    <input type="password" class="form-control" id="pass_verificacion" aria-describedby="pass_verificacionHelp"  required>
					    <div id="pass_verificacionHelp" class="form-text">Contraseña es obligatorio</div>
					  </div>



					                      <div class="mb-3">
					    <label for="pass" class="form-label">Nueva Contraseña: (Repita la contraseña)</label>
					    <input type="password" class="form-control" id="pass" aria-describedby="passHelp"  required>
					    <div id="passHelp" class="form-text">La Nueva Contraseña es obligatorio</div>
					  </div>

					                     <div class="mb-3">
					    <label for="pass2" class="form-label">Repita la nueva Contraseña:(Repita la contraseña)</label>
					    <input type="password" class="form-control" id="pass2" aria-describedby="pass2Help"  required>
					    <div id="pass2Help" class="form-text">Repita la nueva Contraseña es obligatorio</div>
					  </div>



					  <div class="mb-3 form-check">
					    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
					    <label class="form-check-label" for="exampleCheck1">Verificación</label>
					  </div>
					  <button type="submit" class="btn btn-primary">Editar los datos personales</button>
					</form>

               
              </div>
              <!-- /.card -->
            </div>






 <script type="text/javascript">
$(document).ready(function(){


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









		 
		    idAlumno = $.trim($("#idAlumno").val());
		    
		    cuilAlumnos = $.trim($("#cuilAlumnos").val());
		    nombreAlumno = $.trim($("#nombreAlumno").val());
		    domicilioAlumno = $.trim($("#domicilioAlumno").val());
		    emailAlumno = $.trim($("#emailAlumno").val());
		    telefonoAlumno = $.trim($("#telefonoAlumno").val());
		    discapasidadAlumnos = $.trim($("#discapasidadAlumnos").val());
		    
		    nombreTutor = $.trim($("#nombreTutor").val());
		    dniTutor = $.trim($("#dniTutor").val());
		    TelefonoTutor = $.trim($("#TelefonoTutor").val());
		    
		     pass = $.trim($("#pass").val());
    pass2 = $.trim($("#pass2").val());
    pass_verificacion = $.trim($("#pass_verificacion").val());


      if (pass==pass2) {


 
		   	if ((cuilAlumnos!='') && (domicilioAlumno!='') && (emailAlumno!='') && (telefonoAlumno!='') && (discapasidadAlumnos!='') && (nombreTutor!='') && (dniTutor!='') && (TelefonoTutor!='') && (pass!='') && (pass_verificacion!='')) {




		    $.ajax({
		          type:"post",
		          data:'idAlumno=' + idAlumno + '&nombreAlumno=' + nombreAlumno + '&domicilioAlumno=' + domicilioAlumno + '&emailAlumno=' + emailAlumno + '&telefonoAlumno=' + telefonoAlumno + '&discapasidadAlumnos=' + discapasidadAlumnos + '&cuilAlumnos=' + cuilAlumnos + '&nombreTutor=' + nombreTutor + '&dniTutor=' + dniTutor + '&TelefonoTutor=' + TelefonoTutor + '&pass=' + pass+ '&pass_verificacion=' + pass_verificacion,
		          url:'modulos/extras/ajustes/elementos/datosAlumno.php',
		          success:function(r){
		          	console.log(r);
		          	if (r==1) {


		          		    $.unblockUI();


		          		let timerInterval
								Swal.fire({
								  title: 'MUY BIEN',
								  html: '<h5>Redireccionando</h5>',
								  timer: 2000,
								  timerProgressBar: true,
								  didOpen: () => {
								    Swal.showLoading()
								    timerInterval = setInterval(() => {
								      const content = Swal.getContent()
								      if (content) {
								        const b = content.querySelector('b')
								        if (b) {
								          b.textContent = Swal.getTimerLeft()
								        }
								      }
								    }, 100)
								  },
								  willClose: () => {
								    clearInterval(timerInterval)
								  }
								}).then((result) => {
								  /* Read more about handling dismissals below */
								  if (result.dismiss === Swal.DismissReason.timer) {
								    location.href="../personal_estudiante/";
								  }
								})

		 

		          	}else if(r==2){
		          		toastr.error('La contraseña es incorrecta')

		          		$.unblockUI();
		          	}else{
		          		toastr.error('Error de servidor');
		  			 			$.unblockUI();
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



		}); 




    
});



   $.unblockUI();


</script>
