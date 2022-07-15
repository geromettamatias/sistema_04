
<div class="form-group">
                <label for="cue" class="col-form-label">Institucion:</label>
                
<select class="form-control" id="institucionPlan">



 <?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT `idInstitucion`, `nombre`, `cue`, `domicilio`, `tel`, `email` FROM `institucion_datos`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>



                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>

                            <option value="<?php echo $dat['idInstitucion'] ?>"><?php echo $dat['nombre'] ?></option>

                            
                                  
                             
                            <?php
                                }
                            ?>  


</select>

</div> 


 <div class="form-group">
                <label for="nombreI" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombrePlan">
                </div>
                <div class="form-group">
                <label for="cue" class="col-form-label">Numero:</label>
                <input type="text" class="form-control" id="numeroPlan">
                </div>                


