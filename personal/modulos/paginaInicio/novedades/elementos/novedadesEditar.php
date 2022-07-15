<?php 


$novedadesf = (isset($_POST['novedadesf'])) ? $_POST['novedadesf'] : '';


$data = array(
	'novedades' => array('informe' => $novedadesf));




  


$json_novedades= json_encode($data);

//crar Archivo json

$handler = fopen('../../../../../elementos/datos/novedades.json', 'w+');
fwrite($handler, $json_novedades);
fclose($handler);

print json_encode($data, JSON_UNESCAPED_UNICODE);






 ?>