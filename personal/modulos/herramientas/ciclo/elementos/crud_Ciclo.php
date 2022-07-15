
<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id_ciclo = $dataFila[0];
$ciclo =$dataFila[1];
$edicion =$dataFila[2];
$ciclo_Copiar =$dataFila[3]; 
$opcion =$dataFila[4];


$pregunta=0;

if ($opcion!=3) {

$c1onsulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` WHERE `ciclo`='$ciclo'";
$r1esultado = $conexion->prepare($c1onsulta);
$r1esultado->execute();
$d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
foreach($d1ata as $d1at) {

    $pregunta =1;

}

}

if ($pregunta==0) {
  



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `ciclo_lectivo`(`id_ciclo`, `ciclo`, `edicion`) VALUES (null,'$ciclo','$edicion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



if ($ciclo_Copiar!='NO COPIAR(NUEVA BASE DE DATO)') {
    
   // Copia bd Inscripcion curso

        $consulta = "CREATE TABLE `eet16_db`.`inscrip_curso_alumno_$ciclo` SELECT * FROM `inscrip_curso_alumno_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `inscrip_curso_alumno_$ciclo` CHANGE `idIns` `idIns` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idIns`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

     // Copia bd libreta digital


        $consulta = "CREATE TABLE `eet16_db`.`libreta_digital_$ciclo` SELECT `id_libreta`, `idIns`, `idAsig` FROM `libreta_digital_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `libreta_digital_$ciclo` CHANGE `id_libreta` `id_libreta` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_libreta`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    // Copia bd copia Cursos

        $consulta = "CREATE TABLE `eet16_db`.`curso_$ciclo` SELECT * FROM `curso_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `curso_$ciclo` CHANGE `idCurso` `idCurso` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idCurso`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    // copia bd designacion


          $consulta = "CREATE TABLE `eet16_db`.`descripasig_$ciclo` SELECT * FROM `descripasig_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `descripasig_$ciclo` CHANGE `idDescrip` `idDescrip` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idDescrip`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



    // copia designaciones docentes

        $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_$ciclo` SELECT * FROM `asignacion_asignatura_docente_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    $consulta = "ALTER TABLE `asignacion_asignatura_docente_$ciclo` CHANGE `idAsig` `idAsig` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idAsig`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



        $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_cargo_$ciclo` SELECT * FROM `asignacion_asignatura_docente_cargo_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    $consulta = "ALTER TABLE `asignacion_asignatura_docente_cargo_$ciclo` CHANGE `id_asig_cargo` `id_asig_cargo` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_asig_cargo`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



         $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_proyecto_$ciclo` SELECT * FROM `asignacion_asignatura_docente_proyecto_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `asignacion_asignatura_docente_proyecto_$ciclo` CHANGE `id_asig_proyecto` `id_asig_proyecto` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_asig_proyecto`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


      // Copia Datos de la ficha del alumno


         $consulta = "CREATE TABLE `eet16_db`.`datosficha_$ciclo` SELECT * FROM `datosficha_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `datosficha_$ciclo` CHANGE `idDatoExtraFicha` `idDatoExtraFicha` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idDatoExtraFicha`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    // Copia de Datos Asignatura pendiente

             $consulta = "CREATE TABLE `eet16_db`.`asignaturas_pendientes_$ciclo` SELECT * FROM `asignaturas_pendientes_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `asignaturas_pendientes_$ciclo` CHANGE `idAsigPendiente` `idAsigPendiente` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idAsigPendiente`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


    // copiar informe


          $consulta = "CREATE TABLE `eet16_db`.`confi_informe_$ciclo` SELECT * FROM `confi_informe_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `confi_informe_$ciclo` CHANGE `id_informe` `id_informe` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_informe`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



        // copiar informe pagina 2


          $consulta = "CREATE TABLE `eet16_db`.`confi_informe_2_$ciclo` SELECT * FROM `confi_informe_2_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `confi_informe_2_$ciclo` CHANGE `id_informe` `id_informe` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_informe`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


        // copiar informe titulo


          $consulta = "CREATE TABLE `eet16_db`.`confi_informe_titulo_$ciclo` SELECT * FROM `confi_informe_titulo_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `confi_informe_titulo_$ciclo` CHANGE `id_titulo` `id_titulo` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_titulo`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();





        // copiar informe titulo 2 pagina


          $consulta = "CREATE TABLE `eet16_db`.`confi_informe_titulo_2_$ciclo` SELECT * FROM `confi_informe_titulo_2_$ciclo_Copiar`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `confi_informe_titulo_2_$ciclo` CHANGE `id_titulo` `id_titulo` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_titulo`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();




}else{

    //  config informe titulo

     $consulta = "CREATE TABLE `eet16_db`.`confi_informe_titulo_$ciclo` ( `id_titulo` INT NULL AUTO_INCREMENT , `tituloGenera` TEXT NOT NULL, PRIMARY KEY (`id_titulo`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


        //  config informe titulo

     $consulta = "CREATE TABLE `eet16_db`.`confi_informe_titulo_2_$ciclo` ( `id_titulo` INT NULL AUTO_INCREMENT , `tituloGenera` TEXT NOT NULL, PRIMARY KEY (`id_titulo`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



    //  config informe 

     $consulta = "CREATE TABLE `eet16_db`.`confi_informe_$ciclo` ( `id_informe` INT NULL AUTO_INCREMENT , `tipo` TEXT NOT NULL,`titulo` TEXT NOT NULL,`pregunta` TEXT NOT NULL,`aclaracion` TEXT NOT NULL,`respuestas_posible` TEXT NOT NULL,`modalidad` TEXT NOT NULL,`id_titologeneral` TEXT NOT NULL, PRIMARY KEY (`id_informe`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



//  config informe 2 hoja

     $consulta = "CREATE TABLE `eet16_db`.`confi_informe_2_$ciclo` ( `id_informe` INT NULL AUTO_INCREMENT , `tipo` TEXT NOT NULL,`titulo` TEXT NOT NULL,`pregunta` TEXT NOT NULL,`aclaracion` TEXT NOT NULL,`respuestas_posible` TEXT NOT NULL,`modalidad` TEXT NOT NULL,`id_titologeneral` TEXT NOT NULL, PRIMARY KEY (`id_informe`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



    // Nueva bd Inscripcion curso
        
        $consulta = "CREATE TABLE `eet16_db`.`inscrip_curso_alumno_$ciclo` ( `idIns` INT NULL AUTO_INCREMENT , `idCurso` TEXT NOT NULL , `idAlumno` TEXT NOT NULL , PRIMARY KEY (`idIns`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    // Nueva bd libreta digital

        $consulta = "CREATE TABLE `eet16_db`.`libreta_digital_$ciclo` ( `id_libreta` INT NULL AUTO_INCREMENT , `idIns` TEXT NOT NULL , `idAsig` TEXT NOT NULL , PRIMARY KEY (`id_libreta`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


     // Nueva bd copia Cursos

         $consulta = "CREATE TABLE `eet16_db`.`curso_$ciclo` ( `idCurso` INT NULL AUTO_INCREMENT , `idPlan` TEXT NOT NULL , `ciclo` TEXT NOT NULL , `nombre` TEXT NOT NULL , PRIMARY KEY (`idCurso`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

     // Nueva bd designacion

           $consulta = "CREATE TABLE `eet16_db`.`descripasig_$ciclo` (
          `idDescrip` int(11) NOT NULL AUTO_INCREMENT,
          `idAsignatura` text NOT NULL,
          `dia` text NOT NULL,
          `horario` text NOT NULL,
          `ciclo` text NOT NULL,
          `corresponde` text NOT NULL,
          `curso` text NOT NULL,
          `idCurso` text NOT NULL, PRIMARY KEY (`idDescrip`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

    // Nueva  asgnaciones docentes



         $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_$ciclo` ( `idAsig` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `idCurso` TEXT NOT NULL , `idAsignatura` TEXT NOT NULL, `situacion` TEXT NOT NULL, `desde` TEXT NOT NULL, `hasta` TEXT NOT NULL , `obserbaci` TEXT NOT NULL , PRIMARY KEY (`idAsig`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_cargo_$ciclo` ( `id_asig_cargo` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `cargo` TEXT NOT NULL , `situacion` TEXT NOT NULL , `desde` TEXT NOT NULL , `hasta` TEXT NOT NULL , `lunes` TEXT NOT NULL , `martes` TEXT NOT NULL , `miercoles` TEXT NOT NULL , `jueves` TEXT NOT NULL , `viernes` TEXT NOT NULL , PRIMARY KEY (`id_asig_cargo`))";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();


            $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_proyecto_$ciclo` ( `id_asig_proyecto` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `cHoras` TEXT NOT NULL , `situacion` TEXT NOT NULL , `desde` TEXT NOT NULL , `hasta` TEXT NOT NULL , `lunes` TEXT NOT NULL , `martes` TEXT NOT NULL , `miercoles` TEXT NOT NULL , `jueves` TEXT NOT NULL , `viernes` TEXT NOT NULL , `licencia` TEXT NOT NULL , PRIMARY KEY (`id_asig_proyecto`))";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

        // Nueva Datos de la ficha del alumno

            $consulta = "CREATE TABLE `eet16_db`.`datosficha_$ciclo` ( `idDatoExtraFicha` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `Libro` TEXT NOT NULL , `Folio` TEXT NOT NULL , `auxiliar` TEXT NOT NULL , `piePagina` TEXT NOT NULL , PRIMARY KEY (`idDatoExtraFicha`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


        // Nueva Datos de Asignaturas pendientes

         $consulta = "CREATE TABLE `eet16_db`.`asignaturas_pendientes_$ciclo` ( `idAsigPendiente` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `asignaturas` TEXT NOT NULL , `calFinal_1` TEXT NOT NULL , `fecha_1` TEXT NOT NULL , `libro_1` TEXT NOT NULL , `folio_1` TEXT NOT NULL, `calFinal_2` TEXT NOT NULL , `fecha_2` TEXT NOT NULL , `libro_2` TEXT NOT NULL , `folio_2` TEXT NOT NULL, `calFinal_3` TEXT NOT NULL , `fecha_3` TEXT NOT NULL , `libro_3` TEXT NOT NULL , `folio_3` TEXT NOT NULL, `calFinal_4` TEXT NOT NULL , `fecha_4` TEXT NOT NULL , `libro_4` TEXT NOT NULL , `folio_4` TEXT NOT NULL, `calFinal_5` TEXT NOT NULL , `fecha_5` TEXT NOT NULL , `libro_5` TEXT NOT NULL , `folio_5` TEXT NOT NULL, `situacion` TEXT NOT NULL, `bloque1` TEXT NOT NULL, `bloque2` TEXT NOT NULL, `bloque3` TEXT NOT NULL, `bloque4` TEXT NOT NULL, `bloque5` TEXT NOT NULL , PRIMARY KEY (`idAsigPendiente`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        

        }  


        // Nueva bd cabezado


        $consulta = "CREATE TABLE `eet16_db`.`cabezera_libreta_digital_$ciclo` ( `idCabezera` INT NULL AUTO_INCREMENT , `nombre` TEXT NOT NULL , `descri` TEXT NOT NULL , `editarDocente` TEXT NOT NULL , `corresponde` TEXT NOT NULL , `tipo` TEXT NOT NULL , PRIMARY KEY (`idCabezera`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

        //  Nueva base asistencia

                      
$consulta = "CREATE TABLE `instituto`.`asistenciaalumno_$ciclo` ( `id_Asistencia` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `fecha` TEXT NOT NULL , `cantidad` TEXT NOT NULL , `justificado` TEXT NOT NULL , `observacion` TEXT NOT NULL , `encabezado` TEXT NOT NULL  , PRIMARY KEY (`id_Asistencia`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


        //  asistencia Docente HC

        $consulta = "CREATE TABLE `eet16_db`.`asistenciadocente_$ciclo` ( `id_Asistencia` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `idCurso` TEXT NOT NULL , `idAsignatura` TEXT NOT NULL , `idParte` TEXT NOT NULL , `fecha` TEXT NOT NULL , `estado` TEXT NOT NULL , `horario` TEXT NOT NULL , PRIMARY KEY (`id_Asistencia`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

        //  asistencia Docente Cargo

        $consulta = "CREATE TABLE `eet16_db`.`asistenciadocente_cargo_$ciclo` (
          `id_Asistencia` int(11) NOT NULL AUTO_INCREMENT,
          `idDocente` text NOT NULL,
          `cargo` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `idParte` text NOT NULL,
          `fecha` text NOT NULL,
          `estado` text NOT NULL,
          PRIMARY KEY (`id_Asistencia`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

        //  asistencia Docente horas Proyecto

        $consulta = "CREATE TABLE `eet16_db`.`asistenciadocente_proyecto_$ciclo` (
          `id_Asistencia` int(11) NOT NULL AUTO_INCREMENT,
          `idDocente` text NOT NULL,
          `choras` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `idParte` text NOT NULL,
          `fecha` text NOT NULL,
          `estado` text NOT NULL,
          PRIMARY KEY (`id_Asistencia`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();


        //  asistencia Alumno
              
        $consulta = "CREATE TABLE `eet16_db`.`asistenciaalumno_$ciclo` ( `id_Asistencia` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `fecha` TEXT NOT NULL , `cantidad` TEXT NOT NULL , `justificado` TEXT NOT NULL , `observacion` TEXT NOT NULL , `encabezado` TEXT NOT NULL  , PRIMARY KEY (`id_Asistencia`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();


        //  Datos Libreta
            
        $consulta = "CREATE TABLE `eet16_db`.`datoslibreta_$ciclo` ( `idDatosFicha` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `promovido` TEXT NOT NULL , `ob` TEXT NOT NULL , `lugarFecha` TEXT NOT NULL , PRIMARY KEY (`idDatosFicha`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

        //  Datos Licencia hs
            
        $consulta = "CREATE TABLE `eet16_db`.`asistencia_licencia_permisos_$ciclo` (
          `id_asistenciaLicenciaPermiso` INT NULL AUTO_INCREMENT ,
          `idDocente` text NOT NULL,
          `sexo` text NOT NULL,
          `codigoCargo` text NOT NULL,
          `DescripcionCargo` text NOT NULL,
          `idCurso` text NOT NULL,
          `Turno` text NOT NULL,
          `CantidadHora` text NOT NULL,
          `idAsignatura` text NOT NULL,
          `situacionRevista` text NOT NULL,
          `codigoLicencia` text NOT NULL,
          `articuloLicencia` text NOT NULL,
          `descripcionLicencia` text NOT NULL,
          `codigoPermiso` text NOT NULL,
          `articuloPermiso` text NOT NULL,
          `descripcionPermiso` text NOT NULL,
          `codigoInasistencia` text NOT NULL,
          `articuloInasistencia` text NOT NULL,
          `descripcionInasistencia` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `fechaInasistencia` text NOT NULL,
          `horario` text NOT NULL, PRIMARY KEY (`id_asistenciaLicenciaPermiso`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

        //  Datos Licencia Cargo

        $consulta = "CREATE TABLE `eet16_db`.`asistencia_licencia_permisos_cargos_$ciclo` (
          `id_asistenciaLicenciaPermiso` INT NULL AUTO_INCREMENT ,
          `idDocente` text NOT NULL,
          `sexo` text NOT NULL,
          `codigoCargo` text NOT NULL,
          `DescripcionCargo` text NOT NULL,
          `cargo` text NOT NULL,
          `Turno` text NOT NULL,
          `CantidadHora` text NOT NULL,
          `situacionRevista` text NOT NULL,
          `codigoLicencia` text NOT NULL,
          `articuloLicencia` text NOT NULL,
          `descripcionLicencia` text NOT NULL,
          `codigoPermiso` text NOT NULL,
          `articuloPermiso` text NOT NULL,
          `descripcionPermiso` text NOT NULL,
          `codigoInasistencia` text NOT NULL,
          `articuloInasistencia` text NOT NULL,
          `descripcionInasistencia` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `fechaInasistencia` text NOT NULL,
          `horario` text NOT NULL, PRIMARY KEY (`id_asistenciaLicenciaPermiso`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

        //  Datos Licencia Horas Proyecto

          $consulta = "CREATE TABLE `eet16_db`.`asistencia_licencia_permisos_proyecto_$ciclo` (
          `id_asistenciaLicenciaPermiso` INT NULL AUTO_INCREMENT ,
          `idDocente` text NOT NULL,
          `sexo` text NOT NULL,
          `codigoCargo` text NOT NULL,
          `DescripcionCargo` text NOT NULL,
          `cargo` text NOT NULL,
          `Turno` text NOT NULL,
          `CantidadHora` text NOT NULL,
          `situacionRevista` text NOT NULL,
          `codigoLicencia` text NOT NULL,
          `articuloLicencia` text NOT NULL,
          `descripcionLicencia` text NOT NULL,
          `codigoPermiso` text NOT NULL,
          `articuloPermiso` text NOT NULL,
          `descripcionPermiso` text NOT NULL,
          `codigoInasistencia` text NOT NULL,
          `articuloInasistencia` text NOT NULL,
          `descripcionInasistencia` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `fechaInasistencia` text NOT NULL,
          `horario` text NOT NULL, PRIMARY KEY (`id_asistenciaLicenciaPermiso`))";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();



        //  Llamar datos del Ciclo


    $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `id_ciclo` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

       
    case 3://baja

      

        $consulta = "DELETE FROM `ciclo_lectivo` WHERE `id_ciclo`='$id_ciclo'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

         $consulta = "DROP TABLE `confi_informe_2_$ciclo`,`confi_informe_titulo_2_$ciclo`,`confi_informe_titulo_$ciclo`,`confi_informe_$ciclo`,`inscrip_curso_alumno_$ciclo`, `libreta_digital_$ciclo`,`cabezera_libreta_digital_$ciclo`,`curso_$ciclo`,`asignacion_asignatura_docente_$ciclo`,`datosficha_$ciclo`,`asignaturas_pendientes_$ciclo`,`asistenciadocente_$ciclo`,`asistenciaalumno_$ciclo`,`datoslibreta_$ciclo`,`asistencia_licencia_permisos_$ciclo`,`descripasig_$ciclo`,`asignacion_asignatura_docente_cargo_$ciclo`,`asistencia_licencia_permisos_cargos_$ciclo`,`asignacion_asignatura_docente_proyecto_$ciclo`,`asistenciadocente_cargo_$ciclo`,`asistenciadocente_proyecto_$ciclo`,`asistencia_licencia_permisos_proyecto_$ciclo`";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $data= 1;


        break;        
}


 print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS



}else{

    echo 0;
}
$conexion = NULL;





