
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
  session_start();


    $operacion=$_SESSION["operacion"];



if (isset($_SESSION['buscarTipo'])){
$buscarTipo=$_SESSION['buscarTipo'];



?>

 
<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                    Tipo de Acta: <?php echo $buscarTipo ?>
                </h3>
              </div>
              <div class="card-body">

               <?php if ($operacion=='Lectura y Escritura'){ ?>

                <button id="btnActa" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo"><i class='fas fa-edit'></i></button><br> <hr> 
                   <?php
                                }
                            ?>  

                   <table id="tabla_acta" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°</th>
                                <th>ASIGNATURA</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA CIERRE</th>

                                <th>INSCRIPCIONES</th>

                                 <?php if ($operacion=='Lectura y Escritura'){ ?>

                                <th>BOTONES</th> 

                                 <?php
                                }
                            ?> 
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
                               
                                <td><?php echo $ciclo.'--'.$nombreAsignatura.'--'.$idPlan; ?> <button class="btn btn-info glyphicon glyphicon-pencil" title="PERSONAL DOCENTE ENCARGADO DE LA MESA" onclick="personalDocenteEncargo('<?php echo $idActa ?>')"> <i class="fas fa-user-tie"></i></button></td>
                                <td><?php

                                $date = date_create($precentacion);
                                $cadena_precentacion = date_format($date, 'd-m-Y');


                                 echo $cadena_precentacion; ?></td>

                                 <td><?php

                                $date_finalizacion = date_create($finalizacion);
                                $cadena_finalizacion = date_format($date_finalizacion, 'd-m-Y');


                                 echo $cadena_finalizacion; ?></td>
                                
                                <td><button class="btn btn-danger glyphicon glyphicon-pencil" title="INSCRIPCIONES A LA MESA" onclick="inscrpcionALUMNOS('<?php echo $idActa ?>')"><i class="fas fa-clipboard"></i></button></td>


                                <?php if ($operacion=='Lectura y Escritura'){ ?>


                                <td></td>

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
              <!-- /.card -->
            </div>












<?php if ($operacion=='Lectura y Escritura'){ ?>



 <div class="modal fade" id="modalCRUD_acta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  
            <div id="cont" class="modal-body">
           


 
                <div class="form-group">
              <label for="asignatura" class="col-form-label ediCur">ASIGNATURA Y CICLO:</label><br>
                        <select class="form-select" id="asignatura" >
                            <option value="0">Seleccione la Asignatura</option>
                             <?php

            

                             $c1onsulta = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan` FROM `plan_datos_asignaturas` ORDER BY `ciclo`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {

                                         $idAsig = $d1at['idAsig'];
                                         $nombre = $d1at['nombre'];
                                         $ciclo = $d1at['ciclo'];
                                         $idPlan = $d1at['idPlan'];

                               
                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }



                                ?>
                                <option value="<?php echo $idAsig; ?>"><?php echo $ciclo.'--'.$nombre.'--'.$idPlan; ?></option>
                                <?php } ?>
                        </select>
                
               </div>


                        <div class="form-group">
                  <label for="fechaActa" class="col-form-label">FECHA INICIO</label>
                  <div class="col-10">
                    <input class="form-control" type="date" id="fechaActa">
                  </div>
                </div>
                <div class="form-group">
                  <label for="fechaActa" class="col-form-label">FECHA CIERRE</label>
                  <div class="col-10">
                    <input class="form-control" type="date" id="fechaActaCierre">
                  </div>
                </div>

                   <div class="form-group">
              <label for="docente1" class="col-form-label ediCur">DOCENTE-PRESIDENTE:</label><br>
                        <select class="form-select" id="docente1" >
                             <option value="0">Seleccione un DOCENTE</option>
                             <?php

                                $c1onsulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idDocente'] ?>"><?php echo $d1at['nombre'].'--'.$d1at['dni'] ?></option>
                                <?php } ?>
                        </select>
                
               </div>

                  <div class="form-group">
              <label for="docente2" class="col-form-label ediCur">DOCENTE-1er SUPLENTE:</label><br>
                        <select class="form-select" id="docente2" >
                             <option value="0">Seleccione un DOCENTE</option>
                             <?php

                                $c1onsulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idDocente'] ?>"><?php echo $d1at['nombre'].'--'.$d1at['dni'] ?></option>
                                <?php } ?>
                        </select>
                
               </div>
                 <div class="form-group">
              <label for="docente3" class="col-form-label ediCur">DOCENTE-2er SUPLENTE:</label><br>
                        <select class="form-select" id="docente3" >
                             <option value="0">Seleccione un DOCENTE</option>
                             <?php

                                $c1onsulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idDocente'] ?>"><?php echo $d1at['nombre'].'--'.$d1at['dni'] ?></option>
                                <?php } ?>
                        </select>
                
               </div>
           
                                    
            </div> 
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="formActaFinal()" > <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>

     <?php } ?>
         
                                        
 


<script type="text/javascript">

$(document).ready(function(){

    
    var tabla_acta = $('#tabla_acta').DataTable({ 

    "destroy":true,  

     <?php if ($operacion=='Lectura y Escritura'){ ?>
  
    "columnDefs":[{
        "targets": -1,
        "data":null,
         "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item btnEditar_Acta" href="javascript:void(0)">Editar</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item btn_Eliminar" href="javascript:void(0)">Eliminar</a></li>
                                    </ul>
                                  </div>
                                `,
        
       }],

  <?php } ?>

        
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
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
      {
        extend:    'excelHtml5',
        text:      '<i class="fas fa-file-excel"></i> ',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        className: 'btn btn-info'
      },
    ]         
    });


