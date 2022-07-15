

<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Datos del Estudiante
                </h3>
              </div>
              <div class="card-body">

                

	           <?php  
				

				  include_once '../../bd/conexion.php';
              $objeto = new Conexion();
              $conexion = $objeto->Conectar();
               session_start();
                $s_usuarioEstudiante=$_SESSION["s_usuarioEstudiante"];


                      $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio` FROM `datosalumnos` WHERE `dniAlumnos`='$s_usuarioEstudiante'";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) { 

                                    $nombreAlumnos=$d1at['nombreAlumnos'];
                                   
                                }

                                echo $nombreAlumnos;




				?>
	          

               
              </div>
              <!-- /.card -->
            </div>




            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Anuncios
                </h3>
              </div>
              <div class="card-body">

                

              
                <div id="anunciosLeer" ></div>

               
              </div>
              <!-- /.card -->
            </div>


<script type="text/javascript">
  anuncioDocente();

function anuncioDocente() {


  
        $.ajax({
        url: "modulos/extras/inicio/elementos/anuncioLeerAlumno.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            info = data.anuncio.informe;
           

            
            $("#anunciosLeer").html(info);
            

                  
        }        
    });
}


</script>


