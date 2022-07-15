<?php
session_start();

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$passwordDocente = (isset($_POST['passwordDocente'])) ? $_POST['passwordDocente'] : '';


$password= base64_encode($passwordDocente);


$consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` WHERE `dni`='$dni' AND `passwordDocente`='$password'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
   
     foreach($data as $dat1) {

        $estado = $dat1['estado'];

        if ($estado=='ACTIVO') {
        
                $_SESSION["idUsuario"] = $dat1['idDocente'];
                $_SESSION["dni"] = $dat1['dni'];
                $_SESSION["nombre"] = $dat1['nombre'];
                $_SESSION["cargo"] ='Profesor';
                $_SESSION["nivelCurso"] ='TODOS';
                $_SESSION["operacion"] ='Lectura y Escritura';
                $_SESSION["password"] = $dat1['passwordDocente'];




                date_default_timezone_set("America/Argentina/Buenos_Aires");

                    $idUsu=$dat1['idDocente'];


        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         
        $fecha= $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;


        $hoy = date("g:i a"); 


        $fecha= $hoy.' // '.$fecha;




        $consulta = "INSERT INTO `ingreso_sistema_docente`(`id_ingreso`, `id_user`, `data`) VALUES (null,'$idUsu','$fecha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();










                

                echo 3;

        }else{

                $_SESSION["idUsuario"] = null;
                $_SESSION["dni"] = null ;
                $_SESSION["nombre"] = null;
                $_SESSION["cargo"] =null;
                $_SESSION["nivelCurso"] =null;
                $_SESSION["operacion"] =null;
                 $_SESSION["password"]  =null;


                unset($_SESSION["idUsuario"]);
                unset($_SESSION["dni"]);
                unset($_SESSION["nombre"]);
                unset($_SESSION["cargo"]);
                unset($_SESSION["nivelCurso"]);
                unset($_SESSION["operacion"]);
                unset($_SESSION["password"]);
                session_destroy();


                echo 1;
        }
      
    }

}else{


    $_SESSION["idUsuario"] = null;
    $_SESSION["dni"] = null ;
    $_SESSION["nombre"] = null;
    $_SESSION["cargo"] =null;
    $_SESSION["nivelCurso"] =null;
    $_SESSION["operacion"] =null;
     $_SESSION["password"]  =null;


    unset($_SESSION["idUsuario"]);
    unset($_SESSION["dni"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["cargo"]);
    unset($_SESSION["nivelCurso"]);
    unset($_SESSION["operacion"]);
    unset($_SESSION["password"]);
    session_destroy();


    $data=null;

     echo 2;
}


$conexion=null;