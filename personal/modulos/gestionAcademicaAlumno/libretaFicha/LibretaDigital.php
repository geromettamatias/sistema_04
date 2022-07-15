
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



table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}



</style>

<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$idIns=$_SESSION['idIns'];

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$cursoSe=$_SESSION['cursoSe'];

$operacion=$_SESSION["operacion"];

    $c2onsulta = "SELECT `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idIns`='$idIns'";
    $r2esultado = $conexion->prepare($c2onsulta);
    $r2esultado->execute();
    $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

    foreach($d2ata as $d2at) {
        $nombreAlumnos=$d2at['nombreAlumnos'];
        $dniAlumnos=$d2at['dniAlumnos'];
        $nombreCurso=$d2at['nombre'];
     } 



?>



<input hidden="" id="cursoSe" value="<?php echo $cursoSe; ?>">
<input hidden="" id="ciclo" value="<?php echo $cicloLectivo; ?>">

















  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-danger">
              
              <div class="card-header">
                <h3 class="card-title">NOTAS E INFORMES DEL ALUMNO</h3>

                <div class="card-tools">

                     <button id="RegresarLibreta" type="button" class="btn btn-tool"  title="Regresar lista de Alumno del curso">
                    <i class='fas fa-reply-all'></i>
                  </button>


                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover66()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

                <div id="datosF">Curso: <?php echo $nombreCurso; ?></div>
            <div id="nombreAlumnosF">Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></div>
            <div id="dniF">DNI del Alumno:<?php echo $dniAlumnos; ?></div>



                      <button type="button" class="btn btn-danger p-2" data-toggle="modal" title="Imprimir Toda la Ficha (SIN INFORME)" onclick="modalCRUD_Libreta_DocentefiFinalFichaAlumnoSIN()"><i class='fas fa-print'></i>Ficha (SIN INFORME)</button>

                      <button type="button" class="btn btn-warning p-2" data-toggle="modal" title="'Imprimir Toda la Ficha" onclick="modalCRUD_Libreta_DocentefiFinalFichaAlumnoCON()"><i class='fas fa-print'></i>Ficha (CON INFORME)</button>

                      <button type="button" class="btn btn-secondary p-2" data-toggle="modal" title="Imprimir Toda la Ficha" onclick="modalCRUD_Libreta_DocentefiFinalFichaAlumnoINFORME()"><i class='fas fa-print'></i>SOLO INFORME</button>

                      <button type="button" class="btn btn-dark p-2" data-toggle="modal" title="Imprimir Toda la Libreta" onclick="modalCRUD_Libreta_DocentefiFinal()"><i class='fas fa-print'></i>Libreta</button>
                      
                      

                         
                      <hr>




                        <form id="inpudFinal">


<?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')){ ?>

     <?php   

    

      if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'AUXILIAR')){  ?>

                         <button type="button" class="btn btn-danger p-2" data-toggle="modal" title="GUARDAR LOS DATOS EDITADOS DE LA LIBRETA" onclick="ingresarNotaBaseDato()" <?php

                         if ($_SESSION['operacion'] =='Lectura y Escritura') {
                             echo '';
                         }else{

                       
                             echo 'disabled';
                            
                            
                         }




                          ?>><i class='fas fa-save'></i></button>






                            




                           <button type="button" class="btn btn-info p-2" data-toggle="modal" title="GUARDAR LOS DATOS EN EL ANALÍTICO" onclick="ingresarAnalitico()" <?php

                         if ($_SESSION['operacion'] =='Lectura y Escritura') {
                             echo '';
                         }else{

                       
                             echo 'disabled';
                            
                            
                         }




                          ?>><i class='fas fa-save'></i></button>

    <?php    }  ?>              
   



