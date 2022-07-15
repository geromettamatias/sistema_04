
<style type="text/css">
  @media screen and (max-width: 600px) {
       table {
           width:100%;
       }
       thead {
           display: none;
       }
       tr:nth-of-type(2n) {
           background-color: inherit;
       }
       tr td:first-child {
           background: #f0f0f0;
           font-weight:bold;
           font-size:1.3em;
       }
       tbody td {
           display: block;
           text-align:center;
       }
       tbody td:before {
           content: attr(data-th);
           display: block;
           text-align:center;
       }
}
</style>



<br>

            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Pre Incripción a 1er año  <button class="btn btn-danger"  id="regresar">Regresar <i class='fas fa-sign-in-alt'></i></button>
                </h3>
              </div>
              <div class="card-body">

              
                   <form id="formPrecept" class="needs-validation" novalidate>
          <div class="row g-3">


             
      
            <div class="col-sm-6">
              <label for="dni_alumno" class="form-label">DNI del Alumno</label>
              <input type="number" class="form-control" id="dni_alumno" placeholder="Ej: 32729126" value="" required>
              <div class="invalid-feedback">
                Se requiere el N° válido.
              </div>
            </div>


            <div class="col-sm-6">
              <label for="nombre_alumno" class="form-label">Apellido y Nombre Completo del Alumno</label>
              <input type="text" class="form-control" id="nombre_alumno" placeholder="Ej: Laura Lopez" value="" required >
              <div class="invalid-feedback">
                Se requiere el Nombre y Apuellido válido.
              </div>
            </div>
            <div class="col-sm-6">
              <label for="fecha_nacimiento" class="form-label">Fecha del Alumno</label>
              <input type="date" class="form-control" id="fecha_nacimiento" value="" required >
              <div class="invalid-feedback">
                Se requiere la fecha de nacimiento válido.
              </div>
            </div>
            <div class="col-sm-6">
              <label for="dni_tutor" class="form-label">DNI del Tutor</label>
              <input type="number" class="form-control" id="dni_tutor" placeholder="Ej: 16052127" value="" required>
              <div class="invalid-feedback">
                Se requiere el N° válido.
              </div>
            </div>
            <div class="col-sm-6">
              <label for="nombre_tutor" class="form-label">Apellido y Nombre Completo del Tutor</label>
              <input type="text" class="form-control" id="nombre_tutor" placeholder="Ej: Olga Lopez" value="" required >
              <div class="invalid-feedback">
                Se requiere el Nombre y Apuellido válido.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="correo" class="form-label">Correo Electronico</label>
              <input type="email" class="form-control" id="correo" placeholder="escuela21@gmail.com" value="" required>
              <div class="invalid-feedback">
                Se requiere un correo eléctronico válido.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="telefono" class="form-label">Telefono</label>
              <input type="text" class="form-control" id="telefono" placeholder="03624653597'" value="" required>
              <div class="invalid-feedback">
                Se requiere un numero telefono válido.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="domicilio" class="form-label">Domicilio</label>
              <input type="text" class="form-control" id="domicilio" placeholder="Padre Sena N°685'" value="" required>
              <div class="invalid-feedback">
                Se requiere un domicilio válido.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="localidad" class="form-label">Localidad</label>
               <select class="form-control" id="localidad" required>
                      <option>Resistencia</option>
                      <option>Barranqueras</option>
                      <option>Fontana</option>
                      <option>Puerto Tirol</option>
                  
                </select>
              <div class="invalid-feedback">
                Se requiere la localidad válido.
              </div>
            </div>


            <div class="col-sm-6">

                    <div class="form-check">
            <input type="checkbox" class="form-check-input" id="micheckbox" required>
            <label class="form-check-label" for="micheckbox">Verificación</label>
          </div>
              
              <button class="btn btn-primary" type="submit"><i class='fas fa-sign-in-alt'></i></button>
            </div>


</div>


</form>

               
              </div>
              <!-- /.card -->
            </div>













  <script type="text/javascript">



  $("#regresar").click(function(){
   

     $('#tablaInstitucional').load('modulos/paginaInicio/novedades/novedades.php');






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




    $('#formPrecept').submit(function(e){
   e.preventDefault();




   var dni_alumno = $.trim($("#dni_alumno").val());    
   var nombre_alumno =$.trim($("#nombre_alumno").val());
   var fecha_nacimiento =$.trim($("#fecha_nacimiento").val());
   var dni_tutor =$.trim($("#dni_tutor").val());
   var nombre_tutor =$.trim($("#nombre_tutor").val());
   var correo =$.trim($("#correo").val());
   var telefono =$.trim($("#telefono").val());
   var domicilio =$.trim($("#domicilio").val());
   var localidad =$.trim($("#localidad").val());
     


  
     if (document.getElementById('micheckbox').checked)
                    {
                       
    
   if(dni_alumno == "" || nombre_alumno == "" || fecha_nacimiento == "" || dni_tutor == "" || nombre_tutor == "" || correo == "" || telefono == "" || domicilio == "" || localidad == ""){
      Swal.fire({
          type:'warning',
          title:'Los Datos estan Incompletos, Completar!',
      });
      return false; 
    }else{

      
        $.ajax({
           url:"modulos/paginaInicio/inscripciones/elementos/ingresarDatosAlumnos.php",
           type:"POST",
           datatype: "json",
           data: {dni_alumno:dni_alumno, nombre_alumno:nombre_alumno, fecha_nacimiento:fecha_nacimiento, dni_tutor:dni_tutor, nombre_tutor:nombre_tutor, correo:correo, telefono:telefono, domicilio:domicilio, localidad:localidad}, 
           success:function(data){ 


            if (data==1) {

              

            toastr.info('Excelente !!');
   

        $('#tablaInstitucional').load('modulos/paginaInicio/inscripciones/inscribirAlumnos.php');
            }else{

              toastr.error('El estudiante ya estaba Registrado !!');
              $("#formPrecept").trigger("reset");

              
   

            }


              

                  
               
                  
           }    
        });
    } 

    }    
});

    });


 

  $.unblockUI();
  </script>