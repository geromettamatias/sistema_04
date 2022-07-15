
<?php 
	session_start();

	$idCurso=$_POST['idCurso'];
	$_SESSION['idCurso']=$idCurso;


	  include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $cursoSeleB=$_SESSION['cursoSeleB'];

        $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



           
      $consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `idCurso`='$idCurso'";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      foreach($data as $dat) { 

      	
      	$idPlan=$dat['idPlan'];
      	$ciclo=$dat['ciclo'];
      	$nombre=$dat['nombre'];


      }


	$_SESSION['idPlan']=$idPlan;
	$_SESSION['ciclo']=$ciclo;
	$_SESSION['nombre']=$nombre;

echo "1";



 ?>