 <?php

session_start();


    $cargo=$_SESSION["cargo"];
    $idUsuario=$_SESSION["idUsuario"];
    $correo=$_SESSION["correo"];

if ($cargo!='Administrador') {
   

    if ($correo=='') {
         echo 0;
    }else{

        echo 1;
    }

   


}else{

    echo 1;
}

