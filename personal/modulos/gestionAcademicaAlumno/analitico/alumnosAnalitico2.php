
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
<!--INICIO del cont principal-->

 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$operacion=$_SESSION["operacion"];


if (isset($_SESSION['idAlumnos'])){
$idAlumnos=$_SESSION['idAlumnos'];


$c3onsulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumnos'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $nombreAlumnos=$d3at['nombreAlumnos'];
            $dniAlumnos=$d3at['dniAlumnos'];
         }




    $c9onsulta = "SELECT datosalumnos.dniAlumnos, datosalumnos.nombreAlumnos, plan_datos.nombre FROM datosalumnos INNER JOIN plan_datos ON plan_datos.idPlan = datosalumnos.idPlanEstudio WHERE datosalumnos.idAlumnos = '$idAlumnos'";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $dniAlumnos=$d9at['dniAlumnos'];
            $nombreAlumnos=$d9at['nombreAlumnos'];
            $nombrePlan=$d9at['nombre'];
         }

?>
<hr>
<br>
<button id="RegresarAnalirico"  type="button" class="btn btn-success" data-toggle="modal" title="Regresar lista de Alumnos"><i class='fas fa-reply'></i></button>
<br>
<hr>
<input type="text" hidden=""  id="datosF311" value="<?php echo 'Modalidad: '.$nombrePlan. ' -- Apellido y nombre: '.$nombreAlumnos.'; DNI: : '.$dniAlumnos; ?>">

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Analítico de:
                    <div id="datosF411">Modalidad: <?php echo $nombrePlan; ?> </div>
                    <div id="nombreAlumnosF311">Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></div>
                    <div id="dniF311">DNI del Alumno:<?php echo $dniAlumnos; ?></div>

                </h3>
              </div>
              <div class="card-body">


                             

                   

             
             
                  <div class="btn-group" role="group">

                                    

                               
                                    <button id="btnGroupDrop1Bu" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-print"></i></button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1Bu">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item modalCRUD_AnaliticoAlumnoFinas" href="javascript:void(0)">Analítico (MODELO VIEJO)</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item modalCRUD_AnaliticoAlumnoFinasNuevo" href="javascript:void(0)">Analítico (NUEVO MODELO)</a></li>
                                    </ul>
                                    <form id="inpudFinal">

                       
                                          <?php if ($operacion=='Lectura y Escritura'){ ?>

                                     <button type="button" class="btn btn-info p-2" data-toggle="modal" title="Datos extras del Analítico" onclick="botonEXTRA('<?php echo $idAlumnos ?>')"><i class='fas fa-file-alt'></i></button>  

                                     <button type="button" class="btn btn-danger p-2" data-toggle="modal" title="GUARDAR LOS DATOS EDITADOS DEL ANALITICO" onclick="guardarAnalit()"><i class='fas fa-save'></i></button>  


                                       <?php } ?>

                                  </div>
                                




                    <h5>Aclaración: Si utiliza el Buscador, solo se guardarán los datos que fueron buscados (se recomienda guardar los datos editados y luego utilizar el buscador)  </h5>
               

                   <table id="tablanotas111" class="table table-bordered border-primary table-sm" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th>
                                <th>CICLO</th> 
                                <th>ESPACIO CURRICULAR</th>
                                <th >CALIF NUME</th>
                                <th style="width: 50px;">CALIF ESCR</th> 
                                <th>CONDICIÓN</th> 
                                <th>MES</th> 
                                <th>AÑO</th>
                                <th>ESTABLECI.</th> 
                                
                                                    
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $colorFinal='';

                            $contadorColores=0;     
                            $consulta = "SELECT analitico.idAnalitico, plan_datos_asignaturas.nombre, plan_datos_asignaturas.ciclo, analitico.nota, analitico.notaEscr,  analitico.fechaMes, analitico.fechaAño,  analitico.condicion,  analitico.establecimiento FROM analitico INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = analitico.idAsig WHERE analitico.idAlumno = '$idAlumnos'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
                            foreach($data as $dat) {                                
                    
                                $idAnalitico=$dat['idAnalitico'];
                                $nota=$dat['nota'];
                                $notaEscr=$dat['notaEscr'];

                                $ciclo=$dat['ciclo'];
                                $nombre=$dat['nombre'];

                                $fechaMes=$dat['fechaMes'];
                                 $fechaAño=$dat['fechaAño'];
                                $condicion=$dat['condicion'];
                                 $establecimiento=$dat['establecimiento'];
                            

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
                              
                                <td><?php echo $idAnalitico ?></td>
                                <td><?php echo $ciclo ?></td>
                                <td><?php echo $nombre ?></td>

                                <td><input type="number" class="form-control bg-dark-x border-0" id="nota_<?php echo $idAnalitico; ?>" value="<?php echo $nota; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="notaEscr_<?php echo $idAnalitico; ?>" value="<?php echo $notaEscr; ?>" ></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="condicion_<?php echo $idAnalitico; ?>" value="<?php echo $condicion; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="fechaMes_<?php echo $idAnalitico; ?>" value="<?php echo $fechaMes; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="fechaAño_<?php echo $idAnalitico; ?>" value="<?php echo $fechaAño; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="establecimiento_<?php echo $idAnalitico; ?>" value="<?php echo $establecimiento; ?>"></td>


                                
           
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>               
                   </form>
               
              </div>
              <!-- /.card -->
            </div>






            
                        
                          
             








 <script type="text/javascript">





$(document).ready(function(){

     Swal.fire(
          'IMPORTANTE !!',
          'No se olvide de guardar los datos despues de modificarlos',
          'warning'
        )

    

    var tablanotas = $('#tablanotas111').DataTable({ 

        
    "destroy":true,
     scrollX:        "400px",   
     scrollY:        "200px",
     
        paging:         false,
         fixedColumns: false,
        // fixedColumns:   {
        //     leftColumns: 2//Le indico que deje fijas solo las 2 primeras columnas
        // },




   
     language: {
      lengthMenu: "Display _MENU_ records per page",
      zeroRecords: "Nothing found - sorry",
      info: "Showing page _PAGE_ of _PAGES_",
      infoEmpty: "No records available",
      search: "",
      searchPlaceholder: "Buscar",
      loadingRecords: "Cargando...",
      processing: "Procesando....",
      paginate: {
        first: "primero",
        last: "ultimo",
        next: "siguiente",
        previous: "anterior"
      },
      infoFiltered: "(filtered from _MAX_ total records)"
    },
   

  
   
    });



$("#RegresarAnalirico").click(function(){

    $('#buscarTablaInstitucional').show();

    $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/analitico/alumnosAnalitico1.php');
          
    
}); 




var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".modalCRUD_AnaliticoAlumnoFinas", function(){


 window.open('modulos/gestionAcademicaAlumno/analitico/alumnosAnalitico3.php', '_blank');   

});
$(document).on("click", ".modalCRUD_AnaliticoAlumnoFinasNuevo", function(){


 window.open('modulos/gestionAcademicaAlumno/analitico/alumnosAnalitico4.php', '_blank');   

});





});




    <?php if ($operacion=='Lectura y Escritura'){ ?>

                                

function guardarAnalit(){

tablanotas = $('#tablanotas111').DataTable();
  

Swal.fire({
  title: 'ESTA SEGURO DE EDITAR',
  text: "Una vez editado no se podra recuperar la nota",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.isConfirmed) {
    

    

        tablanotas.rows().data().each(function (value) {
            var analitico= value[0];
        
               
            analiticoFinal(analitico);


            });
           
            
            Swal.fire(
          'MUY BIEN',
          'Los datos fueron registrados y guardados en la base de dato',
          'success'
        )

            
          

  }
})



}








                                




