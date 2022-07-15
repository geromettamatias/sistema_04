<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$id_PreIncrip = (isset($_POST['id_PreIncrip'])) ? $_POST['id_PreIncrip'] : '';
$dni_alumno = (isset($_POST['dni_alumno'])) ? $_POST['dni_alumno'] : '';
$nombre_alumno = (isset($_POST['nombre_alumno'])) ? $_POST['nombre_alumno'] : '';
$fecha_nacimiento = (isset($_POST['fecha_nacimiento'])) ? $_POST['fecha_nacimiento'] : '';
$dni_tutor = (isset($_POST['dni_tutor'])) ? $_POST['dni_tutor'] : '';
$nombre_tutor = (isset($_POST['nombre_tutor'])) ? $_POST['nombre_tutor'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';

$dniTutor = (isset($_POST['dniTutor'])) ? $_POST['dniTutor'] : '';

$domicilio = (isset($_POST['domicilio'])) ? $_POST['domicilio'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$localidad = (isset($_POST['localidad'])) ? $_POST['localidad'] : '';

$planEstudio = (isset($_POST['planEstudio'])) ? $_POST['planEstudio'] : '';


switch($opcion){
    case 2:

        $consulta = "UPDATE `inscripcion` SET `dni_alumno`='$dni_alumno',`nombre_alumno`='$nombre_alumno',`fecha_nacimiento`='$fecha_nacimiento',`dni_tutor`='$dni_tutor',`nombre_tutor`='$nombre_tutor',`correo`='$correo',`telefono`='$telefono',`domicilio`='$domicilio',`localidad`='$localidad' WHERE `id_PreIncrip`='$id_PreIncrip'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        
        $consulta = "SELECT `id_PreIncrip`, `dni_alumno`, `nombre_alumno`, `fecha_nacimiento`, `dni_tutor`, `nombre_tutor`, `correo`, `telefono`, `domicilio`, `localidad` FROM `inscripcion` WHERE `id_PreIncrip`='$id_PreIncrip'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        break;        
    case 3://baja
        $consulta = "DELETE FROM `inscripcion` WHERE `id_PreIncrip`='$id_PreIncrip'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 'Listo';
                                
        break;
    case 5://pasar BD



          $consulta = "SELECT `id_PreIncrip`, `dni_alumno`, `nombre_alumno`, `fecha_nacimiento`, `dni_tutor`, `nombre_tutor`, `correo`, `telefono`, `domicilio`, `localidad` FROM `inscripcion` WHERE `id_PreIncrip`='$id_PreIncrip'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $dat) { 
                $id_PreIncrip=$dat['id_PreIncrip'];
                $dni_alumno=$dat['dni_alumno'];
                $nombre_alumno=$dat['nombre_alumno'];
                $fecha_nacimiento=$dat['fecha_nacimiento'];
                $dni_tutor=$dat['dni_tutor'];
                $nombre_tutor=$dat['nombre_tutor'];
                $correo=$dat['correo'];
                $telefono=$dat['telefono'];
                $domicilio=$dat['domicilio'];
                $localidad=$dat['localidad'];

            }
       

                    $consultaMatricular = "INSERT INTO `datosalumnos`(`idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`) VALUES (null,'$nombre_alumno','$dni_alumno','$dni_alumno','$domicilio','$correo','$telefono','','$nombre_tutor','$dni_tutor','','$planEstudio','$fecha_nacimiento','','','','')";            
                    $resultadoMatricular = $conexion->prepare($consultaMatricular);
                    $resultadoMatricular->execute();


                    $consulta = "DELETE FROM `inscripcion` WHERE `id_PreIncrip`='$id_PreIncrip'";       
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();



                    echo 'Listo';


                                
        break;        
}


$conexion = NULL;