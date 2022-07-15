<?php


$tituloS = (isset($_POST['tituloS'])) ? $_POST['tituloS'] : '';

$tituloMenuS = (isset($_POST['tituloMenuS'])) ? $_POST['tituloMenuS'] : '';


$png = (isset($_POST['png'])) ? $_POST['png'] : '';



$data = array('titulo' => $tituloS,'tituloMenu' => $tituloMenuS,'url' => $png);




  


$json_datosDirectivos= json_encode($data);

//crar Archivo json

$handler = fopen('../../../../../elementos/datosInstitucional.json', 'w+');
fwrite($handler, $json_datosDirectivos);
fclose($handler);

print json_encode($data, JSON_UNESCAPED_UNICODE);





?>