<?php } ?>

                      </div>
                    

    
                    <h5>Aclaración: Si utiliza el Buscador, solo se guardarán los datos que fueron buscados (se recomienda guardar los datos editados y luego utilizar el buscador)  </h5>

         
            <table id="tablaNotasFin" class="table table-bordered border-primary table-sm">

            <thead class="text-center">
                <tr>
                                           
                    <th>N°Lib</th> 
                    <th>Asignatura</th>
                    
                    <?php
                        $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo`";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();
                        $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);

                        $contador=0;


                         $nomLibr=0; 
                         $nomFicha=0;
                         $contadorColumnas=0; 


                   

                        foreach($data1 as $dat1) {
                            $contador++;


                      $corresponde=$dat1['corresponde'];
                      $descri=$dat1['descri'];

                    
                    $steli='';
                      if ($descri=='INFORME'){
                         $steli="style='font-size: 12px; vertical-align:middle;'";
                         $steli_2='WIDTH="200"';
                      }else{

                        $steli="style='font-size: 12px;writing-mode: vertical-rl; transform: rotate(180deg); vertical-align:middle;'";
                        $steli_2='';

                      }

                   
                                                                          
                    ?>
                    <th <?php echo $steli_2; ?>> <span class="p-2" <?php echo $steli; ?>><div id="nombre-<?php echo $contadorColumnas; 
                     $contadorColumnas++; ?>"><?php echo $dat1['nombre']; ?></div>

                    


                    <?php 

                
                      if ($corresponde=='FICHA/LIBRETA'){

                     ?>

                        </span>
                       <div class="btn-group" role="group">
                        <button id="btnGroupDrop1<?php echo $nomFicha ?>" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                         <i class="fas fa-cog fa-print"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1<?php echo $nomFicha ?>">
                          
                          <li><a title='Imprimir Columna de la Libreta' class="dropdown-item" href="javascript:void(0)" onclick="imprimirFila('<?php echo $nomLibr ?>')">Imprimir Columna de la Libreta</a></li>
                          <li><a title='Imprimir Columna Ficha' class="dropdown-item" href="javascript:void(0)" onclick="imprimirFilaF('<?php echo $nomFicha ?>')">Imprimir Columna Ficha [CON INFORME]</a></li>
                        </ul>
                      </div>
                  

                    <?php 
                     $nomLibr++;

                }else{

                        

                     ?>
                        </span>

                        <button onclick="imprimirFilaF('<?php echo $nomFicha ?>')" type="button" class="btn btn-danger p-2" title="Imprimir Informe"><i class="fas fa-cog fa-print"></i></button>
                  
             
                   

                    <?php 

                    

                } 



                $nomFicha++;


                ?>



                    </th>
                    <?php 

                   


                } ?>
                </tr>
            </thead>
            <tbody>
                <?php 

                $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

           
                $colorFinal='';

                $contadorColores=0;
               
                foreach($data as $dat) {

                $id_libretaF=$dat['id_libreta'];
                $nombre=$dat['nombre'];


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

                    <td><?php echo $id_libretaF; ?></td>
                    <td><?php echo $nombre; ?></td>
            
                
                        <?php 
                        $nota=0;
                        $contadoresF=0;
                        $contadoresDescrip=0;
                        $var='';


                        $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo`";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data_datos=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($data_datos as &$dat_datos) {

                                            $Nombrecolum=$dat_datos['nombre'];
                                            $descri_Columna=$dat_datos['descri'];


                                            $consulta = "SELECT `id_libreta`, `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                                            $resultado = $conexion->prepare($consulta);
                                            $resultado->execute();
                                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                             foreach($data as $dat) {
                                                $nota=$dat[''.$Nombrecolum.''];
                                            }


                                                $notaFIN = explode("||&||", $nota);
                                                $cantidadNotaFIL=count($notaFIN);
   
                                            if ($descri_Columna=='TEXTO') {

                                                        $var.='<td><input type="text" class="form-control bg-dark-x border-0 cls" id="'.$id_libretaF.'-'.$contadoresF.'"';

                                                        if ($nota=='undefined'){
                                                            $var.= 'value=""';
                                                        }else{
                                                            $var.= 'value="'.$nota.'"';
                                                          
                                                        } 

                                                        if ($_SESSION['operacion'] !='Lectura y Escritura') {
                                                             $var.= ' disabled';
                                                         }

                                                         $var.= '></td>';
                                                         $contadoresDescrip++;
                                           
                                                 }else if ($descri_Columna=='INFORME') {

                                                        $var.='<td>

                                                        


                                                        <textarea hidden=""   type="text" rows="10" cols="50" class="form-control bg-dark-x border-0 cls" id="'.$id_libretaF.'-'.$contadoresF.'"';

                                                        

                                                        if ($_SESSION['operacion'] !='Lectura y Escritura') {
                                                             $var.= ' disabled';
                                                         }

                                                         $mensaje='';

                                                         if ($nota==''){
                                                            $mensaje='';
                                                            $color='success';

                                                         }else{
                                                            $mensaje='<FONT COLOR="red">ESTA CARGADO</FONT>';

                                                            $color='danger';
                                                         } 



                                                         if ($nota=='undefined'){
                                                            $var.= '>';
                                                           
                                                        }else{
                                                            $var.= '>'.$nota;
                                                            
                                                          
                                                        } 



                                                        if (($edicion=='SI') && ($operacion=='Lectura y Escritura')) {

                                                               $var.= '</textarea>



                                                         <button id="boton'.$id_libretaF.'-mensaje-'.$contadoresF.'" onclick="pueba('.$id_libretaF.','.$contadoresF.')" type="button" class="btn btn-'.$color.'">
                                                             <i class="fas fa-edit"></i>
                                                            </button>


                                                            <button id="boton1'.$id_libretaF.'-mensaje-'.$contadoresF.'" onclick="visualizar('.$id_libretaF.','.$contadoresF.')" type="button" class="btn btn-info">
                                                             <i class="fas fa-clipboard"></i>
                                                            </button>


                                                             <input hidden="" id="datos'.$id_libretaF.$contadoresF.'"  value="'.$nombre.'||'.$Nombrecolum.'" type="text" class="form-control bg-dark-x border-0 cls"> 




                                                         <div id="'.$id_libretaF.'-mensaje-'.$contadoresF.'">'.$mensaje.'</div>


                                                         </td>';
                                                         $contadoresDescrip++;

                                                        }else{

                                                               $var.= '</textarea>



                                                          


                                                            <button id="boton1'.$id_libretaF.'-mensaje-'.$contadoresF.'" onclick="visualizar('.$id_libretaF.','.$contadoresF.')" type="button" class="btn btn-info">
                                                             <i class="fas fa-clipboard"></i>
                                                            </button>


                                                         <div id="'.$id_libretaF.'-mensaje-'.$contadoresF.'">'.$mensaje.'</div>


                                                         </td>';
                                                         $contadoresDescrip++;


                                                        }


                                                      



                                                 }else{


                                                           $var.='<td><input type="number"  min="3" max="10" class="form-control bg-dark-x border-0 cls" id="'.$id_libretaF.'-'.$contadoresF.'"';

                                                        if ($nota=='undefined'){
                                                            $var.= 'value=""';
                                                        }else{
                                                            $var.= 'value="'.$nota.'"';
                                                          
                                                        } 

                                                        if ($_SESSION['operacion'] !='Lectura y Escritura') {
                                                             $var.= ' disabled';
                                                         }

                                                          $var.= '></td>';
                                                          

                                                 }

                                                 $contadoresF++;

                        }

                        echo $var;

                        ?>
                   
         
                </tr>
                <?php
                    }
                ?>                                
            </tbody>        
           </table>                    
      
            </form>
















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









