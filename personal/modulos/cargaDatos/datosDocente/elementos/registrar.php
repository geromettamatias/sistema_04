<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

session_start();


    foreach ($_FILES as $key => $file) {

        
         $nombre= $file['name'];
         $type = $file['type'];
         $size = $file['size'];
         $archivotmp = $file['tmp_name'];
         
          
    }


$lineas     = file($archivotmp);
$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);


 
          
        $dni= !empty($datos[0])  ? ($datos[0]) : '';
       
        $nombre= !empty($datos[1])  ? ($datos[1]) : '';
        $nombreDocente = utf8_encode($nombre);

        $passwordDocente= !empty($datos[2])  ? ($datos[2]) : '';
        $password = utf8_encode($passwordDocente);
        $passwor= base64_encode($password);

        $domicilio= !empty($datos[3])  ? ($datos[3]) : '';
        $domicilio = utf8_encode($domicilio);

        $email= !empty($datos[4])  ? ($datos[4]) : '';
        $email = utf8_encode($email);

        $telefono= !empty($datos[5])  ? ($datos[5]) : '';
        $telefono = utf8_encode($telefono);

        $titulo= !empty($datos[6])  ? ($datos[6]) : '';
        $titulo = utf8_encode($titulo);

        $hijos= !empty($datos[6])  ? ($datos[6]) : '';
        $hijos = utf8_encode($hijos);



        if(!empty($dni) ){


              $preguntar=0;

            
            $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` WHERE `dni`='$dni'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $dat) {
                $preguntar=1;
            }



            if ($preguntar==1) {
                
                $consulta = "UPDATE `datos_docentes` SET `nombre`='$nombre',`domicilio`='$domicilio',`email`='$email',`telefono`='$telefono',`titulo`='$titulo',`passwordDocente`='$passwor',`hijos`='$hijos' WHERE `dni`='$dni'";        
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();


            }else{

                 $consulta = "INSERT INTO `datos_docentes`(`nombre`, `dni`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado`) VALUES ('$nombre','$dni','$domicilio','$email','$telefono','$titulo','$password','$hijos','ACTIVO')";           
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();


            }

         

        }

  
    }
        $i++;
}


echo 1;



?>