<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

session_start();


$idAlumnos = (isset($_POST['idAlumnos'])) ? $_POST['idAlumnos'] : '';



$res=0;
$consulta = "SELECT `idAnalitico`, `idPlan`, `idAsig`, `idAlumno`, `nota`, `notaEscr`, `fechaMes`, `fechaAño`, `condicion`, `establecimiento` FROM `analitico` WHERE `idAlumno` = '$idAlumnos'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) { 

            $res=1;

            $_SESSION['idAlumnos']=$idAlumnos;


         }

echo $res;
     

$conexion = NULL;