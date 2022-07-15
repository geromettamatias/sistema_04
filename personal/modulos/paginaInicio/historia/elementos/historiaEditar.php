<?php 


$historiaf = (isset($_POST['historiaf'])) ? $_POST['historiaf'] : '';


$data = array(
	'historia' => array('informe' => $historiaf));




  


$json_historia= json_encode($data);

//crar Archivo json

$handler = fopen('../../../../../elementos/datos/historia.json', 'w+');
fwrite($handler, $json_historia);
fclose($handler);

print json_encode($data, JSON_UNESCAPED_UNICODE);






 ?>