<?php


$tituloS = (isset($_POST['tituloS'])) ? $_POST['tituloS'] : '';

$tituloMenuS = (isset($_POST['tituloMenuS'])) ? $_POST['tituloMenuS'] : '';

$imagenEliminar = (isset($_POST['imagenEliminar'])) ? $_POST['imagenEliminar'] : '';

unlink('../../../../../elementos/'.$imagenEliminar);

 if(is_array($_FILES) && count($_FILES)>0){



if(move_uploaded_file($_FILES["png"]["tmp_name"],"../../../../../elementos/".$_FILES["png"]["name"])){








$data = array('titulo' => $tituloS,'tituloMenu' => $tituloMenuS,'url' => $_FILES["png"]["name"]);




  


$json_datosDirectivos= json_encode($data);

//crar Archivo json

$handler = fopen('../../../../../elementos/datosInstitucional.json', 'w+');
fwrite($handler, $json_datosDirectivos);
fclose($handler);

print json_encode($data, JSON_UNESCAPED_UNICODE);


 
  }else{
         echo 0;
    }

 }else{
    echo 0;
 }





?>