<div id="cargaImprimir"></div>





<div class="modal fade" id="modalCRUD_Pregunta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-xxl-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <input type="text" class="form-control" id="id" hidden=''>
                <input type="text" class="form-control" id="idCarga" hidden=''>
                <input type="text" class="form-control" id="idDatos" hidden=''>
                           

                <?php

                    $infor='';
                    
                     $contador = '0';
                     $pregutas = '0';
                     $titulos = '0';
                     $pregunta_2='';
                     $pregunta_3='';
                     $datos= '';

                    $consulta = "SELECT `confi_informe_titulo_$cicloLectivo`.`id_titulo`, `confi_informe_titulo_$cicloLectivo`.`tituloGenera`, `confi_informe_$cicloLectivo`.`id_informe`, `confi_informe_$cicloLectivo`.`tipo`, `confi_informe_$cicloLectivo`.`titulo`, `confi_informe_$cicloLectivo`.`pregunta`, `confi_informe_$cicloLectivo`.`aclaracion`, `confi_informe_$cicloLectivo`.`respuestas_posible`, `confi_informe_$cicloLectivo`.`modalidad`, `confi_informe_$cicloLectivo`.`id_titologeneral` FROM `confi_informe_titulo_$cicloLectivo` INNER JOIN `confi_informe_$cicloLectivo` ON `confi_informe_$cicloLectivo`.`id_titologeneral`= `confi_informe_titulo_$cicloLectivo`.`id_titulo`";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $d2ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
                 
                    foreach($d2ata as $d2at) {

                        $id_titulo=$d2at['id_titulo'];

                        
                        $tituloGenera=$d2at['tituloGenera'];
                        $titulo=$d2at['titulo'];
                        $pregunta=$d2at['pregunta'];
                        $aclaracion=$d2at['aclaracion'];
                        $respuestas_posible=$d2at['respuestas_posible'];

                        $id_informe=$d2at['id_informe'];

                        if ($pregunta_3=='') {
                             $datos.= $tituloGenera.'||'.$id_informe.'||'.$titulo.'||'.$pregunta.'||'.$aclaracion;

                             $pregunta_3='0';
                        }else{

                            $datos.= '&&'.$tituloGenera.'||'.$id_informe.'||'.$titulo.'||'.$pregunta.'||'.$aclaracion;

                        }

                        
  
                        $tipo=$d2at['tipo'];
                        
                        
                        $modalidad=$d2at['modalidad'];
                        $contador.=','.$id_informe; 
                        $pregutas.='||&||'.$pregunta;
                        $titulos.='||&||'.$tituloGenera;  
                        $pre=0;

                        $array = explode ( ',', $modalidad );
                        foreach ( $array as $palabra ) {
                            if (($palabra==$nombreCurso) || ($palabra=='TODOS')) {

                                $pre=1;
                            }
                        }
                        
                            if ($pre==1) {


                                if($pregunta_2!=$tituloGenera){

                                    $infor.='<center><B><h3><FONT COLOR="red">'.$tituloGenera.'</FONT></h3></B></center>';

                                    $pregunta_2=$tituloGenera;
                                }

                              
                                $infor.= '<h4>'.$titulo.'</h4>';

                                if ($tipo=='Pregunta Abierta') {
                                    

                                    $infor.= '<div class="form-group">
                <label for="pregnta'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                <textarea  type="text" rows="8" cols="10" class="form-control" id="pregnta'.$id_informe.'"></textarea></div><hr>';
                                }else if($tipo=='Multiple Choice (Una respuesta)'){

                                $anex='';
                                $respuestas = explode ( '||', $respuestas_posible );
                                foreach ( $respuestas as $resp ) {

                                    $anex.='<option>'.$resp.'</option>';
                                }

                                    $infor.= '<div class="form-group">
                                    <label for="pregnta'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                                    <select class="form-control" id="pregnta'.$id_informe.'">'.$anex.'
                                    </select>
                                    </div>';          

                            }else{

                                $anex='';
                                $respuestas = explode ( '||', $respuestas_posible );
                                foreach ( $respuestas as $resp ) {

                                    $anex.='<option>'.$resp.'</option>';
                                }

                                    $infor.= '<div class="form-group">
                                    <label for="pregnta'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                                     
                                     <select id="pregnta'.$id_informe.'" class="form-select" multiple aria-label="multiple select example" multiple data-live-search="true">
                                     '.$anex.'
                                    </select>
                                    </div>';  


                            }

                        

                        
                     }


                       

                 }

                 if ($infor=='') {
                     echo 'SIN INFORME';
                 }else{
                     echo $infor;
                 }
                 
                ?>








                <!--  final -->



                <!-- inicio   -->



                            <?php

                    $infor='';
                    
                     $contador = '0';
                     $pregutas = '0';
                     $titulos = '0';
                     $pregunta_2='';
                     $pregunta_3='';
                     $datos_2= '';

                    $consulta = "SELECT `confi_informe_titulo_2_$cicloLectivo`.`id_titulo`, `confi_informe_titulo_2_$cicloLectivo`.`tituloGenera`, `confi_informe_2_$cicloLectivo`.`id_informe`, `confi_informe_2_$cicloLectivo`.`tipo`, `confi_informe_2_$cicloLectivo`.`titulo`, `confi_informe_2_$cicloLectivo`.`pregunta`, `confi_informe_2_$cicloLectivo`.`aclaracion`, `confi_informe_2_$cicloLectivo`.`respuestas_posible`, `confi_informe_2_$cicloLectivo`.`modalidad`, `confi_informe_2_$cicloLectivo`.`id_titologeneral` FROM `confi_informe_titulo_2_$cicloLectivo` INNER JOIN `confi_informe_2_$cicloLectivo` ON `confi_informe_2_$cicloLectivo`.`id_titologeneral`= `confi_informe_titulo_2_$cicloLectivo`.`id_titulo`";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $d2ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
                 
                    foreach($d2ata as $d2at) {

                        $id_titulo=$d2at['id_titulo'];

                        
                        $tituloGenera=$d2at['tituloGenera'];
                        $titulo=$d2at['titulo'];
                        $pregunta=$d2at['pregunta'];
                        $aclaracion=$d2at['aclaracion'];
                        $respuestas_posible=$d2at['respuestas_posible'];

                        $id_informe=$d2at['id_informe'];

                        if ($pregunta_3=='') {
                             $datos_2.= $tituloGenera.'||'.$id_informe.'||'.$titulo.'||'.$pregunta.'||'.$aclaracion;

                             $pregunta_3='0';
                        }else{

                            $datos_2.= '&&'.$tituloGenera.'||'.$id_informe.'||'.$titulo.'||'.$pregunta.'||'.$aclaracion;

                        }

                        
  
                        $tipo=$d2at['tipo'];
                        
                        
                        $modalidad=$d2at['modalidad'];
                        $contador.=','.$id_informe; 
                        $pregutas.='||&||'.$pregunta;
                        $titulos.='||&||'.$tituloGenera;  
                        $pre=0;

                        $array = explode ( ',', $modalidad );
                        foreach ( $array as $palabra ) {
                            if (($palabra==$nombreCurso) || ($palabra=='TODOS')) {

                                $pre=1;
                            }
                        }
                        
                            if ($pre==1) {


                                if($pregunta_2!=$tituloGenera){

                                    $infor.='<br><hr><hr><center><B><h3><FONT COLOR="red">'.$tituloGenera.'</FONT></h3></B></center>';

                                    $pregunta_2=$tituloGenera;
                                }

                              
                                $infor.= '<h4>'.$titulo.'</h4>';

                                if ($tipo=='Pregunta Abierta') {
                                    

                                    $infor.= '<div class="form-group">
                <label for="pregnta_2'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                <textarea  type="text" rows="8" cols="10" class="form-control" id="pregnta_2'.$id_informe.'"></textarea></div><hr>';
                                }else if($tipo=='Multiple Choice (Una respuesta)'){

                                $anex='';
                                $respuestas = explode ( '||', $respuestas_posible );
                                foreach ( $respuestas as $resp ) {

                                    $anex.='<option>'.$resp.'</option>';
                                }

                                    $infor.= '<div class="form-group">
                                    <label for="pregnta_2'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                                    <select class="form-control" id="pregnta_2'.$id_informe.'">'.$anex.'
                                    </select>
                                    </div>';          

                            }else{

                                $anex='';
                                $respuestas = explode ( '||', $respuestas_posible );
                                foreach ( $respuestas as $resp ) {

                                    $anex.='<option>'.$resp.'</option>';
                                }

                                    $infor.= '<div class="form-group">
                                    <label for="pregnta_2'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                                     
                                     <select id="pregnta_2'.$id_informe.'" class="form-select" multiple aria-label="multiple select example" multiple data-live-search="true">
                                     '.$anex.'
                                    </select>
                                    </div>';  


                            }

                        

                        
                     }


                       

                 }

                 if ($infor=='') {
                     echo 'SIN INFORME';
                 }else{
                     echo $infor;
                 }
                 
                ?>


            </div>


            <input type="text" class="form-control"  value="<?php echo $datos_2; ?>" id="datos_2" hidden=''>

            <input type="text" class="form-control"  value="<?php echo $datos; ?>" id="datos" hidden=''>
               
            <div class="modal-footer">
                <button class="btn btn-dark" onclick="agregar_editar ()"> <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>





