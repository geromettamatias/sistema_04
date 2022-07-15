 <?php
include_once '../../modulos/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$idUsuario=$_SESSION["idUsuario"];
   

$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';

$consulta = "UPDATE `usuarios_auxilar_regente` SET `correo`='$correo' WHERE   `idUsu`='$idUsuario'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
$_SESSION["correo"]=$correo;      
echo 1;
$conexion = NULL;
