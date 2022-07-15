<?php

                             include_once '../bd/conexion.php';
                              $objeto = new Conexion();
                              $conexion = $objeto->Conectar();
                                         session_start();

            
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivoFINAL= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


    
$dni = $_SESSION['dni'];
$name = $_SESSION['name'];
$domicilio = $_SESSION['domicilio'];
$email = $_SESSION['email'];
$telefono = $_SESSION['telefono'];
$titulo1 = $_SESSION['titulo1'];
$hijos = $_SESSION['hijos'];
$situacion = $_SESSION['situacion'];


$nombreMateria = $_SESSION['nombreMateria'];
$situacionRevista = $_SESSION['situacionRevista'];
$desdeHasta = $_SESSION['desdeHasta'];



     $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos` FROM `datos_docentes`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E.E.T. N° 16</title>
<style type="text/css" >
 
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;

  font-size:140%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: center;
  background-color: #4CAF50;
  color: white;
}


.boton_personalizado{
    text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 20px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }




.fechaTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}

.fechaTable td, .fechaTable th {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
}



.fechaTable th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  background-color: #134CA9;
  color: white;
  text-align: center;
}

h1 {
  text-align: left;
}


p {
  text-align: justify;
}



.tablaFinal {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  text-align: center;
}

.tablaFinal td, .tablaFinal th {
  border: 1px solid #ddd;
  padding: 5px;
  text-align: center;

}



.tablaFinal th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  text-align: center;
}




</style>
 
</head>
<body>

<div id="ocultarBotonImpri" class="container ">
  <div class="row ">
    <div class="col-lg-12 p-4 ">
      <button class="boton_personalizado  print">Imprimir</button>
    </div>
  </div>
</div>


<div class="imprimir" id="imprimir">
        <!-- Compiled and minified CSS -->

                <style type="text/css" media="print">
   @media print {
 
    #sidebar {
        display:none;
    } 
    main {
        float:none;
    } 
}


@page{    
    size: legal landscape;
    margin: 1cm;  /* this affects the margin in the printer settings */


}

header, footer, nav, aside {
  display: none;
}

#ocultarBotonImpri {
  display: none;
}


#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:140%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: center;
  background-color: #4CAF50;
  color: white;

}





.fechaTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}

.fechaTable td, .fechaTable th {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;

}



.fechaTable th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  
  text-align: center;
}


.tablaFinal {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  text-align: center;
}

.tablaFinal td, .tablaFinal th {
  border: 1px solid #ddd;
  padding: 5px;
  text-align: center;

}



.tablaFinal th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  

  text-align: center;
}




h1 {
  text-align: left;
}


p {
  text-align: justify;
}

</style>

 




                       <br>
<h2>LISTA DE DOCENTE DE LA INSTITUCIÓN // CICLO LECTIVO: <?php echo $cicloLectivoFINAL; ?></h2>  
<br>

                        <table id="customers" style='font-size: 12px;text-align: center; width:100%'>
                       
                        <thead class="text-center">
                            <tr>

                              <?php

              
                              if ($dni!='NO') {

                              ?>

                              <th>DNI</th>

                              <?php  } 

                           
                              if ($name!='NO') {

                              ?>

                              <th>APELLIDO Y NOMBRE</th>

                              <?php  } 

                           
                              if ($domicilio!='NO') {

                              ?>

                              <th>DOMICILIO</th>

                              <?php   } 

                           
                              if ($email!='NO') {

                              ?>

                              <th>EMAIL</th>

                              <?php  } 

                           
                              if ($telefono!='NO') {

                              ?>

                              <th>TELEFONO</th>

                              <?php  } 

                           
                              if ($titulo1!='NO') {

                              ?>

                              <th>TITULO</th>

                              <?php  } 

                           
                              if ($hijos!='NO') {

                              ?>

                              <th>HIJOS EN ESCOLARIDAD</th>

                              <?php  } 

                           
                              if ($situacion!='NO') {

                              ?>

                              <th>SITUACIÓN</th>

                              <?php  } ?>
                             
                        
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $colorFinal='';

                            $contadorColores=0;                           
                            foreach($data as $dat) {                   

                                $idDocente=$dat['idDocente'];                    
                            

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


                                <?php

              
                              if ($dni!='NO') {

                              ?>

                                <td><?php echo $dat['dni'] ?></td>

                              <?php  } 

                           
                              if ($name!='NO') {

                              ?>

                                <td><?php echo $dat['nombre'] ?></td>

                              <?php  } 

                           
                              if ($domicilio!='NO') {

                              ?>

                              <td><?php echo $dat['domicilio'] ?></td>

                              <?php   } 

                           
                              if ($email!='NO') {

                              ?>

                              <td><?php echo $dat['email'] ?></td>

                              <?php  } 

                           
                              if ($telefono!='NO') {

                              ?>

                              <td><?php echo $dat['telefono'] ?></td>

                              <?php  } 

                           
                              if ($titulo1!='NO') {

                              ?>

                              <td><?php echo $dat['titulo'] ?></td>

                              <?php  } 

                           
                              if ($hijos!='NO') {

                              ?>

                              <td><?php echo $dat['hijos'] ?></td>

                              <?php  } 

                           
                              if ($situacion!='NO') {

                              ?>

                              <td><?php 

                                 $imprimir='';

                                     $consulta = "SELECT `id_asig_cargo`, `idDocente`, `cargo`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes` FROM `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL` WHERE `idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $da1ta=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($da1ta as $d1at) {   


                                  if (($nombreMateria=='SI')&&($situacionRevista=='SI')&&($desdeHasta=='SI')) {
                                     
                                      $imprimir.= '*) '.$d1at['cargo'].'; Situación: '.$d1at['situacion'].'; Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='SI')&&($desdeHasta=='SI')) {
                                     
                                      $imprimir.= '*) Situación: '.$d1at['situacion'].'; Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='NO')&&($desdeHasta=='SI')) {
                                     
                                      $imprimir.= 'Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='NO')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= 'NO SELECCIONO NUNGUNA OB.'.'<hr>';

                                  }else if (($nombreMateria=='SI')&&($situacionRevista=='NO')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= '*) '.$d1at['cargo'].'<hr>';

                                  }else if (($nombreMateria=='SI')&&($situacionRevista=='SI')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= '*) '.$d1at['cargo'].'; Situación: '.$d1at['situacion'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='SI')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= '*) Situación: '.$d1at['situacion'].'<hr>';

                                  }




                                   
                             }   



                                  $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivoFINAL`.`nombre` AS 'nombreCurso', `asignacion_asignatura_docente_$cicloLectivoFINAL`.`situacion`,`asignacion_asignatura_docente_$cicloLectivoFINAL`.`desde`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`hasta`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`obserbaci` FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivoFINAL` ON `curso_$cicloLectivoFINAL`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idCurso` WHERE `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data3=$resultado->fetchAll(PDO::FETCH_ASSOC);                   
                            foreach($data3 as $d1at) {

                                 





                                  if (($nombreMateria=='SI')&&($situacionRevista=='SI')&&($desdeHasta=='SI')) {
                                     
                                       $imprimir.= '*) '.$d1at['nombre'].'; Situación: '.$d1at['situacion'].'; Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'; Curso: '.$d1at['nombreCurso'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='SI')&&($desdeHasta=='SI')) {
                                     
                                       $imprimir.= '*) Situación: '.$d1at['situacion'].'; Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='NO')&&($desdeHasta=='SI')) {
                                     
                                      $imprimir.= '*) Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='NO')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= 'NO SELECCIONO NUNGUNA OB.'.'<hr>';

                                  }else if (($nombreMateria=='SI')&&($situacionRevista=='NO')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= '*) '.$d1at['nombre'].'; Curso: '.$d1at['nombreCurso'].'<hr>';

                                  }else if (($nombreMateria=='SI')&&($situacionRevista=='SI')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= '*) '.$d1at['nombre'].'; Situación: '.$d1at['situacion'].'; Curso: '.$d1at['nombreCurso'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='SI')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= '*) Situación: '.$d1at['situacion'].'<hr>';

                                  }















                            }




                                $consulta = "SELECT `id_asig_proyecto`, `idDocente`, `cHoras`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `licencia` FROM `asignacion_asignatura_docente_proyecto_$cicloLectivoFINAL` WHERE `idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $da1ta=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($da1ta as $d1at) {




                                  if (($nombreMateria=='SI')&&($situacionRevista=='SI')&&($desdeHasta=='SI')) {
                                     
                                      $imprimir.= '*) '.$d1at['cHoras'].' Hs Proyecto; Situación: '.$d1at['situacion'].'; Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='SI')&&($desdeHasta=='SI')) {
                                     
                                       $imprimir.= '*) Situación: '.$d1at['situacion'].'; Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='NO')&&($desdeHasta=='SI')) {
                                     
                                         $imprimir.= '*) Desde: '.$d1at['desde'].'; hasta: '.$d1at['hasta'].'<hr>';


                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='NO')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= 'NO SELECCIONO NUNGUNA OB.'.'<hr>';

                                  }else if (($nombreMateria=='SI')&&($situacionRevista=='NO')&&($desdeHasta=='NO')) {
                                     
                                      $imprimir.= '*) '.$d1at['cHoras'].' Hs Proyecto'.'<hr>';

                                  }else if (($nombreMateria=='SI')&&($situacionRevista=='SI')&&($desdeHasta=='NO')) {
                                     
                                       $imprimir.= '*) '.$d1at['cHoras'].' Hs Proyecto; Situación: '.$d1at['situacion'].'<hr>';

                                  }else if (($nombreMateria=='NO')&&($situacionRevista=='SI')&&($desdeHasta=='NO')) {
                                     
                                       $imprimir.= '*) Situación: '.$d1at['situacion'].'<hr>';

                                  }



                            } 

                            echo $imprimir;                                      

                                  ?></td>

                              <?php  } ?>
           
                                 
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                      
      

<br>

<hr>
<br><br>

<div style="float:left;width: 50%;"><span>___________________________________</span></div>

<div style="float:left;width: 50%;"><span>____________________________</span></div>

<div style="float:left;width: 50%;"><span>Firma y Sello de la institución</span></div>

<div style="float:left;width: 50%;"><span>Observación</span></div>
























<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>




 <script type="text/javascript">
$(document).ready(function(){

  $(".print").click(function(e){
    e.preventDefault();
     window.print();
  });





});



</script>



</body>
</html>

