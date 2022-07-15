<?php

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$r='';
$consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `tipo`='REGISTRAR' AND `usuario`='DOCENTE'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
        	$r.=$dat['pregunta'];
        
        }
  


$consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `tipo`='RECUPERAR-PASS' AND `usuario`='DOCENTE'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
        	$r.='||'.$dat['pregunta'];
        
        }

$consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `tipo`='LOGIN' AND `usuario`='DOCENTE'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
                $r.='||'.$dat['pregunta'];
        
        }

    echo $r;










