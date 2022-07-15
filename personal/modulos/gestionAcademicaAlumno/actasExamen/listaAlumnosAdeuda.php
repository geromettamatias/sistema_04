
<?php
    include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();
    if (isset($_SESSION['idActa_inscriAlumno'])){
        $idActa_inscriAlumno=$_SESSION['idActa_inscriAlumno'];

                     $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivoFina= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



           $consulta = "SELECT actas_examen_datos.idActa,actas_examen_datos.tipo, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.nombre AS 'nombreAsignatura', plan_datos_asignaturas.idPlan, actas_examen_datos.precentacion, datos_docentes1.nombre AS 'docentePresidente', datos_docentes2.nombre AS 'docente1erSuplente', datos_docentes3.nombre AS 'docente2doSuplente' FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura INNER JOIN datos_docentes AS datos_docentes1 ON datos_docentes1.idDocente = actas_examen_datos.docente1 INNER JOIN datos_docentes AS datos_docentes2 ON datos_docentes2.idDocente = actas_examen_datos.docente2 INNER JOIN datos_docentes AS datos_docentes3 ON datos_docentes3.idDocente = actas_examen_datos.docente3 WHERE actas_examen_datos.idActa = '$idActa_inscriAlumno'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);



                            foreach($d1ata as $d1at) { 

                              

                            $idActa=$d1at['idActa'];
                            $tipo=$d1at['tipo'];
                            $ciclo=$d1at['ciclo'];
                            $idPlan=$d1at['idPlan'];
                            $nombreAsignatura=$d1at['nombreAsignatura'];
                            $precentacion=$d1at['precentacion'];

                            $docente1=$d1at['docentePresidente'];
                            $docente2=$d1at['docente1erSuplente'];
                            $docente3=$d1at['docente2doSuplente'];

                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }


                }


