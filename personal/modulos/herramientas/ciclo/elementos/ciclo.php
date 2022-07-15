 <?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

      $var='';   
                    $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `ciclo`";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data as $dat) {

                        $var.='<option>'.$dat['ciclo'].'</option>';

                    }
?>
         <select class="form-select" id="ciclo_Copiar">
                <option>NO COPIAR(NUEVA BASE DE DATO)</option>
               
                <?php  echo $var; ?>
                </select> 