function analiticoFinal(analitico) {
   

    
    nota = $("#nota_"+analitico).val();
    notaEscr = $("#notaEscr_"+analitico).val();
    fechaMes = $("#fechaMes_"+analitico).val();
    fechaAño = $("#fechaAño_"+analitico).val();
    condicion = $("#condicion_"+analitico).val();
    establecimiento = $("#establecimiento_"+analitico).val();

        
        if (nota === undefined) {
             console.log('NO Registrado/Analitico '+analitico)
        }
        else {
           console.log('Guardado:'+nota+'/Analitico '+analitico)


               $.ajax({
                    url: "bd/crud_AnaliticoFinal.php",
                    type: "POST",
                    dataType: "json",
                    data: {analitico:analitico, nota:nota, establecimiento:establecimiento, notaEscr:notaEscr, fechaMes:fechaMes, fechaAño:fechaAño, condicion:condicion},
                    success: function(data){  
                       
                        

                    }        
                });
        }

     

    

    
    
}    
 

















function botonEXTRA(idAlumno) {



  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno,
    url:'modulos/gestionAcademicaAlumno/analitico/elementos/buscarDatosAnalitico.php',
    success:function(res){
      console.log(res);
        
            data = res.split('||');

            Libro = data[0];            
            Folio = data[1];
            egreso = data[2];
            lugar = data[3];
            fecha = data[4];
            obs = data[5];
         

    Swal.fire({
              title: 'Datos del Analítico',
              html:`<div class="col-12">
              <div class="form-group">
                  <label for="Libro" class="col-form-label">Libro:</label>
                  <input type="text" class="form-control" id="Libro" value='`+Libro+`'>
              </div>
              <div class="form-group">
                  <label for="Folio" class="col-form-label">Folio:</label>
                  <input type="text" class="form-control" id="Folio" value='`+Folio+`'>
              </div>
              <div class="form-group">
                  <label for="egreso" class="col-form-label">FECHA DE EGRESO::</label>
                  <input type="text" class="form-control" id="egreso" value='`+egreso+`'>
              </div>
              <div class="form-group">
                  <label for="lugar" class="col-form-label">LUGAR:</label>
                  <input type="text" class="form-control" id="lugar" value='`+lugar+`'>
              </div>
              <div class="form-group">
                  <label for="fecha" class="col-form-label">FECHA:</label>
                  <input type="text" class="form-control" id="fecha" value='`+fecha+`'>
              </div>
              <div class="form-group">
                  <label for="obs" class="col-form-label">OBSERVACIONES: Ingresó con:</label>
                  <input type="text" class="form-control" id="obs" value='`+obs+`'>
              </div>
            
            </div>`, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  Libro = document.getElementById('Libro').value,
                  Folio = document.getElementById('Folio').value,
                  egreso = document.getElementById('egreso').value,
                  lugar = document.getElementById('lugar').value,
                   fecha = document.getElementById('fecha').value,
                   obs = document.getElementById('obs').value,
                
                 ingresarDatosAnalitico(idAlumno,Libro,Folio,egreso,lugar,fecha,obs);
                                  
                }
        });



    }
  });


  
          
}

function ingresarDatosAnalitico(idAlumno,Libro,Folio,egreso,lugar,fecha,obs) {
  
  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno +'&Libro=' + Libro +'&Folio=' + Folio +'&egreso=' + egreso +'&lugar=' + lugar +'&fecha=' + fecha +'&obs=' + obs,
    url:'modulos/gestionAcademicaAlumno/analitico/elementos/ingresarDatosAnalitico.php',
    success:function(r){

      Swal.fire(
            'Muy bien !!',
            'Operación exitosa',
            'success'
          )

    }
  });

}


    <?php } ?>




 $.unblockUI();
</script>




<?php  } ?>



