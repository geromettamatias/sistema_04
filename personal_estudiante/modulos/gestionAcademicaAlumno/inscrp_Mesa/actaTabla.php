<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['buscarTipo'])){
$buscarTipo=$_SESSION['buscarTipo'];




$s_usuarioEstudiante=$_SESSION['s_usuarioEstudiante'];


  
        $c9onsulta = "SELECT idAlumnos FROM datosalumnos WHERE dniAlumnos = '$s_usuarioEstudiante'";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $idAlumnos=$d9at['idAlumnos'];
           
         }



?>






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



            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  TABLA DE INSCRIPCIONES
                </h3>
              </div>
              <div class="card-body">

                

                <div class="table-responsive">        
                        <table id="tabla_acta" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°</th>
                                <th>ASIGNATURA</th>
                                <th>FECHE DE INICIO</th>
                                <th>FECHE DE CIERRE</th>
                         

                                <th>INSCRIPCIONES</th>
                                <th>ELIMINAR INSCRIP</th>
                     
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                              $colorFinal='';

                            $contadorColores=0;  

                            $consulta = "SELECT actas_examen_datos.idActa, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.nombre AS 'nombreAsignatura', plan_datos_asignaturas.idPlan, actas_examen_datos.precentacion, actas_examen_datos.finalizacion FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura WHERE actas_examen_datos.tipo = '$buscarTipo'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($d1ata as $d1at) { 

                              

                            $idActa=$d1at['idActa'];
                            $ciclo=$d1at['ciclo'];
                            $idPlan=$d1at['idPlan'];
                            $nombreAsignatura=$d1at['nombreAsignatura'];
                            $precentacion=$d1at['precentacion'];
                            $finalizacion=$d1at['finalizacion'];


                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }



                            
                         

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
                                <td><?php echo $idActa ?></td>
                               
                                <td><?php echo $idPlan.'--'.$ciclo.'--'.$nombreAsignatura; ?> <button class="btn btn-outline-info glyphicon glyphicon-pencil" onclick="personalDocenteEncargo('<?php echo $idActa ?>')"> PERSONAL DOCENTE</button></td>
                                <td><?php

                                $date = date_create($precentacion);
                                $cadena_fecha_actual = date_format($date, 'd-m-Y');


                                 echo $cadena_fecha_actual; ?></td>

                                 <td><?php

                                $date_finalizacion = date_create($finalizacion);
                                $cadena_date_finalizacion = date_format($date_finalizacion, 'd-m-Y');


                                 echo $cadena_date_finalizacion; ?></td>
                                
                                

                                <?php   
                                $res=0;
                                $consulta = "SELECT `idInscripcion`, `idActa`, `idAlumno`, `notaEsc`, `notaOral`, `promNumérico`, `promLetra` FROM `acta_examen_inscrip` WHERE `idActa`='$idActa' AND `idAlumno`= '$idAlumnos'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $res = 1;

                                        }

                                   if ($res==0) {
                                     
                                ?>



                                    <td>

                                        <button id="finalBotonInscri-<?php echo $idActa ?>" class="btn btn-outline-success glyphicon glyphicon-pencil" onclick="inscrpcionALUMNOSFINAL('<?php echo $idActa ?>')">INSCRIPCIONES</button>

                                        
                                    </td>


                                <?php
                                     }else{


                                 ?> 

                                     <td>

                                        <button id="finalBotonInscri-<?php echo $idActa ?>" class="btn btn-outline-success glyphicon glyphicon-pencil" onclick="inscrpcionALUMNOSFINAL('<?php echo $idActa ?>')" disabled >INSCRIPCIONES</button>

                                       
                                    </td>


                                  <?php
                                     }

                                        
                                   if ($res==0) {
                                     
                                ?>



                                    <td>

                                
                                        <button id="fota--<?php echo $idActa ?>" class="btn btn-outline-danger glyphicon glyphicon-pencil" onclick="eliminarInscrpcionALUMNOSFINAL('<?php echo $idActa ?>')" disabled >ELIMINAR INSC</button>

                                    </td>


                                <?php
                                     }else{


                                 ?> 

                                     <td>

                              
                                        <button id="fota--<?php echo $idActa ?>" class="btn btn-outline-danger glyphicon glyphicon-pencil" onclick="eliminarInscrpcionALUMNOSFINAL('<?php echo $idActa ?>')">ELIMINAR INSC</button>

                                    </td>


                                  <?php
                                     }

                                        
                                 ?> 
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                   

               
              </div>
              <!-- /.card -->
            </div>











<script type="text/javascript">
$(document).ready(function(){

    
    var tabla_acta = $('#tabla_acta').DataTable({ 

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


function personalDocenteEncargo(idActa) {

    $.ajax({
          type:"post",
          data:'idActa=' + idActa,
          url:'modulos/gestionAcademicaAlumno/inscrp_Mesa/elementos/actaDocenteACARGO.php',
          success:function(res){

            data = res.split('||');

            docentePresidente = data[0];            
            docente1erSuplente = data[1];
            docente2doSuplente = data[2];
          
            
            Swal.fire('Presidente es '+docentePresidente+'<br>1er suplente es '+docente1erSuplente+'<br>2do suplente es '+docente2doSuplente)
          
          }
        });
}




function inscrpcionALUMNOSFINAL(idActa) {


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





    idAlu=$('#idAlu').val();
   

    $.ajax({
          type:"post",
          data:'idActa=' + idActa + '&idAlu=' + idAlu,
          url:'modulos/gestionAcademicaAlumno/inscrp_Mesa/elementos/ingresarInscrip.php',
          success:function(res){


            document.getElementById("finalBotonInscri-"+idActa).disabled = true;
            document.getElementById("fota--"+idActa).disabled = false;

            Swal.fire(
                          'INSCRIPCIÓN EXITOSA',
                          'Los datos se registraron',
                          'success'
                        )

               $.unblockUI();


          
          }
        });
}





function eliminarInscrpcionALUMNOSFINAL(idActa) {


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





    idAlu=$('#idAlu').val();
 
    $.ajax({
          type:"post",
          data:'idActa=' + idActa + '&idAlu=' + idAlu,
          url:'modulos/gestionAcademicaAlumno/inscrp_Mesa/elementos/ingresarInscrip2.php',
          success:function(res){


            document.getElementById("finalBotonInscri-"+idActa).disabled = false;
            document.getElementById("fota--"+idActa).disabled = true;

            Swal.fire(
                          'SE ELIMINO LA INSCRIPCIÓN',
                          'La inscripción fue eliminada',
                          'success'
                        )

            
              $.unblockUI();
          
          }
        });
}



   $.unblockUI();


</script>  



<?php } ?> 

