<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

if (isset($_SESSION['idUsuario'])){



$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id = $dataFila[0];


        $consulta = "DELETE FROM `generar_pedido_docente` WHERE `id_generar_pedido`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 1;
                                



$conexion = NULL;


}