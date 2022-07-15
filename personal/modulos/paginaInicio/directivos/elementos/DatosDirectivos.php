<?php 


$datosDirectivos = (isset($_POST['datosDirectivos'])) ? $_POST['datosDirectivos'] : '';
$nombreDirectivos = (isset($_POST['nombreDirectivos'])) ? $_POST['nombreDirectivos'] : '';

$datosviceDirector = (isset($_POST['datosviceDirector'])) ? $_POST['datosviceDirector'] : '';
$nombreviceDirector = (isset($_POST['nombreviceDirector'])) ? $_POST['nombreviceDirector'] : '';

$datosasesora = (isset($_POST['datosasesora'])) ? $_POST['datosasesora'] : '';
$nombreasesora = (isset($_POST['nombreasesora'])) ? $_POST['nombreasesora'] : '';


$data = array(
	'director' => array('nombreDirectivos' => $nombreDirectivos,'datosDirectivos' => $datosDirectivos),
	 'viceDirector' => array('nombreviceDirector' => $nombreviceDirector,'datosviceDirector' => $datosviceDirector),
	 'asesora' => array('nombreasesora' => $nombreasesora,'datosasesora' => $datosasesora));




 unlink('../../../../../elementos/datos/datosDirectivos.json');


$json_datosDirectivos= json_encode($data);

//crar Archivo json

$handler = fopen('../../../../../elementos/datos/datosDirectivos.json', 'w+');
fwrite($handler, $json_datosDirectivos);
fclose($handler);

print json_encode($data, JSON_UNESCAPED_UNICODE);






 ?>