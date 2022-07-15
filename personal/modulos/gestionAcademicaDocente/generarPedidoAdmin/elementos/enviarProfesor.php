<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../../../../elementos/PHPMailer-master/src/Exception.php';
require '../../../../../elementos/PHPMailer-master/src/PHPMailer.php';
require '../../../../../elementos/PHPMailer-master/src/SMTP.php';





include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

if (isset($_SESSION['idUsuario'])){





    $idUsuario=$_SESSION['idUsuario'];
    $tipo=$_SESSION['tipoProfesor'];



$id_generar_pedido = (isset($_POST['id_generar_pedido'])) ? $_POST['id_generar_pedido'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$situacion = (isset($_POST['situacion'])) ? $_POST['situacion'] : '';
$emailCopia = (isset($_POST['emailCopia'])) ? $_POST['emailCopia'] : '';




$email ='';




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
    $mail->Port       = $port;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



    
    $des='E.E.T. N°16 "1° de Mayo"';

    $mail->setFrom($correo, $des);
    
    $mail->addAddress($correo, $tipo);

     $consulta = "SELECT `datos_docentes`.`nombre`, `datos_docentes`.`dni`, `datos_docentes`.`email` FROM `datos_docentes` INNER JOIN `generar_pedido_docente` ON `generar_pedido_docente`.`id_docente`= `datos_docentes`.`idDocente` WHERE `generar_pedido_docente`.`id_generar_pedido`='$id_generar_pedido'";
     $resultado = $conexion->prepare($consulta);
     $resultado->execute();
     $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
     foreach($dat1a as $da1t) { 
            $email=$da1t['email'];

            $mail->addAddress($email, $tipo);

     }

      if ($emailCopia!='') {

            $mail->addAddress($emailCopia, $tipo);
    }    
   
   



     //quien va Add a recipient
    //$mail->addCC('epgs2sistema@gmail.com');



    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

$contador=0;
  foreach ($_FILES as $key => $file) {

            $nombre= $file['name'];
         
            $ruta_provisonal = $file['tmp_name'];

$contador++;
          
  $mail->addAttachment($ruta_provisonal,$nombre);
                 

  
}











    //Attachments enviar archivos o imagen
    //$mail->addAttachment('1.jpg');         // adjuntar archivos
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name



    // $mail->AddEmbeddedImage('libreria/imag/logo_fondo_email.png','logo_fondo_email');  // cargar imagen html 



    //Content
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


<h2>GESTIÓN DE PEDIDO DEL AUTOGESTIÓN GENERADO EL <b>'.$fecha.'</b></h2>
 <h3>N° Pedido '.$id_generar_pedido.'</h3>
 

 <p><b>TIPO DE PEDIDO: </b>'.$tipo.'<br>
 <b>Resolución del Pedido: </b>'.$situacion.'</p>

</body>
</html>

';




    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->send();

$resolucion='Fecha: '.$fecha.' Resolución: '.$situacion;


 $consulta = "UPDATE `generar_pedido_docente` SET `situacion`='$resolucion' WHERE `id_generar_pedido`='$id_generar_pedido'";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT generar_pedido_docente.id_generar_pedido, generar_pedido_docente.id_docente, generar_pedido_docente.titpo, generar_pedido_docente.descripcion, generar_pedido_docente.email_envio, generar_pedido_docente.email_envio_copia, generar_pedido_docente.situacion, generar_pedido_docente.fecha, datos_docentes.nombre, datos_docentes.dni, datos_docentes.email, datos_docentes.telefono, datos_docentes.titulo FROM generar_pedido_docente INNER JOIN datos_docentes ON datos_docentes.idDocente= generar_pedido_docente.id_docente WHERE generar_pedido_docente.id_generar_pedido='$id_generar_pedido'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS





} catch (Exception $e) {
    echo "error al enviar el mensaje: {$mail->ErrorInfo}";
}



}else{
    echo 'No hay correo';
}




}

$conexion = NULL;
