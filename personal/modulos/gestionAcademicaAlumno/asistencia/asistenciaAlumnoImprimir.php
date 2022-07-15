
<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();



if (isset($_SESSION['id_Alumno_Asistencia'])){
$id_Alumno_Asistencia=$_SESSION['id_Alumno_Asistencia'];

                  $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

 
$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos` WHERE `idAlumnos`='$id_Alumno_Asistencia'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                foreach($data as $dat) {
                                    $nombreAlumnos=$dat['nombreAlumnos'];
                                    $dniAlumnos=$dat['dniAlumnos'];
                                      }



        $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado` FROM `asistenciaalumno_$cicloLectivo` WHERE `idAlumno`='$id_Alumno_Asistencia'";       
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
    size: legal;
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

 





                    <h2>INASISTENCIA DE LOS ALUMNOS- CICLO <?php echo $cicloLectivo; ?></h2><br>
                    <h5>APELLIDO Y NOMBRE: <?php echo $nombreAlumnos; ?>; DNI:<?php echo $dniAlumnos; ?></h5>

                             <table id="customers" style='font-size: 12px;text-align: center; width:100%'>
                        <thead>
                            <tr>
                         
                                <th>FECHA</th>
                                <th>CANTIDAD</th> 
                                <th>JUSTIFICO</th>
                                <th>OBSERV.</th>
                                <th>ENCABEZADO</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            
                             foreach($data as $dat) {

                            $id_Asistencia=$dat['id_Asistencia'];
                            $idAlumno=$dat['idAlumno'];
                            $fecha=$dat['fecha'];
                            $cantidad=$dat['cantidad'];
                            $justificado=$dat['justificado'];
                            $observacion=$dat['observacion'];
                            $encabezado=$dat['encabezado'];
                                                                                
                            ?>
                            <tr>
                              
                                <td><?php echo $fecha ?></td>
                                <td><?php echo $cantidad ?></td>
                                <td><?php echo $justificado ?></td>
                                <td><?php echo $observacion ?></td>
                                <td><?php echo $encabezado ?></td>  
                    
                             
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

<div style="float:left;width: 50%;"><span>Notificación</span></div>
























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


<?php
                                }
                            ?>









