<?php

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../../../../elementos/PHPMailer-master/src/Exception.php';
require '../../../../../elementos/PHPMailer-master/src/PHPMailer.php';
require '../../../../../elementos/PHPMailer-master/src/SMTP.php';



include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';


$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass` FROM `datosalumnos` WHERE `dniAlumnos`='$dni'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
   
     foreach($data as $dat1) {                                                        
         $nombre=$dat1['nombreAlumnos'];
         $dni=$dat1['dniAlumnos'];
         $cuil=$dat1['cuilAlumnos'];
         $domicilio=$dat1['domicilioAlumnos'];
         $email=$dat1['emailAlumnos'];
         $pass=base64_decode ($dat1['pass']);
     
      
    }

    if (($email=='SIN DATO') || ($email=='SIN-DATO') || ($email=='SI-DATO') || ($email=='')) {
        echo 2;
    }else{


echo $email;


$tipo='Administrador';


$consulta = "SELECT `id_correoSer`, `correo`, `pass`, `app`, `pass_app`, `host`, `port` FROM `correoservidor`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) {

        $correo=$dat['correo'];
        $pass=base64_decode ($dat['pass']);
        $app=$dat['app'];
        $pass_app=base64_decode ($dat['pass_app']);
        $host=$dat['host'];
        $port=$dat['port'];

        
}


if (($correo!='') || ($pass!='') || ($app!='') || ($pass_app!='') || ($host!='') || ($port!='')) {


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);





try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $host;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $correo;                     //SMTP username
    $mail->Password   = $pass_app;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = var_dump($port);                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    //Recipients

    
    $des=$nombre.'--'.$dni;

    $mail->setFrom('eet16sistema@gmail.com', $des);
    
    $mail->addAddress('eet16sistema@gmail.com', $tipo);


    $mail->addAddress($email, $tipo);
    
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $tipo;
    $mail->Body    = '

<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN-AUTOGESTIÓN</title>
<head>
    
    
    <style type="text/css">
        h3{
            color: #060DA6;
        }
        p{
            font-size: 1rem;
            color: #13531C;
        }

       
    </style>
</head>
<body>


<h2>AUTOGESTIÓN GENERADO // RECUPERAR USUARIO Y CONTRASEÑA</h2>
 <h3>DATOS DE '.$nombre.'</h3>
 <p><b>USUARIO: </b>'.$dni.'<br><b>CONTRASELA: </b>'.$pass.'<br></p>
</body>
</html>

';


    $mail->AltBody = 'ADMINISTRADOR';



    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->send();

    
} catch (Exception $e) {
    echo "error";
}





}else{
    echo 'No hay correo';
}








    }




}else{

    echo 1;
}



$conexion=null;