<div class="modal fade" id="modalCRUD_informe" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-xxl-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

             <div id="informeFinal"></div>


            </div>

            
                      
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
     
    </div>
  </div>
</div>











<script type="text/javascript">



var tablaLibreta = $('#tablaNotasFin').DataTable({ 

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

$("#RegresarLibreta").click(function(e){

$('#imagenProceso').show();

$('#libreTaOcul').show();

$('#libretaFina').html('');
    



$('#imagenProceso').hide(); 

}); 


// reasigno Variables
var arrayIdeLibreta =[];
var arrayNotasCompletas =[];
var nombresColumnas=[];
var notas ='';
var nombresC='';
var contrador=0;
var contComas=0;

// cuando escribo en los campos
$( ".cls" ).keyup(function() {

// reasigno Variables
var arrayIdeLibreta =[];
var arrayNotasCompletas =[];
var nombresColumnas=[];
var notas ='';
var nombresC='';
var contrador=0;

// recorro la tabla por filas
tablaLibreta.rows().data().each(function (value) {

// obtengo el valor de cada fila
var libreta= value[0];

//  copiar los nombres de los encabesados en un array
if (contrador!=1) {

    for (var i = 0; i < value.length - 2; i++) {
        nombresC = $('#nombre-'+i).html();
        nombresColumnas.push(nombresC);
        contrador=1; 
    }

}
//  copiar el id de cada asignatura
arrayIdeLibreta.push(libreta);

for (var i = 0; i < value.length - 2; i++) {

    //  copio cada nota o texto en un array
    ideElemento=libreta+'-'+(i);
    notas = $('#'+ideElemento).val();
    arrayNotasCompletas.push(notas);

}

});


 contComas= nombresColumnas.length;
// muestro por consola
console.log(nombresColumnas);
console.log(arrayIdeLibreta);
console.log(arrayNotasCompletas);
console.log(contComas);

});



function ingresarNotaBaseDato() {

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


// reasigno Variables
var arrayIdeLibreta =[];
var arrayNotasCompletas =[];
var nombresColumnas=[];
var notas ='';
var nombresC='';
var contrador=0;

// recorro la tabla por filas
tablaLibreta.rows().data().each(function (value) {

// obtengo el valor de cada fila
var libreta= value[0];

//  copiar los nombres de los encabesados en un array
if (contrador!=1) {
  


    for (var i = 0; i < value.length - 2; i++) {
        nombresC = $('#nombre-'+i).html();
        nombresColumnas.push(nombresC);
        contrador=1; 
    }

}
//  copiar el id de cada asignatura
arrayIdeLibreta.push(libreta);

for (var i = 0; i < value.length - 2; i++) {

    //  copio cada nota o texto en un array
    ideElemento=libreta+'-'+(i);
    notas = $('#'+ideElemento).val();
    arrayNotasCompletas.push(notas);

}

});


 contComas= nombresColumnas.length;
// muestro por consola
console.log(nombresColumnas);
console.log(arrayIdeLibreta);
console.log(arrayNotasCompletas);
console.log(contComas);

$.ajax({
type:"post",
data:{nombresColumnas:nombresColumnas, arrayIdeLibreta:arrayIdeLibreta, arrayNotasCompletas:arrayNotasCompletas, contComas:contComas},
url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/crud_Notas_LibretaDigital.php',
success:function(r){

console.log(r);
}
});



$.unblockUI();


}    







function imprimirFilaF(numeroFila) {

$.ajax({
type:"post",
data:'numeroFila='+numeroFila,
url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/imprimirColumnaNotaLibreta.php',
success:function(r){

 window.open('modulos/gestionAcademicaAlumno/libretaFicha/LibretaDigitalExtraColumnaFinalFicha.php', '_blank'); 

}
});







}


function imprimirFila(numeroFila) {


$.ajax({
type:"post",
data:'numeroFila='+numeroFila,
url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/imprimirColumnaNotaLibreta.php',
success:function(r){

 window.open('modulos/gestionAcademicaAlumno/libretaFicha/LibretaDigitalExtraColumnaFinal.php', '_blank'); 

}
});







}



function consultarGuardar(){

    Swal.fire({
  title: 'Esta seguro de guardar este informe!!',
  text: "No se podra editar sobre el mismo informe!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, guardar'
}).then((result) => {
  if (result.isConfirmed) {
   
    agregar_editar();
  }
})


}






function agregar_editar(){

    $("#modalCRUD_Pregunta").modal("hide"); 

    idTex=$('#id').val();
    idCarga=$('#idCarga').val();
    datos=$('#datos').val();

    datos_2=$('#datos_2').val();




    nombreCurso=$('#datosF').html();
    nombreAlumnos=$('#nombreAlumnosF').html();
    dniAlumnos=$('#dniF').html();

    datosFinal=$('#idDatos').val();
    console.log(datosFinal);
    datosF = datosFinal.split('||');

    asignatura=datosF[0];
    encabezado=datosF[1];


 TablaFinal='';


titoLongitud = [];

tituloGe='';
dat='';
conta=0;
table='';
tito=[];
pre='0';
pre_2=0;
cont=0;

preguntassss='';

// separo por titulo Genera
datosSeparadoTitulo = datos.split('&&');
res='';
for (var i = 0; i < datosSeparadoTitulo.length; i++) {

    datosSeparado=datosSeparadoTitulo[i];


    datosPorElementos = datosSeparado.split('||');

    tituloGeneral=datosPorElementos[0];
    id_informe=datosPorElementos[1];
    titulo=datosPorElementos[2];
    pregunta=datosPorElementos[3];
    aclaracion=datosPorElementos[4];
    respuesta=$('#pregnta'+id_informe).val();

    
    titoLongitud = tito.push(tituloGeneral); 
  
        res+=titulo+'||'+pregunta+'||'+aclaracion+'||'+respuesta+'|&|';
   





}

nuevo='';
titulm_2='';
contador=0;
contar=0;
for (var i = 0; i < tito.length; i++) {
    
    titulm=tito[i];



 if (contador == 0) {
    titulm_2=titulm;
    contador=1;
    nuevo+=titulm+'||';
 }
  

if (titulm_2==titulm) {
    contar=contar+1;
 }else{

        nuevo+=contar+'||'+titulm+'||';
        contar=0;
        titulm_2=titulm;

 }


if (i+1 == tito.length) {
     nuevo+=contar+1;
}

}

  console.log(nuevo)









            table+=`<table style="width:100%">`;


columnas = '0';
suma=0;
nuevoFi = nuevo.split('||');

table+=` <thead>`;

         for (var i = 0; i < nuevoFi.length; i++) {

            numero=parseInt(nuevoFi[i+1], 10);
            suma=suma+numero;
    
            
            i++;

            
        }

        table+=`<tr><th colspan="`+suma+`">

        <center><B><h3><FONT COLOR="red">INFORME EQUIPO DE ENSEÑANZA Y EVALUACIÓN<br>SECUNDARIA TÉCNICA</FONT></h3></B></center><br>


        </th></tr>

        </thead>
            <tbody class="letras">

            <tr>
                <td colspan="`+suma+`">
                <span style="font-size: 15px;"><b>Apellido/s y Nombre/s: </b>`+nombreAlumnos+`</span><br>
                                    <b>DNI: </b>`+dniAlumnos+`</span><br>
                                <span style="font-size: 15px;"><b>(CICLO BÁSICO/CICLO SUPERIOR/ESPECIALIDAD: </b>`+nombreCurso+`</span><br>

                                <span style="font-size: 15px;"><b>Asignatura: </b>`+asignatura+`</span><br>

                                <span style="font-size: 15px;"><b>Tipo: </b>`+encabezado+`</span><br>

                                <span style="font-size: 15px;"><b>Niveles de desempeño:</b></span><br>

                                <span style="font-size: 15px;"><b>ALTAMENTE LOGRADO los objetivos de aprendizaje esperados fueron superados.</b></span><br>

                                <span style="font-size: 15px;"><b>LOGRADO los objetivos de aprendizaje esperados fueron logrados.</b></span><br>

                                <span style="font-size: 15px;"><b>EN PROCESO los objetivos previstos no fueron alcanzados.</b></span><br>


                </td>
            </tr>
            <tr>

        `;


        for (var i = 0; i < nuevoFi.length; i++) {

            numero=parseInt(nuevoFi[i+1], 10);
        
            columnas+='||'+numero;
            table+=`<td colspan="`+numero+`"><center>`+nuevoFi[i]+`</center></td>`;
            i++;

            
        }


table+=`</tr>`;

resFi = res.split('|&|');

catp='';


 for (var i = 0; i < resFi.length; i++) {


     
            resg=resFi[i];
           
            resl = resg.split('||');

            contador=2;
            numero=0;
            

            for (var X = 0; X < resl.length; X++) {

                

                if (resl[X]!='') {

                           
                            catp+=`<td><h5><b><center>`+resl[X]+`</center></b><h5><br><br><b>`+resl[X+1]+`</b><br>`+resl[X+2]+`<br><br>RESPUESTA: <b>`+resl[X+3]+`</b></td>||`;


                        }

                        X=X+3;


                }
            
            }



colum = columnas.split('||');
columFFF = catp.split('||');
contadorFinalTO=0;

table+=`<tr>`;

for (var i = 0; i < colum.length; i++) {

    columF=parseInt(colum[i], 10);


    for (var K = 0; K < columF; K++) {

     
     
        table+=columFFF[contadorFinalTO];

        contadorFinalTO++;
       

    }
        
  

}

table+=`</tr>`;
     
    table+=`</tbody>        

</table><br>
<p>Estudiante incluida/o en Plan de Acompañamiento: SI/NO</p>
<p>En caso de respuesta afirmativa, indicar espacios que participan en el plan:</p> <br>`;






TablaFinal+=table;





//  segunda hoja




 


titoLongitud = [];

tituloGe='';
dat='';
conta=0;
table='';
tito=[];
pre='0';
pre_2=0;
cont=0;

preguntassss='';



// separo por titulo Genera
datosSeparadoTitulo = datos_2.split('&&');
res='';
for (var i = 0; i < datosSeparadoTitulo.length; i++) {

    datosSeparado=datosSeparadoTitulo[i];


    datosPorElementos = datosSeparado.split('||');

    tituloGeneral=datosPorElementos[0];
    id_informe=datosPorElementos[1];
    titulo=datosPorElementos[2];
    pregunta=datosPorElementos[3];
    aclaracion=datosPorElementos[4];
    respuesta=$('#pregnta_2'+id_informe).val();

    
    titoLongitud = tito.push(tituloGeneral); 
  
        res+=titulo+'||'+pregunta+'||'+aclaracion+'||'+respuesta+'|&|';
   





}

nuevo='';
titulm_2='';
contador=0;
contar=0;
for (var i = 0; i < tito.length; i++) {
    
    titulm=tito[i];



 if (contador == 0) {
    titulm_2=titulm;
    contador=1;
    nuevo+=titulm+'||';
 }
  

if (titulm_2==titulm) {
    contar=contar+1;
 }else{

        nuevo+=contar+'||'+titulm+'||';
        contar=0;
        titulm_2=titulm;

 }


if (i+1 == tito.length) {
     nuevo+=contar+1;
}

}

  console.log(nuevo)









            table+=`<table style="width:100%">`;


columnas = '0';
suma=0;
nuevoFi = nuevo.split('||');

table+=` <thead>`;

         for (var i = 0; i < nuevoFi.length; i++) {

            numero=parseInt(nuevoFi[i+1], 10);
            suma=suma+numero;
    
            
            i++;

            
        }

        table+=`<tr><th colspan="`+suma+`">

        <center><B><h3><FONT COLOR="red">SEGUNDA PARTE</FONT></h3></B></center><br>


        </th></tr>

        </thead>
            <tbody class="letras">

            <tr>
                <td colspan="`+suma+`">
                <span style="font-size: 15px;"><b>Apellido/s y Nombre/s: </b>`+nombreAlumnos+`</span><br>
                                    <b>DNI: </b>`+dniAlumnos+`</span><br>
                                <span style="font-size: 15px;"><b>(CICLO BÁSICO/CICLO SUPERIOR/ESPECIALIDAD: </b>`+nombreCurso+`</span><br>


                </td>
            </tr>
            <tr>

        `;


        for (var i = 0; i < nuevoFi.length; i++) {

            numero=parseInt(nuevoFi[i+1], 10);
        
            columnas+='||'+numero;
            table+=`<td colspan="`+numero+`"><center>`+nuevoFi[i]+`</center></td>`;
            i++;

            
        }


table+=`</tr>`;

resFi = res.split('|&|');

catp='';


 for (var i = 0; i < resFi.length; i++) {


     
            resg=resFi[i];
           
            resl = resg.split('||');

            contador=2;
            numero=0;
            

            for (var X = 0; X < resl.length; X++) {

                

                if (resl[X]!='') {

                           
                            catp+=`<td><h5><b><center>`+resl[X]+`</center></b><h5><br><br><b>`+resl[X+1]+`</b><br>`+resl[X+2]+`<br><br>RESPUESTA: <b>`+resl[X+3]+`</b></td>||`;


                        }

                        X=X+3;


                }
            
            }



colum = columnas.split('||');
columFFF = catp.split('||');
contadorFinalTO=0;

table+=`<tr>`;

for (var i = 0; i < colum.length; i++) {

    columF=parseInt(colum[i], 10);


    for (var K = 0; K < columF; K++) {

     
     
        table+=columFFF[contadorFinalTO];

        contadorFinalTO++;
       

    }
        
  

}

table+=`</tr>`;
     
    table+=`</tbody>        

</table><br>
<p>Estudiante incluida/o en Plan de Acompañamiento: SI/NO</p>
<p>En caso de respuesta afirmativa, indicar espacios que participan en el plan:</p>`;



if (TablaFinal!='') {
    TablaFinal+='|&|&|&|&|&|&|&||&|&|&|';
}


if (datos_2!='') {
    TablaFinal+=table;

}



TablaFinal+='|&|&|&|&|&|&|&||&|&|&|';


$('#'+idTex).val(TablaFinal);
ingresarNotaBaseDato();

$('#'+idCarga).html('<FONT COLOR="red">ESTA CARGADO</FONT>');

var btn = $('#boton'+idCarga);
  
btn.removeClass('btn-success');
btn.addClass('btn-danger');



}



function visualizar(id_libretaF,contadoresF) {



datos=$('#'+id_libretaF+'-'+contadoresF).val();


if (datos=='') {
 
 datos='<b>SIN CARGA</b>';
}

$('#informeFinal').html(datos);

  $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("INFORME"); 
    $("#modalCRUD_informe").modal("show"); 


}

function pueba(id_libretaF,contadoresF) {



  $('#id').val(id_libretaF+'-'+contadoresF);
  $('#idCarga').val(id_libretaF+'-mensaje-'+contadoresF);

 
  dt=$('#datos'+id_libretaF+contadoresF).val();

  console.log(dt);

  $('#idDatos').val(dt);




    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("CARGAR O MODIFICAR INFORME DEL ALUMNO"); 
    $("#modalCRUD_Pregunta").modal("show"); 


}


function modalCRUD_Libreta_DocentefiFinal() {


window.open('modulos/gestionAcademicaAlumno/libretaFicha/LibretaDigitalExtra.php', '_blank'); 


}



function modalCRUD_Libreta_DocentefiFinalFichaAlumnoCON() {


window.open('modulos/gestionAcademicaAlumno/libretaFicha/LibretaDigitalExtraFichaAlumno.php', '_blank'); 



}


function modalCRUD_Libreta_DocentefiFinalFichaAlumnoSIN() {


window.open('modulos/gestionAcademicaAlumno/libretaFicha/LibretaDigitalExtraColumnaFinal_SIN.php', '_blank'); 



}

function modalCRUD_Libreta_DocentefiFinalFichaAlumnoINFORME() {


window.open('modulos/gestionAcademicaAlumno/libretaFicha/LibretaDigitalExtraColumnaFinal_COM.php', '_blank'); 



}



function ingresarAnalitico(){





// reasigno Variables
var arrayIdeLibreta =[];
var arrayNotasCompletas =[];
var nombresColumnas=[];
var notas ='';
var nombresC='';
var contrador=0;
var pregunta='';

// recorro la tabla por filas
tablaLibreta.rows().data().each(function (value) {

// obtengo el valor de cada fila
var libreta= value[0];

//  copiar los nombres de los encabesados en un array
if (contrador!=1) {
  


    for (var i = 0; i < value.length - 2; i++) {
        nombresC = $('#nombre-'+i).html();
        nombresColumnas.push(nombresC);
        pregunta+='<option>'+nombresC+'</option>'
        contrador=1; 
    }

}
//  copiar el id de cada asignatura
arrayIdeLibreta.push(libreta);


for (var i = 0; i < value.length - 2; i++) {

    //  copio cada nota o texto en un array
    ideElemento=libreta+'-'+(i);
    notas = $('#'+ideElemento).val();
    arrayNotasCompletas.push(notas);

}

});


 ret=`<select class="form-control" id="campofinal">
   
    `+pregunta+`
    </select></div>`;


Swal.fire({
  title: 'Cual es el Campo Definitivo',
  html:ret, 
  focusConfirm: false,
  showCancelButton: true,                         
  }).then((result) => {
    if (result.value) {                                             
      campofinal = document.getElementById('campofinal').value;
  


      ingresarAnaliticoFinal(campofinal,nombresColumnas,arrayIdeLibreta,arrayNotasCompletas);
                      
    }
});

}


function ingresarAnaliticoFinal(campofinal,nombresColumnas,arrayIdeLibreta,arrayNotasCompletas){


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

// muestro por consola
console.log(nombresColumnas);
console.log(arrayIdeLibreta);
console.log(arrayNotasCompletas);

$.ajax({
type:"post",
data:{nombresColumnas:nombresColumnas, arrayIdeLibreta:arrayIdeLibreta, arrayNotasCompletas:arrayNotasCompletas, campofinal:campofinal},
url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/crud_Notas_LibretaDigitalFinalAna.php',
success:function(r){

console.log(r);
}
});



$.unblockUI();


}   


function remover66 () {


    $('#cursoSe').val(0);
  $('#contenidoAyuda').html('');




}



$.unblockUI();
</script>



