

<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$operacion=$_SESSION["operacion"];



  if (isset($_SESSION['idCurso'])){
        
        $idCurso=$_SESSION['idCurso'];
        
        $nombre=$_SESSION['nombre'];

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivoFINAL= $cicloFF[0]; 
$edicion= $cicloFF[1]; 




        $cursoSeleB=$_SESSION['cursoSele'];




$consulta = "SELECT `descripasig_$cicloLectivoFINAL`.`idDescrip`, `descripasig_$cicloLectivoFINAL`.`idAsignatura`, `descripasig_$cicloLectivoFINAL`.`dia`, `descripasig_$cicloLectivoFINAL`.`horario`, `descripasig_$cicloLectivoFINAL`.`corresponde`, `descripasig_$cicloLectivoFINAL`.`idCurso`, `plan_datos_asignaturas`.`nombre` FROM `descripasig_$cicloLectivoFINAL` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`=`descripasig_$cicloLectivoFINAL`.`idAsignatura` WHERE `descripasig_$cicloLectivoFINAL`.`idCurso`='$idCurso'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<input hidden="" id="idCurso" value="<?php echo $idCurso; ?>">
<input hidden="" id="nombre" value="<?php echo $nombre; ?>">
<input hidden="" id="cicloLectivoFINAL" value="<?php echo $cicloLectivoFINAL; ?>">
<input hidden="" id="cursoSeleB" value="<?php echo $cursoSeleB; ?>">






  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Organización de Horarios: <?php echo $nombre; ?> </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            

                <div id="cargaCicloFRRR"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

                <button  class="btn btn-danger glyphicon glyphicon-pencil" onclick="regresarBotonAsig('')"><i class='fas fa-reply-all'></i> Regresar</button><br><hr>
                   <?php if ($operacion=='Lectura y Escritura'){ ?>

             <?php if ($edicion=='SI'){ ?>
                <button id="btn_nuevo_dia_hora" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo Ciclo Lectivo"><i class='fas fa-edit'></i></button><br> <hr>    

 <?php } ?>
  <?php } ?>

                   <table id="tablaDiaHorario" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th>
                                <th>ID ASIG</th>
                                <th>ASIGNATURA</th>  
                                <th>DIA</th>
                                <th>HORARIO</th> 

                                <?php if ($operacion=='Lectura y Escritura'){ ?>

             <?php if ($edicion=='SI'){ ?>                        
                                <th>Acciones</th>


 <?php } ?>
  <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                             $colorFinal='';

                            $contadorColores=0;                         
                            foreach($data as $dat) {
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
                  
                                <td><?php echo $dat['idDescrip']; ?></td>
                                <td><?php echo $dat['idAsignatura']; ?></td>
                                <td><?php echo $dat['nombre']; ?></td>
                                <td><?php echo $dat['dia']; ?></td>
                                <td><?php echo $dat['horario']; ?></td>
                    
           
                                <?php if ($operacion=='Lectura y Escritura'){ ?>

             <?php if ($edicion=='SI'){ ?>   
                                <td></td>

                                 <?php } ?>
  <?php } ?>
                            </tr>
                            <?php
                                
                            }
                            ?>                                
                        </tbody>        
                       </table>   




                </div>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>



    <?php if ($operacion=='Lectura y Escritura'){ ?>

             <?php if ($edicion=='SI'){ ?>   
<div class="modal fade" id="modal_DiaHorario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
   <form id="formDiaHorario">    
                         
            <div class="modal-body">


                 <div class="form-group">
                <label for="asicCURS" class="col-form-label">Asignatura:</label>
                <select class="form-control" id="asicCURS">
                  <option value="0">Seleccione una asignatura</option>

                <?php
     
  
          $IDcurso=$_SESSION['cursoSele'];




      $imprimir='';

    


      

      if ($IDcurso=='1° AÑO (1° AÑO P.C.)' || $IDcurso=='2° AÑO (2° AÑO P.C.)') {
           

          $consulta = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan` FROM `plan_datos_asignaturas` WHERE `ciclo`='$IDcurso' AND `idPlan`='básico'";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
          foreach($data as $dat) {
            $imprimir.='<option value="'.$dat['idAsig'].'">'.$dat['nombre'].'--'.$dat['idPlan'].'</option>';
           } 


     }else{


      $consulta = "SELECT plan_datos_asignaturas.idAsig, plan_datos_asignaturas.nombre, plan_datos_asignaturas.ciclo, plan_datos.nombre AS 'nombrePlan' FROM plan_datos_asignaturas INNER JOIN plan_datos ON plan_datos.idPlan= plan_datos_asignaturas.idPlan WHERE plan_datos_asignaturas.ciclo='$IDcurso'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      foreach($data as $dat) {
        $imprimir.='<option value="'.$dat['idAsig'].'">'.$dat['nombre'].'--'.$dat['nombrePlan'].'</option>';
       } 


       }


        echo $imprimir;



       ?>  
              
</select>
        </div>
 


               

                <div class="form-group">
                <label for="dia" class="col-form-label">DIA:</label>
                <select class="form-control" id="dia">
                <option>LUNES</option>
                <option>MARTES</option>
                <option>MIERCOLES</option>
                <option>JUEVES</option>
                <option>VIERNES</option>

                </select>
                </div> 


                <div class="form-group">
                <label for="horario" class="col-form-label">HORARIOS:</label>
                <select class="form-control" id="horario">
                
                <optgroup label="Mañana">
                <option>07:30-08:10</option>
                <option>08:10-08:50</option>
                <option>09:00-09:40</option>
                <option>09:40-10:20</option>
                <option>10:30-11:10</option>
                <option>11:10-11:50</option>
                <option>11:50-12:30</option>
                <option>12:30-13:10</option>
                </optgroup>
                 <optgroup label="Tarde">

                
                <option>13:30-14:10</option>
                <option>14:10-14:50</option>
                <option>15:00-15:40</option>
                <option>15:40-16:20</option>
                <option>16:30-17:10</option>
                <option>17:10-17:50</option>
                <option>17:50-18:30</option>

                <option>18:30-19:10</option>
                <option>19:10-19:50</option>
                <option>19:50-20:30</option>

                 </optgroup>


                <optgroup label="Vespertino">

                <option>18:00-18:40</option>
                <option>18:40-19:20</option>
                <option>19:30-20:10</option>
                <option>20:10-20:50</option>

                <option>21:00-21:40</option>
                <option>21:40-22:20</option>
                <option>22:20-23:00</option>
                <option>23:00-23:40</option>
    
                </optgroup>

                </select>
                </div>                
               

            </div>   
                             
                                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark"> <i class='fas fa-save'></i> Guardar</button>
            </div>
        </form> 
    </div>
  </div>
</div>

      

 <?php } ?>

<?php } ?>

 <script type="text/javascript">
$(document).ready(function(){
$('#imagenProceso').hide();
      $('#cargaCicloFRRR').hide();

    var tablaDiaHorario = $('#tablaDiaHorario').DataTable({ 

    "destroy":true,
    "pageLength" : 2, 

    
           <?php if ($operacion=='Lectura y Escritura'){ ?>

      
 <?php if ($edicion=='SI'){ ?> 
    "columnDefs":[{
        "targets": -1,
        "data":null,

         "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item btn_editar-diaHorario" href="javascript:void(0)">Editar</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item btn_eliminar_DiaHorario" href="javascript:void(0)">Eliminar</a></li>
                                    </ul>
                                  </div>
                                </div>`,  
       }],
         <?php } ?>
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



 <?php if ($operacion=='Lectura y Escritura'){ ?>

      
 <?php if ($edicion=='SI'){ ?>


$("#btn_nuevo_dia_hora").click(function(){

    $("#formPersonasPlanAsignatura").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo");            
    $("#modal_DiaHorario").modal("show"); 

  
    idDescrip=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    




$(document).on("click", ".btn_editar-diaHorario", function(e){
    e.preventDefault(); 
    fila = $(this).closest("tr");

 
    idDescrip = parseInt(fila.find('td:eq(0)').text());
    idAsig = parseInt(fila.find('td:eq(1)').text());
    dia = fila.find('td:eq(3)').text();
    horario = fila.find('td:eq(4)').text();

    $("#asicCURS").val(idAsig);
    $("#dia").val(dia);
    $("#horario").val(horario);



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar");            
    $("#modal_DiaHorario").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btn_eliminar_DiaHorario", function(e){ 
e.preventDefault();    
    fila = $(this);
    idDescrip = parseInt($(this).closest("tr").find('td:eq(0)').text());

    dia = $(this).closest("tr").find('td:eq(1)').text();

    horario = $(this).closest("tr").find('td:eq(2)').text();

    opcion = 3 ;//borrar


 

    eliminarHorarioDia(idDescrip,dia,horario);
  
});
    
function remover () {

    $('#cursoSele').val('Seleccione ciclo');
    $('#planSeleC').val('Seleccione un Plan');
    $('#cicloLectivo').val('Seleccione un año lectivo');

    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  





}




function eliminarHorarioDia(idDescrip,dia,horario) {

  

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

    eliminarHorarioDiaFinal(idDescrip,dia,horario);
  }
})



      
     
}


function  eliminarHorarioDiaFinal(idDescrip,dia,horario){


   cicloLectivo = $("#cicloLectivo").val();

        $.ajax({
            url: "modulos/cargaDatos/datosCurso/elementos/crud_fechaHorario_AsignaturaSuperiro.php",
            type: "POST",
            dataType: "json",
             beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_nuevo_dia_hora").disabled = true;
                                
                                $('#cargaCicloFRRR').show();
                              },
            data: {opcion:opcion, idDescrip:idDescrip, cicloLectivo:cicloLectivo },
            success: function(){
            
               
            }
        });

        tablaDiaHorario.row(fila.parents('tr')).remove().draw();

         $("#imagenProceso").hide();
                                document.getElementById("btn_nuevo_dia_hora").disabled = false;
                        
                                $('#cargaCicloFRRR').hide();

}




$("#formDiaHorario").submit(function(e){
    e.preventDefault();    
 


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

  
    dia = $.trim($("#dia").val());
    horario = $.trim($("#horario").val());

    idAsig = $("#asicCURS").val();

    idCurso = $("#idCurso").val();
    nombre = $("#nombre").val();
    cicloLectivo = $("#cicloLectivoFINAL").val();
    cursoSeleB = $("#cursoSeleB").val();


console.log({idDescrip:idDescrip, dia:dia,  opcion:opcion, horario:horario, idAsig:idAsig, idCurso:idCurso, nombre:nombre, cicloLectivo:cicloLectivo, cursoSeleB:cursoSeleB});
 if (idAsig!='0') {
    $.ajax({
        url: "modulos/cargaDatos/datosCurso/elementos/crud_fechaHorario_AsignaturaSuperiro.php",
        type: "POST",
        dataType: "json",
          beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_nuevo_dia_hora").disabled = true;
                                
                                $('#cargaCicloFRRR').show();
                              },
        data: {idDescrip:idDescrip, dia:dia,  opcion:opcion, horario:horario, idAsig:idAsig, idCurso:idCurso, nombre:nombre, cicloLectivo:cicloLectivo, cursoSeleB:cursoSeleB},
        success: function(data){  
          

          
            idDescrip2 = data[0].idDescrip;  

           

            if (idDescrip2!='error') {

            idAsignatura2 = data[0].idAsignatura;

            nombre = data[0].nombre;

            dia2 = data[0].dia;
            horario2 = data[0].horario;
          

        
            if(opcion == 1){tablaDiaHorario.row.add([idDescrip2,idAsignatura2,nombre,dia2,horario2]).draw();}
            else{tablaDiaHorario.row(fila).data([idDescrip2,idAsignatura2,nombre,dia2,horario2]).draw();}  


         $("#imagenProceso").hide();
                                document.getElementById("btn_nuevo_dia_hora").disabled = false;
                        
                                $('#cargaCicloFRRR').hide();

            }else{

                Swal.fire({
                  icon: 'error',
                  title: 'Ya esta cargado este horario y día en una asignatura',
                  text: 'Carge otro horario o día',
                  footer: '<a href>Why do I have this issue?</a>'
                })


 

            }          
        }        
    });
    $("#modal_DiaHorario").modal("hide");


 $.unblockUI();

    }else{
        Swal.fire({
                  icon: 'error',
                  title: 'Campos incompletos',
                  text: 'Debe seleccionar una asignatura',
                  footer: '<a href>Why do I have this issue?</a>'
                })


 $.unblockUI();
    }    
    
});        



  <?php } ?>
         <?php } ?>
 
});


function regresarBotonAsig() {

        

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


         $('#imagenProceso').show();
           
            $('#tablaInstitucional').load('modulos/cargaDatos/datosCurso/curso_Superior.php');
            $('#imagenProceso').hide(); 



}

 $.unblockUI();
</script>

<?php } ?>
