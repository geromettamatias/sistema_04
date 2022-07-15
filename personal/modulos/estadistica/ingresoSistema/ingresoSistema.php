
<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

     


?>






  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">PERSONAL-DOCENTE-ALUMNO que Ingreso al Sitio</h3>

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

                    <button class="btn btn-danger" title="LIMPIAR" onclick="limpiar()"><i class="fas fa-cog fa-spin"></i></button>

                    <hr>
                  

            <h3>Alumnos</h3>
 
    <table  class="table table display example" style="width:100%">
     <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>DNI</th>
                                <th>Apellido y Nombre</th> 
                                <th>INGRESO</th> 
                           
                            </tr>
                    </thead>
     <tbody>

                            <?php 


                                $consulta = "SELECT ingreso_sistema_alumno.id_ingreso, ingreso_sistema_alumno.data, datosalumnos.dniAlumnos, datosalumnos.nombreAlumnos FROM ingreso_sistema_alumno INNER JOIN datosalumnos ON datosalumnos.idAlumnos = ingreso_sistema_alumno.id_user";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);



                                                     
                            foreach($data as $dat) {    
                            ?>
                            <tr>
                             
                                <td><?php echo $dat['id_ingreso'] ?></td>
                                <td><?php echo $dat['dniAlumnos'] ?></td>
                                <td><?php echo $dat['nombreAlumnos'] ?></td>
                                <td><?php echo $dat['data'] ?></td>
                              
                            </tr>
                               <?php
                                }
                            ?>    
    <tfoot>
        <tr>
            <th>N°</th> 
            <th>DNI</th>
            <th>Apellido y Nombre</th> 
            <th>INGRESO</th> 
        </tr>
    </tfoot>
</table>



   <h3>Docentes</h3>

  <table  class="table table display example" style="width:100%">
     <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>DNI</th>
                                <th>Apellido y Nombre</th> 
                                <th>INGRESO</th> 
                           
                            </tr>
                    </thead>
     <tbody>

                            <?php 


                                $consulta = "SELECT ingreso_sistema_docente.id_ingreso, ingreso_sistema_docente.data, datos_docentes.dni, datos_docentes.nombre FROM ingreso_sistema_docente INNER JOIN datos_docentes ON ingreso_sistema_docente.id_user=datos_docentes.idDocente";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);



                                                     
                            foreach($data as $dat) {    
                            ?>
                            <tr>
                             
                                <td><?php echo $dat['id_ingreso'] ?></td>
                                <td><?php echo $dat['dni'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['data'] ?></td>
                              
                            </tr>
                               <?php
                                }
                            ?>    
    <tfoot>
        <tr>
            <th>N°</th> 
            <th>DNI</th>
            <th>Apellido y Nombre</th> 
            <th>INGRESO</th> 
        </tr>
    </tfoot>
</table>



   <h3>Personal</h3>


  <table  class="table table display example" style="width:100%">
     <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
            <th>CARGO</th> 
            <th>DNI</th>
            <th>Apellido y Nombre</th> 
            <th>INGRESO</th> 
                           
                            </tr>
                    </thead>
     <tbody>

                            <?php 


                                $consulta = "SELECT ingreso_sistema_personal.id_ingreso, ingreso_sistema_personal.data, personal_eet16.nombre, personal_eet16.dni, personal_eet16.cargo FROM ingreso_sistema_personal INNER JOIN personal_eet16 ON personal_eet16.idUsu= ingreso_sistema_personal.id_user;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);



                                                     
                            foreach($data as $dat) {    
                            ?>
                            <tr>
                             
                                <td><?php echo $dat['id_ingreso'] ?></td>
                                <td><?php echo $dat['cargo'] ?></td>
                                <td><?php echo $dat['dni'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['data'] ?></td>
                              
                            </tr>
                               <?php
                                }
                            ?>    
    <tfoot>
        <tr>
            <th>N°</th> 
            <th>CARGO</th> 
            <th>DNI</th>
            <th>Apellido y Nombre</th> 
            <th>INGRESO</th> 
        </tr>
    </tfoot>
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


<script type="text/javascript">

     $('#imagenProceso').hide();
      $('#cargaCiclo').hide();

    var myTable = $('.example').DataTable({
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



function remover () {

  
    $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}

 function limpiar(){

 Swal.fire({
  title: 'Aclaración',
  text: "SE ELIMINARA TODO LOS REGISTROS !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI'
}).then((result) => {
  if (result.isConfirmed) {
      
      limpiarFinal();


  }
})



}

function limpiarFinal(){




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
            url: "modulos/estadistica/ingresoSistema/elementos/limpiar.php",
            type: "POST",
            data: {},
            success: function(r){
            
                if (r==1) {
                    $('#tablaInstitucional').load('modulos/estadistica/ingresoSistema/ingresoSistema.php');


                    toastr.warning('Se Elimino el ciclo ');
                   
                }else{
                     toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                }
               
            }
        });



}


$.unblockUI(); 
</script>


