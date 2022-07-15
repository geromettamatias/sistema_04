
<br>

<section class="content">
      <div class="container-fluid">
<div class="row justify-content-center">
  <div class="col-12 col-sm-6">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="javascript:void(0)" class="h1"><b>Profesor</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Bienvenido al sistema autogestión de la E.E.T. N°16, primero debe iniciar sesión</p>

      <form id="formProfesor" class="needs-validation" novalidate>
        <div class="input-group mb-3">
          <input id="dniP" type="text" class="form-control" data-inputmask='"mask": "99999999"' data-mask>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-append claveVer">
            <div  class="input-group-text">
              <span class="fa fa-eye icon cambio"></span>
            </div>
          </div>
          <input id="passwordDocente" type="password" class="form-control" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="form-check">
            <input type="checkbox" class="form-check-input" id="micheckbox" required>
            <label class="form-check-label" for="micheckbox">Verificación</label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button  class="btn btn-outline-info btn-block">Iniciar sesión</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="javascript:void(0)" id="registrar_Nuevo_Docente" onclick="registrarNuevoDocente()" >Registrar una nueva membresía</a>
      </p>
      <p class="mb-0">
        <a href="javascript:void(0)" id="recuperar_Nuevo_Docente" onclick="recuperarPass()" class="text-center">Olvidé mi contraseña</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

</div>
</div>
</div>
</section>
<br>



  <script type="text/javascript">
$('[data-mask]').inputmask()

consultar();

      function mostrarContrasena(){
      var tipo = document.getElementById("passwordDocente");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }

$( ".claveVer" ).mouseup(function() {

    $(".cambio").removeClass("fa fa-eye-slash icon");
    $(".cambio").addClass("fa fa-eye icon");
    mostrarContrasena();
  }).mousedown(function() {
    $(".cambio").removeClass("fa fa-eye icon");
    $(".cambio").addClass("fa fa-eye-slash icon");
    mostrarContrasena();
  });


      $('#imagenProceso').hide();
   // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()


 $(document).ready(function() { 


        
       $('#formProfesor').submit(function(e){
   e.preventDefault();
   var dni = $.trim($("#dniP").val());    
   var passwordDocente =$.trim($("#passwordDocente").val());

     if (document.getElementById('micheckbox').checked)
                    {
                       
    
   if(dni.length == "" || passwordDocente == ""){
      Swal.fire({
          type:'warning',
          title:'Debe ingresar un dni y/o contraseña',
      });
      return false; 
    }else{


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

      
        $.ajax({
           url:"modulos/usuarios/docentes/elementos/loginProfesor.php",
           type:"POST",
       
           data: {dni:dni, passwordDocente:passwordDocente}, 
           success:function(data){ 

            console.log(data)
                       
               if(data == 2){
                   toastr.error('Usuario y/o password incorrecta !!');

                             

                    $.unblockUI();
               }else if(data == 1){
                   toastr.warning('Este usuario no esta habilitado !!');

                               
                    $.unblockUI();
               }else if(data == 3){
                $.unblockUI();

                                Swal.fire({
                                          title: '¡Conexión exitosa!',
                                          text: "Aclaración: No olvidar de guardar los datos nuevos o editados antes de salir !!!",
                                          icon: 'warning',
                                          showCancelButton: true,
                                          confirmButtonColor: '#3085d6',
                                          cancelButtonColor: '#d33',
                                          confirmButtonText: 'Ingresar al Sistema'
                                        }).then((result) => {
                                          if (result.isConfirmed) {
                                            
                                            window.location.href = "../personal_docente/";
                                          }
                                        })

             
                   
               }else{

                  toastr.error('Error del servidor !!');
               }
           }    
        });
    }  


    }   
});


    });



  function registrarNuevoDocente(){


        
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/docentes/registrar.php');

        
  }


function recuperarPass(){


     $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/docentes/recuperarPass.php');
  }






function consultar(){

    $.ajax({
            url: "modulos/usuarios/docentes/elementos/pregunta.php",
            type: "POST",
    
            data: {},
            success: function(data){
              console.log(data);
              res = data.split('||');
              resp_0=res[0];
              resp_1=res[1];
                resp_2=res[2];

              if (resp_0=='NO') {
          
                
                $("#registrar_Nuevo_Docente").hide();

               

              }

              if (resp_1=='NO') {
                
                $("#recuperar_Nuevo_Docente").hide();
              }

               if (resp_2=='NO') {
                

                 $('#tablaInstitucional').load('modulos/paginaInicio/novedades/novedades.php');

                 toastr.error('El Ingreso de DOCENTE esta  deshabilitado');

              }

            }
        });



}




  $.unblockUI();
  </script>


  