?>






            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  <?php echo 'Año Lectivo: '.$cicloLectivoFina.'<br>'; ?>
                 <?php echo $tipo; ?>
                 <?php echo '<br>TIPO: '.$idPlan.'--CICLO: '.$ciclo.'--ASIGNATURA: '.$nombreAsignatura; ?>
                 <br>DOCENTES: <?php echo $docente1.'; '.$docente2.'; '.$docente3; ?>
                </h3>
              </div>
              <div class="card-body">

                
                <button onclick="regresar(<?php echo $idActa; ?>)" type="button" class="btn btn-warning" data-toggle="modal"  title="Regresar"><i class='fas fa-reply-all'></i></button>

     
                 <table id="tabla_inscripFinal" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>APELLIDO Y NOMBRE</th>
                                <th>DNI</th>                         
                                <th>SEL</th>
                                <th>SITUACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                       <?php  
                            $colorFinal='';

                            $contadorColores=0;
                      
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




    $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos`";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                          
                                    foreach($data as $dat) { 

                                         
                                         $idAlumnos=$dat['idAlumnos'];
                                         $dniAlumnos=$dat['dniAlumnos'];
                                         $nombreAlumnos=$dat['nombreAlumnos'];

                                        $calFinal_1='6';
                                        $calFinal_2='6';
                                        $calFinal_3='6';
                                        $calFinal_4='6';
                                        $calFinal_5='6';


                                         $consulta = "SELECT `asignaturas_pendientes_$cicloLectivoFina`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivoFina`.`idAlumno`,`asignaturas_pendientes_$cicloLectivoFina`.`asignaturas`, `asignaturas_pendientes_$cicloLectivoFina`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo`, `asignaturas_pendientes_$cicloLectivoFina`.`calFinal_1`, `asignaturas_pendientes_$cicloLectivoFina`.`calFinal_2`, `asignaturas_pendientes_$cicloLectivoFina`.`calFinal_3`, `asignaturas_pendientes_$cicloLectivoFina`.`calFinal_4`, `asignaturas_pendientes_$cicloLectivoFina`.`calFinal_5`  FROM `asignaturas_pendientes_$cicloLectivoFina` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivoFina`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivoFina`.`idAlumno`='$idAlumnos'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                          
                                    foreach($data as $dat) { 
                                        $calFinal_1=$dat['calFinal_1'];
                                        $calFinal_2=$dat['calFinal_2'];
                                        $calFinal_3=$dat['calFinal_3'];
                                        $calFinal_4=$dat['calFinal_4'];
                                        $calFinal_5=$dat['calFinal_5'];

                                        $nombre=$dat['nombre'];
                                        $ciclo2=$dat['ciclo'];


                                        if (($calFinal_1 >= 6) || ($calFinal_2 >= 6) || ($calFinal_3 >= 6) || ($calFinal_4 >= 6) || ($calFinal_5 >= 6)) {

                                        }else{    
                                
                                            if (($nombreAsignatura==$nombre)&&($ciclo2==$ciclo)) {
                                            
                                            

                             ?>
                                            
                            <tr class="table-<?php echo $colorFinal; ?>">
                              
                              
                         
                                <td><?php echo $idAlumnos; ?></td>
                                <td><?php echo $nombreAlumnos; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                                <td><button id="<?php echo $idAlumnos ?>" onclick="ingresar(<?php echo $idAlumnos ?>)" type="button" class="btn btn-info" data-toggle="modal" title="INSCRIBIR ALUMNO"><i class='fas fa-user-plus'></i></button></td>


                                <td><?php 

                                $res= '<div id="situ'.$idAlumnos.'"><FONT COLOR="green">NO INSCRIPTO</FONT></div>';

                                $idAlumnos2='';
                           $consulta = "SELECT acta_examen_inscrip.idInscripcion, datosalumnos.nombreAlumnos, datosalumnos.idAlumnos, datosalumnos.dniAlumnos, acta_examen_inscrip.notaEsc, acta_examen_inscrip.notaOral, acta_examen_inscrip.promNumérico, acta_examen_inscrip.promLetra FROM acta_examen_inscrip INNER JOIN datosalumnos ON datosalumnos.idAlumnos = acta_examen_inscrip.idAlumno WHERE acta_examen_inscrip.idActa = '$idActa_inscriAlumno'";
                              $resultado = $conexion->prepare($consulta);
                              $resultado->execute();
                              $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                              foreach($data as $dat) { 
                                     $idAlumnos2=$dat['idAlumnos'];
                                


                                if ($idAlumnos2==$idAlumnos) {
                                    $res= '<div id="situ'.$idAlumnos.'"><FONT COLOR="red">INSCRIPTO</FONT></div>';
                                }

                                }


                                echo $res;

                                 ?></td>

                            </tr>
                                    <?php 


                                        }


                                    } 


                                       


                                    }


                                         
                                                  


                                 }  


                             ?>                           
                        </tbody>        
                       </table>                    

               
              </div>
              <!-- /.card -->
            </div>



        



 <script type="text/javascript">
$(document).ready(function(){

 $.unblockUI();
 

    var tabla_inscripFinal = $('#tabla_inscripFinal').DataTable({ 

          
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





});

function ingresar(idAlumnos){

    // $.blockUI({ 
    //                                 message: '<h1>Espere !!</h1>',
    //                                 css: { 
    //                                 border: 'none', 
    //                                 padding: '15px', 
    //                                 backgroundColor: '#000', 
    //                                 '-webkit-border-radius': '10px', 
    //                                 '-moz-border-radius': '10px', 
    //                                 opacity: .5, 
    //                                 color: '#fff' 
    //                             } }); 

         if (idAlumnos==0) {

        Swal.fire({
                      icon: 'error',
                      title: 'Advertencia',
                      text: 'Debe seleccionar un alumno',
                      footer: '<a href>Why do I have this issue?</a>'
                    })
    }else{
  

    
    $.ajax({
          type:"post",
          data:'idAlumnos=' + idAlumnos,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_inscrp_Acta_Examen2.php',
          success:function(res){
            console.log(res)

            if (res=='1') {


                toastr.success('El alumno se inscribio a la mesa');


                $('#situ'+idAlumnos).html('<FONT COLOR="red">INSCRIPTO</FONT>');

                  $.unblockUI();


            }else if (res=='2'){

                toastr.error('El alumno ya estaba inscripto');

                  $.unblockUI();

            }
   
    
          }
        });


}


   
    
}  





function regresar(idActa) {

    $.blockUI({ 
                                    message: '<h1>Espere !!</h1>',
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
          type:"post",
          data:'idActa=' + idActa,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/session_actaInscrAlumno.php',
          success:function(res){

                   
          
          }
        });

        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
       

        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaInsc-ALUMNO.php');
   



}








  $.unblockUI();
</script>



<?php } ?> 


