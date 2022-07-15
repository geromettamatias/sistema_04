<?php
session_start();

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$password = (isset($_POST['pass'])) ? $_POST['pass'] : '';
$pass= base64_encode($password);


$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass` FROM `datosalumnos` WHERE `dniAlumnos`='$dni' AND `pass`='$pass'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuarioEstudiante"] = $dni;
    $_SESSION["cargo"] = 'Estudiante';




    foreach($data as $dat1) {                                                        
    
        $_SESSION["cuilAlumnos"] = $dat1['cuilAlumnos'];



        date_default_timezone_set("America/Argentina/Buenos_Aires");

            $idUsu=$dat1['idAlumnos'];


        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         
        $fecha= $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;


         $hoy = date("g:i a"); 



        $fecha= $hoy.' // '.$fecha;




        $consulta = "INSERT INTO `ingreso_sistema_alumno`(`id_ingreso`, `id_user`, `data`) VALUES (null,'$idUsu','$fecha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();







        
            }    


            
}else{
    $_SESSION["s_usuarioEstudiante"] = null;
    $data=null;
}

print json_encode($data);
$conexion=null;

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo