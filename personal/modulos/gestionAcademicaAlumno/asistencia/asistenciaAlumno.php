
    <style>
   
            table.table-bordered{
    border:1px solid black;
 
        }
      table.table-bordered > thead > tr > th{
          border:1px solid black;
      }
      table.table-bordered > tbody > tr > td{
          border:1px solid black;
      }
    </style>



<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                               
     



              
  
                            ?>  



<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  ASISTENCIA DE LOS ALUMNOS
                </h3>
              </div>
              <div class="card-body">


                  <div class="table-responsive">        
                        <table id="asistenciaAlumnoFinal" class="table table-sm table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                
                                <th>ID</th>
     
                                <th>APELLIDO Y NOMBRE</th> 
                                 <th>DNI</th>
                                <th>BOTON</th> 
                                                    
                              
                            </tr>
                        </thead>
                         <tbody>
                            <?php  
                             $colorFinal='';

                            $contadorColores=0;                          
                             foreach($data as $dat) {
                                    
                                    $idAlumnos=$dat['idAlumnos'];
                                    $nombreAlumnos=$dat['nombreAlumnos'];
                                    $dniAlumnos=$dat['dniAlumnos'];
                                      
  
                                                        
                             if ($contadorColores<=6) {
                                 $contadorColores++;

                                 if ($contadorColores==1) {
                                     $colorFinal='success';
                                 }else{
                                        if ($contadorColores==2) {
                                            $colorFinal='primary';
                                         }else{
                                                 if ($contadorColores==3) {
                                                    $colorFinal='secondary';
                                                 }else{
                                                    if ($contadorColores==4) {
                                                        $colorFinal='danger';
                                                     }else{
                                                        if ($contadorColores==5) {
                                                            $colorFinal='warning';
                                                         }else{
                                                            $colorFinal='info';
                                                         }
                                                     }
                                                 }
                                         }
                                 }

                             }else{
                                $contadorColores=1;
                                $colorFinal='success';
                             }




                         
                            ?>
                            <tr class="table-<?php echo $colorFinal; ?>">
                             
                                <td><?php echo $idAlumnos; ?></td>
                                <td><?php echo $nombreAlumnos; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                        

                                <td><button class="btn btn-outline-primary glyphicon glyphicon-pencil btnEditar_ASISTENCIA_alumno" title="ASISTENCIA"><i class="fas fa-sign-in-alt"></i></button></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                        
                       </table>  

               
              </div>
              <!-- /.card -->
            </div>



 <script type="text/javascript">
$(document).ready(function(){

  $('#imagenProceso').hide();



     asistenciaAlumno();



 var fila; //capturar la fila para editar o borrar el registro
    
//botón AISTENCIA    
$(document).on("click", ".btnEditar_ASISTENCIA_alumno", function(){
    fila = $(this).closest("tr");

 
    id = parseInt(fila.find('td:eq(0)').text());



   $.ajax({
          url: "modulos/gestionAcademicaAlumno/asistencia/elementos/seccionCicloInasistenciaAlumno.php",
          type: "POST",
          data: {id:id},
          success: function(r){  

                
       


    ret=`<select class="form-control" id="cicloLectivoFina">
              
                `+r+`
                </select></div>`;
     

      Swal.fire({
              title: 'AÑO LECTIVO',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  cicloLectivoFina = document.getElementById('cicloLectivoFina').value;
              
       

                  inasistenciaDocenteFinalAlu(cicloLectivoFina,id);
                                  
                }
        });




   }        
      });






    
});
  




}); 





function asistenciaAlumno() {
      asistenciaAlumnoFinal=$('#asistenciaAlumnoFinal').DataTable({ 


     "destroy":true,
  

   
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        },
      
    });
}





function inasistenciaDocenteFinalAlu(cicloLectivoFina,id){

        

     $.ajax({
        url: "modulos/gestionAcademicaAlumno/asistencia/elementos/alumno.php",
        type: "POST",
        dataType: "json",
        data: {id:id, cicloLectivoFina:cicloLectivoFina},
        success: function(data){  
            
            $('#contenidoAyuda').html(''); 
            $('#buscarTablaInstitucional').html('');
            $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/asistencia/asistenciaAlumno_Tabla.php');
            $('#buscarTablaInstitucional').show();
              
        }        
    });
}


 $.unblockUI();
</script>
