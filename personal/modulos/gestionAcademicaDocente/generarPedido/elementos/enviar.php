
<?php
//Import PHPMailer classes into the global namespace
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
session_start();

if  (isset($_SESSION['idUsuario'])) {


                                                        
        $idUsuario=$_SESSION["idUsuario"];
        $cargo=$_SESSION["cargo"];
  
if ($cargo!='Administrador') {
    
    $nombreAPELLIDO=$_SESSION['nombre'];
    $dnidOCENTE=$_SESSION['dni'];

}else{

    $nombreAPELLIDO='E.E.T.N°16 "1° de Mayo"';
    $dnidOCENTE=$_SESSION['nombre'];

}


   



$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$emailCopia = (isset($_POST['emailCopia'])) ? $_POST['emailCopia'] : '';




$email =$correo;



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


    
    $des=$nombreAPELLIDO.'--'.$dnidOCENTE;

    $mail->setFrom($correo, $des);
    $mail->addAddress($correo, $tipo);

     $consulta = "SELECT `correo` FROM `correos` WHERE `tipo`='$tipo'";
     $resultado = $conexion->prepare($consulta);
     $resultado->execute();
     $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
     foreach($dat1a as $da1t) { 
            $correo=$da1t['correo'];

            $mail->addAddress($correo, $tipo);

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
 <h3>DATOS</h3>
 <p><b>Apellido y Nombre: </b>'.$nombreAPELLIDO.'<br><b>DNI: </b>'.$dnidOCENTE.'<br><b>Cargo: </b>'.$cargo.'</p>
 <hr>
  <h3>PEDIDO</h3>
 <p><b>TIPO DE PEDIDO: </b>'.$tipo.'<br>
 <b>DESCRIPCIÓN: </b>'.$descripcion.'</p>

</body>
</html>

';




    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->send();




 $consulta = "INSERT INTO `generar_pedido_administracion`(`id_generar_pedido`, `id_docente`, `titpo`, `descripcion`, `email_envio`, `email_envio_copia`, `fecha`, `cargo`) VALUES (null,'$idUsuario','$tipo','$descripcion','$email','$emailCopia','$fecha','$cargo')";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 



        $consulta = "SELECT `id_generar_pedido`, `id_docente`, `titpo`, `descripcion`, `email_envio`, `email_envio_copia`, `fecha`, `cargo` FROM `generar_pedido_administracion` ORDER BY `id_generar_pedido` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {

            echo '|||&|||'.$dat['id_generar_pedido'].'|||&|||'.$dat['fecha'].'|||&|||'.$dat['titpo'].'|||&|||'.$dat['descripcion'].'|||&|||'.$dat['email_envio_copia'];
                      

        }

 

} catch (Exception $e) {
    echo "error al enviar el mensaje: {$mail->ErrorInfo}";
}




}else{
    echo 'No hay correo';
}







}

$conexion = NULL;
