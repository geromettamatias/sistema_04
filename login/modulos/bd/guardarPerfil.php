<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS 
 session_start();


      $tipo='invitado';
        $id=1;

        $preguntaFIN=0;



$password = (isset($_POST['password'])) ? $_POST['password'] : '';



        if (isset($_SESSION['idUsuario'])){
                $tipo=$_SESSION["cargo"];   
                $id=$_SESSION['idUsuario'];
             
                $passwordAdmin=base64_decode ($_SESSION['password']);
                if ($passwordAdmin==$password) {
                    $preguntaFIN=1;
                }

        }else{

                if (isset($_SESSION['s_usuarioEstudiante'])){
                    $tipo='estudiante';   
                    $id=$_SESSION['s_usuarioEstudiante'];
                    $cuilAlumnos=$_SESSION["cuilAlumnos"];

                      if ($cuilAlumnos==$password) {
                            $preguntaFIN=1;
                        }

            }else{

                            $tipo='invitado';
                            $id=1;

                              if ('ESCUELA16'==$password) {
                                    $preguntaFIN=1;
                                }
                        

                }

            }
          
       

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';





if ($opcion==1) {


     $res= '0||0||0||0||0||0||0||0||0||0||0||0||0||0||0'; 







         $consulta = "SELECT `id`, `tipo`, `idUsuario`, `borde`, `textoCuerpoPequeño`, `textoCuerpoPequeñoNavegacion`, `textoCuerpoPequeñoNavegacionLateral`, `textoPiePagina`, `textoPiePaginaDos`, `textoPiePaginaTres`, `barraVa`, `sangria`, `barraInfer`, `marcaAgua`, `BarraNavegacion`, `varianteAcente`, `BarraLateral`, `logoTipo` FROM `perfil_estilo_usuarios` WHERE `tipo`='$tipo' AND `idUsuario`='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $dat) { 

                    $borde=$dat['borde'];
                    $textoCuerpoPequeño=$dat['textoCuerpoPequeño'];
                    $textoCuerpoPequeñoNavegacion=$dat['textoCuerpoPequeñoNavegacion'];
                    $textoCuerpoPequeñoNavegacionLateral=$dat['textoCuerpoPequeñoNavegacionLateral'];
                    $textoPiePagina=$dat['textoPiePagina'];
                    $textoPiePaginaDos=$dat['textoPiePaginaDos'];
                    $textoPiePaginaTres=$dat['textoPiePaginaTres'];
                    $barraVa=$dat['barraVa'];
                    $sangria=$dat['sangria'];
                    $barraInfer=$dat['barraInfer'];
                    $marcaAgua=$dat['marcaAgua'];
                    $BarraNavegacion=$dat['BarraNavegacion'];
                    $varianteAcente=$dat['varianteAcente'];
                    $BarraLateral=$dat['BarraLateral'];
                   
                    $logoTipo=$dat['logoTipo'];


          
                    $res= $borde.'||'.$textoCuerpoPequeño.'||'.$textoCuerpoPequeñoNavegacion.'||'.$textoCuerpoPequeñoNavegacionLateral.'||'.$textoPiePagina.'||'.$textoPiePaginaDos.'||'.$textoPiePaginaTres.'||'.$barraVa.'||'.$sangria.'||'.$barraInfer.'||'.$marcaAgua.'||'.$BarraNavegacion.'||'.$varianteAcente.'||'.$BarraLateral.'||'.$logoTipo;           

                }




                echo $res;

                $conexion = NULL;

   

}else{

    if ($preguntaFIN==1) {
    

        $borde = (isset($_POST['borde'])) ? $_POST['borde'] : '';
        $textoCuerpoPequeño = (isset($_POST['textoCuerpoPequeño'])) ? $_POST['textoCuerpoPequeño'] : '';
        $textoCuerpoPequeñoNavegacion = (isset($_POST['textoCuerpoPequeñoNavegacion'])) ? $_POST['textoCuerpoPequeñoNavegacion'] : '';
        $textoCuerpoPequeñoNavegacionLateral = (isset($_POST['textoCuerpoPequeñoNavegacionLateral'])) ? $_POST['textoCuerpoPequeñoNavegacionLateral'] : '';
        $textoPiePagina = (isset($_POST['textoPiePagina'])) ? $_POST['textoPiePagina'] : '';
        $textoPiePaginaDos = (isset($_POST['textoPiePaginaDos'])) ? $_POST['textoPiePaginaDos'] : '';
        $textoPiePaginaTres = (isset($_POST['textoPiePaginaTres'])) ? $_POST['textoPiePaginaTres'] : '';
        $barraVa = (isset($_POST['barraVa'])) ? $_POST['barraVa'] : '';
        $sangria = (isset($_POST['sangria'])) ? $_POST['sangria'] : '';
        $barraInfer = (isset($_POST['barraInfer'])) ? $_POST['barraInfer'] : '';
        $marcaAgua = (isset($_POST['marcaAgua'])) ? $_POST['marcaAgua'] : '';
        $BarraNavegacion = (isset($_POST['BarraNavegacion'])) ? $_POST['BarraNavegacion'] : '';
        $varianteAcente = (isset($_POST['varianteAcente'])) ? $_POST['varianteAcente'] : '';
        $BarraLateral = (isset($_POST['BarraLateral'])) ? $_POST['BarraLateral'] : '';
    
        $logoTipo = (isset($_POST['logoTipo'])) ? $_POST['logoTipo'] : '';





            $pref=0; 
            $consulta = "SELECT `id`, `tipo`, `idUsuario`, `borde`, `textoCuerpoPequeño`, `textoCuerpoPequeñoNavegacion`, `textoCuerpoPequeñoNavegacionLateral`, `textoPiePagina`, `textoPiePaginaDos`, `textoPiePaginaTres`, `barraVa`, `sangria`, `barraInfer`, `marcaAgua`, `BarraNavegacion`, `varianteAcente`, `BarraLateral`, `logoTipo` FROM `perfil_estilo_usuarios` WHERE `tipo`='$tipo' AND `idUsuario`='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $dat) { 

                $pref=1; 


                    $BarraNavegacion2=$dat['BarraNavegacion'];
                    $varianteAcente2=$dat['varianteAcente'];
                    $BarraLateral2=$dat['BarraLateral'];
                   
                    $logoTipo2=$dat['logoTipo'];



              

                    if ($BarraNavegacion=='') {
                        $BarraNavegacion=$BarraNavegacion2;
                    }

                    if ($varianteAcente=='') {
                        $varianteAcente=$varianteAcente2;
                    }

                    if ($BarraLateral=='') {
                        $BarraLateral=$BarraLateral2;
                    }

              

                    if ($logoTipo=='') {
                        $logoTipo=$logoTipo2;
                    }               

                }



                if ($pref==0) {
                    

                    $consulta = "INSERT INTO `perfil_estilo_usuarios`(`id`, `tipo`, `idUsuario`, `borde`, `textoCuerpoPequeño`, `textoCuerpoPequeñoNavegacion`, `textoCuerpoPequeñoNavegacionLateral`, `textoPiePagina`, `textoPiePaginaDos`, `textoPiePaginaTres`, `barraVa`, `sangria`, `barraInfer`, `marcaAgua`, `BarraNavegacion`, `varianteAcente`, `BarraLateral`, `logoTipo`) VALUES (null,'$tipo','$id','$borde','$textoCuerpoPequeño','$textoCuerpoPequeñoNavegacion','$textoCuerpoPequeñoNavegacionLateral','$textoPiePagina','$textoPiePaginaDos','$textoPiePaginaTres','$barraVa','$sangria','$barraInfer','$marcaAgua','$BarraNavegacion','$varianteAcente','$BarraLateral','$logoTipo')";          
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();

                        echo 'Muy Bien 1'; 


                }else{

                    $consulta = "UPDATE `perfil_estilo_usuarios` SET `borde`='$borde',`textoCuerpoPequeño`='$textoCuerpoPequeño',`textoCuerpoPequeñoNavegacion`='$textoCuerpoPequeñoNavegacion',`textoCuerpoPequeñoNavegacionLateral`='$textoCuerpoPequeñoNavegacionLateral',`textoPiePagina`='$textoPiePagina',`textoPiePaginaDos`='$textoPiePaginaDos',`textoPiePaginaTres`='$textoPiePaginaTres',`barraVa`='$barraVa',`sangria`='$sangria',`barraInfer`='$barraInfer',`marcaAgua`='$marcaAgua',`BarraNavegacion`='$BarraNavegacion',`varianteAcente`='$varianteAcente',`BarraLateral`='$BarraLateral',`logoTipo`='$logoTipo' WHERE `tipo`='$tipo' AND `idUsuario`='$id'";          
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(); 

                        echo 'Muy Bien 2';             
                }


$conexion = NULL;


}else{

    echo "Contraseña incorrecta";
}

 }






