<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

session_start();


$idAlumnos = (isset($_POST['idAlumnos'])) ? $_POST['idAlumnos'] : '';

$_SESSION['idAlumnos']=$idAlumnos;


$res=0;
  $consulta = "SELECT `idPlanEstudio` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumnos'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
            $idPlanEstudio=$dat['idPlanEstudio'];
        }

        $consulta = "SELECT `idAsig`, `idPlan`, `nombre`, `ciclo` FROM `plan_datos_asignaturas` WHERE `idPlan`='$idPlanEstudio' OR `idPlan`='básico'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($d1ata as $d1at) {
            $idAsig=$d1at['idAsig'];

            $idPlanD=$d1at['idPlan'];
             
            $consulta = "INSERT INTO `analitico`(`idAnalitico`, `idPlan`, `idAsig`, `idAlumno`, `nota`, `notaEscr`, `fechaMes`, `fechaAño`, `condicion`, `establecimiento`) VALUES  (null,'$idPlanD','$idAsig','$idAlumnos','','','','','','')";            
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
        }
                        echo $res;
     


     

$conexion = NULL;