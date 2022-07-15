<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

if (isset($_SESSION['idUsuario'])){



$arrayContieneLosElementosAEliminar = (isset($_POST['arrayContieneLosElementosAEliminar'])) ? $_POST['arrayContieneLosElementosAEliminar'] : '';
foreach($arrayContieneLosElementosAEliminar as $array) {




$id = $array;


        $consulta = "DELETE FROM `generar_pedido_administracion` WHERE `id_generar_pedido`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

                             


}

echo 1;
           
$conexion = NULL;


}