$(document).on("click", ".btnEditar_Acta", function(){
    fila = $(this).closest("tr");


 
    idActa = parseInt(fila.find('td:eq(0)').text());

    


    $.ajax({
          type:"post",
          data:'idActa=' + idActa,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/actaEditarDatosPREfin.php',
          success:function(res){
         
            data = res.split('||');

                   
            asignatura = data[0];
            fechaActa = data[1];
            docente1 = data[2];
            docente2 = data[3];
            docente3 = data[4];

            fechaActaCierre = data[5];

            nombreAsignatura = data[6];
            docente1Nombre = data[7];
            docente2Nombre = data[8];
            docente3Nombre = data[9];


    
      $('#modalCRUD_acta').modal('show');
        
     
        $("#curso").show();
        $("#asicCURS").show();
        $(".ediCur").show();
        

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Acta Editar"); 


        $('#asignatura').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        $('#asignatura').val(asignatura).trigger('change.select2');
        
        $('#docente1').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        $('#docente1').val(docente1).trigger('change.select2');

        $('#docente2').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        $('#docente2').val(docente2).trigger('change.select2');

        $('#docente3').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        $('#docente3').val(docente3).trigger('change.select2');





  
            $("#fechaActa").val(fechaActa);
            $("#fechaActaCierre").val(fechaActa);
           
             
          }
        });
   

    opcion = 2; //editar
    
    


    
});



    $(document).on("click", ".btn_Eliminar", function(){    
    fila = $(this);
    idActa = parseInt($(this).closest("tr").find('td:eq(0)').text());

  
    opcion = 3 ;//borrar

    eliminarActa(idActa,opcion);
  
});
    




function eliminarActa(idActa,opcion) {

  

Swal.fire({
  title: 'Esta seguro de eliminar este registro?',
  text: "Los datos eliminados no se podran recuperar!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, eliminar este registro!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Deleted!',
      'Operación éxitosa',
      'success'
    )

    eliminarActaFinal(idActa,opcion);
  }
})



      
     
}


function  eliminarActaFinal(idActa,opcion){


   
        
        $.ajax({
            url: "modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_acta.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idActa:idActa},
            success: function(){
            
               
            }
        });

        tabla_acta.row(fila.parents('tr')).remove().draw();

}


    $('#btnActa').click(function(){
        
       
     

        $('#asignatura').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
       
        
        $('#docente1').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
      

        $('#docente2').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
       

        $('#docente3').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        




        $("#curso").show();
        $("#asicCURS").show();
        $(".ediCur").show();

        
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Acta");            
        $('#modalCRUD_acta').modal('show');


        idActa=null;
        opcion=1;
    });









 
});


function formActaFinal() {
  
    buscarTipo= $("#buscarTipo").val();
   
    asignatura= $("#asignatura").val();
    
    fechaActa = $("#fechaActa").val();

    docente1 = $("#docente1").val();
    docente2 = $("#docente2").val();
    docente3 = $("#docente3").val();
    fechaActaCierre = $("#fechaActaCierre").val();

   if (buscarTipo!='Seleccione el ACTAS' && asignatura != '0' && fechaActa!='' && fechaActaCierre!='' && docente1 != '0' && docente2 != '0' && docente3 != '0') {


    $.ajax({
          type:"post",
          data:'buscarTipo=' + buscarTipo + '&asignatura=' + asignatura + '&fechaActa=' + fechaActa + '&idActa=' + idActa + '&opcion=' + opcion + '&docente1=' + docente1 + '&docente2=' + docente2 + '&docente3=' + docente3 + '&fechaActaCierre=' + fechaActaCierre,
          url:"modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_acta.php",
          beforeSend: function() {
                    $('#imagenProceso').show();
                              },
          success:function(res){

      
                 data = res.split('||');

            idActa = data[0];            
            asignatura = data[1];
            precentacion = data[2];
            fechaActaCierre = data[3];

            

            boton=' <button class="btn btn-info glyphicon glyphicon-pencil" title="PERSONAL DOCENTE ENCARGADO DE LA MESA" onclick="personalDocenteEncargo('+idActa+')"><i class="fas fa-user-tie"></i></button></td>';

            botonInscrip='<button class="btn btn-danger glyphicon glyphicon-pencil" title="INSCRIPCIONES A LA MESA" onclick="inscrpcionALUMNOS('+idActa+')"><i class="fas fa-clipboard"></i></button></td>';

             tabla_acta = $('#tabla_acta').DataTable();
            
            if(opcion == 1){tabla_acta.row.add([idActa,asignatura+boton,precentacion,fechaActaCierre,botonInscrip]).draw();}
            else{tabla_acta.row(fila).data([idActa,asignatura+boton,precentacion,fechaActaCierre,botonInscrip]).draw();} 

            $('#imagenProceso').hide();  

            
          }
        });
   
    $("#modalCRUD_acta").modal("hide");


    }else{


        Swal.fire({
                  icon: 'error',
                  title: 'LOS CAMPOS INCOMPLETOS',
                  text: 'Controle cada campo',
                  footer: '<a href>Why do I have this issue?</a>'
                })



    }    
    

}



function personalDocenteEncargo(idActa) {

    $.ajax({
          type:"post",
          data:'idActa=' + idActa,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/actaDocenteACARGO.php',
          success:function(res){

            data = res.split('||');

            docentePresidente = data[0];            
            docente1erSuplente = data[1];
            docente2doSuplente = data[2];
          
            
            Swal.fire('Presidente es '+docentePresidente+'<br>1er suplente es '+docente1erSuplente+'<br>2do suplente es '+docente2doSuplente)
          
          }
        });
}


function inscrpcionALUMNOS(idActa) {

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

