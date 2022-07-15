<hr>    



<div class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Profesor</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">¿Olvidaste tu contraseña? Aquí puede recuperar fácilmente, se enviara la misma al correo registrado.</p>
      <form id="formRecuperar" class="needs-validation" novalidate>
        <div class="input-group mb-3">
          <input type="text" id="dniP" class="form-control" placeholder="DNI">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
            <div class="form-check">
            <input type="checkbox" class="form-check-input" id="micheckbox" required>
            <label class="form-check-label" for="micheckbox">Verificación</label>
          </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Enviar la contraseña al Email</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="javascript:void(0)" onclick="regresar()">Regresar</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

</div>




  <script type="text/javascript">


 

      $('#imagenProceso').hide();
 
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


        
$('#formRecuperar').submit(function(e){
   e.preventDefault();
   var dni = $.trim($("#dniP").val());    
  
     if (document.getElementById('micheckbox').checked)
                    {
                       
    
   if(dni.length == "" ){
      Swal.fire({
          type:'warning',
          title:'Debe ingresar un dni',
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
           url:"modulos/usuarios/docentes/elementos/recuperarPass.php",
           type:"POST",
         
           data: {dni:dni}, 
           success:function(data){ 

            console.log(data);


               if(data == 1){
                   toastr.error('Usuario no esta registrado!!');
                   $('#tablaInstitucional').load('modulos/usuarios/docentes/loginDocente.php');

               }else if(data == 2){
                   toastr.error('Usuario no posee correo registrado, debera concorrir al establecimiento!!');
                   $('#tablaInstitucional').load('modulos/usuarios/docentes/loginDocente.php');
               }else if(data != ''){
                   toastr.info('Se envio un correo, para poder recuperar la contraseña!!');
                   $('#tablaInstitucional').load('modulos/usuarios/docentes/loginDocente.php');
               }else if(data == 'error'){
                   toastr.error('No se pudo enviar el email, debera concurrir al establecimiento');
                   $('#tablaInstitucional').load('modulos/usuarios/docentes/loginDocente.php');
               }
           }    
        });
    }  


    }   
});


    });





function regresar() {


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
    // body...
}


  $.unblockUI();
  </script>

