<?php
session_start();

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$passwordPrecep = (isset($_POST['passwordPrecep'])) ? $_POST['passwordPrecep'] : '';

$pass = base64_encode($passwordPrecep); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD

$consulta = "SELECT `idUsu`, `cargo`, `nombre`, `dni`, `correo`, `nivelCurso`, `operacion`, `pass` FROM `personal_eet16` WHERE dni='$dni' AND pass='$pass'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
  
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($data1 as $dat1) {  

  
        $_SESSION["idUsuario"] = $dat1['idUsu'];
        $_SESSION["nombre"] = $dat1['nombre'];
         $_SESSION["dni"] = $dat1['dni'];
        $_SESSION["cargo"] =$dat1['cargo'];
        $_SESSION["nivelCurso"] =$dat1['nivelCurso'];
        $_SESSION["operacion"] =$dat1['operacion'];
        $_SESSION["password"] = $dat1['pass'];
        $_SESSION["correo"] = $dat1['correo'];


        date_default_timezone_set("America/Argentina/Buenos_Aires");

        $idUsu=$dat1['idUsu'];


        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         
        $fecha= $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;


        $hoy = date("g:i a"); 


        $fecha= $hoy.' // '.$fecha;




        $consulta = "INSERT INTO `ingreso_sistema_personal`(`id_ingreso`, `id_user`, `data`) VALUES (null,'$idUsu','$fecha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


     
            }



}else{
      $_SESSION["idUsuario"] = null;
    $_SESSION["nombre"] = null;
    $_SESSION["dni"] = null;
    $_SESSION["cargo"] =null;
    $_SESSION["nivelCurso"] =null;
    $_SESSION["operacion"] =null;
    $_SESSION["password"] =null;
    $_SESSION["correo"]=null;


    unset($_SESSION["idUsuario"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["dni"]);
    unset($_SESSION["cargo"]);
    unset($_SESSION["nivelCurso"]);
    unset($_SESSION["operacion"]);
    unset($_SESSION["password"]);
    unset($_SESSION["correo"]);
    session_destroy();


    $data1=null;
}

print json_encode($data1);
$conexion=null;





