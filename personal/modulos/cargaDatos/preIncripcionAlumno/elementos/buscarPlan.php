<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$id_PreIncrip = (isset($_POST['id_PreIncrip'])) ? $_POST['id_PreIncrip'] : '';

$boton='';
$consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $dat) { 
                
                $boton.='<option value="'.$dat['idPlan'].'">'.$dat['nombre'].'</option>';
            }

echo $boton;
$conexion = NULL;