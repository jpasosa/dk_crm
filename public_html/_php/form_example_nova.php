<?php
$tpl = new PlantillaReemplazos();
$flash_error = '';$flash_notice = '';$detalle = '';$reload = false;
if(!isset($new_observacion)) {
    $new_observacion = 'true';    
}

$id_user = Common::isLogin();


if(isset($_POST['enviar'])) { // ENVIAR FORMULARIO
    $send = ProcessSends::toNextProcess('', $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
    if($send['error'] == false) {
        header('Location: /enviado.html');
        exit();    
    }
    $id_tabla = $_POST['id_tabla'];
    $id_tabla_proc = $_POST['id_tabla_proc'];
}

// si no existe esta variable de sesion la crea.
if(!isset($_SESSION['primer_proceso_creado'])) {
    $_SESSION['primer_proceso_creado'] = false;
}





////////////////////////////////////      AJAX      ///////////////////////////////////////////////////////////////

// Busca la descripción, por el número de cuenta
if(isset($_POST['cuenta']))    {
    $descripcion = BDConsulta::consulta('search_descripcion', array($_POST['cuenta']), 'n');
    $desc = utf8_decode($descripcion[0]['descripcion']);
    header("descripcion: " . $desc);
    // FormCommon::queryRespHeader($descripcion);  // verifica si fue hecha correctamente la consulta
}

// Busca la cuenta, por la descrpcion
if(isset($_POST['descripcion']))    {
    $cuenta = BDConsulta::consulta('search_cuenta', array($_POST['descripcion']), 'n');
    header("cuenta: " . $cuenta[0]['cuenta']);
    // FormCommon::queryRespHeader($descripcion);  // verifica si fue hecha correctamente la consulta
}

// Elimina un detalle de tabla secundaria.
if(isset($_POST['id_gasto_del']) && !isset($_POST['modify']) )    {
    $id_tabla_sec = $_POST['id_gasto_del'];
    $delete_sec = Process::DeleteSec('ger_planificacion_gastos', 'detalle', $id_tabla_sec);
    FormCommon::queryRespHeaderProcess($delete_sec);  // verifica si fue hecha correctamente la consulta
}

// Edita un detalle de tabla secundaria
if(isset($_POST['modify']) )    {
    $id_tabla_sec = $_POST['id_gasto_del'];
    // Process::ModifySec('ger_planificacion_gastos', 'detalle', $id_tabla_sec)
    $update_detalle_inactivo = BDConsulta::consulta('update_detalle_inactivo', array('ger_planificacion_gastos', 'detalle', $id_tabla_sec), 'n');
    FormCommon::queryRespHeader($update_detalle_inactivo);  // verifica si fue hecha correctamente la consulta
}
////////////////////////////////////     FIN  AJAX      ///////////////////////////////////////////////////////////////


/// Agregar la observación. 
if(isset($_POST['agregar_observaciones']) && isset($_POST['id_tabla_proc']) && isset($_POST['observaciones'])) {
    // Y si es la primera vez que guardamos la observación, debe antes crear los registros para guardar.
    if(!$_SESSION['primer_proceso_creado']) {
        $new_process = Process::CreateNewProcess('', $id_user, 'n' );
        if($new_process['error'] == false) {
            $flash_notice = $new_process['notice_success'];
            $_SESSION['id_tabla'] = $new_process['id_tabla'];
            $_SESSION['id_tabla_proc'] = $new_process['id_tabla_proc'];
            $tpl->asignar('id_tabla', $_SESSION['id_tabla']);
            $tpl->asignar('id_tabla_proc', $_SESSION['id_tabla_proc']);
            $observacion = trim($_POST['observaciones']);
            $id_tabla_proc = $new_process['id_tabla_proc'];
            $id_tabla = $new_process['id_tabla'];
            $update_princ = Process::UpdatePrinc('', $id_tabla, $observacion, 'n');
            // $insert_observaciones = BDConsulta::consulta('seteo_observaciones', array($id_tabla, $observacion), 'n');
            if($update_princ['error'] == false) {
                $flash_notice = $update_princ['notice_success'];
                $new_observacion = 'false'; 
                $tpl->asignar('new_observacion', $new_observacion);
            }else {
                $flash_error = $update_princ['notice_error'];
                $new_observacion = 'true'; 
                $tpl->asignar('new_observacion', $new_observacion);    
            }
        }
    // $id_tabla_proc = $_POST['id_proccess'];
    // $id_tabla = $_POST['id_tabla'];
    }
}


/// Modificar la observación
if(isset($_POST['modificar_observaciones']) && isset($_POST['id_tabla_proc']) && isset($_POST['observaciones'])) {
    $observacion = trim($_POST['observaciones']);
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_tabla = $_POST['id_tabla'];    
    $update_princ = Process::UpdatePrinc('', $id_tabla, $observacion,  'n'); // hace un update de tabla principal. solo de observaciones.
    if($update_princ['error'] == false) { // si no hubo errores.
        $flash_notice = $update_princ['notice_success'];
        $new_observacion = 'false';
    }
    $id_tabla_proc = $_POST['id_tabla_proc'];  
    $id_tabla = $_POST['id_tabla'];    
}



// Agregar gastos en la planificación de gastos. 
if(isset($_POST['cuenta']) && isset($_POST['descripcion']) && isset($_POST['detalle']) && isset($_POST['proveedor'])
    && isset($_POST['mes']) && isset($_POST['monto']) && isset($_POST['id_tabla_proc']))
    {
    
    $cuenta = trim($_POST['cuenta']);                                  
    $descripcion = trim($_POST['descripcion']);     
    $detalle = trim($_POST['detalle']);                     
    $proveedor = trim($_POST['proveedor']);        
    $mes = $_POST['mes'];                                    
    $monto = Common::PutDot($_POST['monto']);
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_tabla = $_POST['id_tabla'];
    do { // algunas validaciones e inserta el detalle del gasto si todo está bien.
        if($id_tabla_proc == -10) { // TODAVIA no llenó la tabla principal
           $flash_error = 'Debe cargar primero las observaciones';
            break;  
        }
        $new_observacion = 'false';    
        $validations = Validations::General(array(
                                array('field' => $_POST['detalle'], 'null' => false, 'validation' => 'text', 'notice_error' => 'Debe ingresar detalle y/o incorrecto detalles.'),
                                array('field' => $_POST['mes'], 'null' => false, 'validation' => 'is_month', 'notice_error' => 'Debe ingresar un mes del 01 al 12.'),
                                array('field' => $_POST['cuenta'], 'null' => false, 'validation' => 'field_search', 'notice_error' => 'No ingresó cuenta o no fue encontrada.',
                                            'table' => 'sis_cuentas.cuenta'),
                                array('field' => $_POST['descripcion'], 'null' => false, 'validation' => 'field_search', 'notice_error' => 'No ingresó descripción o no fue encontrada.',
                                            'table' => 'sis_cuentas.descripcion'),
                                array('field' => $_POST['monto'], 'null' => false, 'notice_error' => 'Debe ingresar monto y debe ser númerico'),
                                array('field' => $_POST['proveedor'], 'null' => false),
                                ));
        if($validations['error'] == true) {
           $flash_error = $validations['notice_error'];
            break; 
        }

        $id_sc = BDConsulta::consulta('search_sis_cuentas', array($cuenta), 'n');
        $id_cuenta = $id_sc[0]['id_sc'];

        $create_sec = Process::CreateSec('ger_planificacion_gastos', 'detalle', $id_tabla_proc); // PREPARO REGISTRO DE TABLA SECUNDARIA
        if($create_sec['error'] == true) { // si hubo error.
            $flash_error = $create_sec['notice_error'];
            break;
        }
        $update_detalle = BDConsulta::consulta('update_detalle', array($create_sec['id_tabla_sec'], $id_cuenta, $detalle, $mes, $monto, $proveedor), 'n');
        if(is_null($update_detalle)) { // comprueba que haya hecho el insert
            $flash_error = 'No pudo ser insertado el nuevo gasto dentro de la Planilla de Gastos.';
            break;
        }
        $flash_notice = 'Se creó correctamente el nuevo gasto';
        $cuenta = '';                                  
        $descripcion = '';     
        $detalle = '';                     
        $proveedor = '';        
        $mes = '';                                    
        $monto = '';                             
    } while(0);
    
    $tpl->asignar('cuenta', $cuenta);
    $tpl->asignar('descripcion', $descripcion);
    $tpl->asignar('detalle', $detalle);
    $tpl->asignar('proveedor', $proveedor);
    $tpl->asignar('mes', $mes);
    $tpl->asignar('monto', $monto);
    $tpl->asignar('new_observacion', $new_observacion);
} ///////////////////////////////// FIN DE Agregar gastos de hoteles. Por POST, del FORM. //////////////////////////////////



// NOMBRE EMPLEADO
$nombre_empleado = BDConsulta::consulta('empleado_nombres', array($id_user), 'n');
$nombres = $nombre_empleado[0]['nombre'] . ', ' . $nombre_empleado[0]['apellido'];
$tpl->asignar('nombre_empleado', $nombres);
// aquí por si hace un reload de la pagina, después de que ya había creado los formularios. . .
if(!isset($id_tabla_proc)) {
    $id_tabla_proc = -10;
}
if(!isset($id_tabla)) {
    $id_tabla = -10;
}
$tpl->asignar('id_tabla_proc', $id_tabla_proc);
$tpl->asignar('id_tabla', $id_tabla);



// suma de los montos
// $suma_de_montos = BDConsulta::consulta('suma_de_montos', array($id_tabla_proc), 's'); // clientes en el proceso
$montos = Process::getTablaSecTotal('ger_planificacion_gastos', 'detalle', $id_tabla_proc, 'monto', 'n');
$tpl->asignar('montos', $montos);


// Tabla principal
// $observaciones = BDConsulta::consulta('get_observaciones', array($id_tabla), 'n');
$observaciones = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('observaciones', $observaciones);

// Los gasto de la planilla
// $gast_detalles = BDConsulta::consulta('planificacion_gastos_detalle', array($id_tabla_proc), 'n');
$gast_detalles = Process::getTablaSec('', 'detalle', $id_tabla_proc, 'n', 'sis_cuentas', 'crp_proveedores');
$tpl->asignar('gast_detalles', $gast_detalles);


// Para el select de los proveedores
$proveedores = Process::getValuesSelect('crp_proveedores', 'id_crp_proveedores', 'nombre', 'n');
$tpl->asignar('proveedores', $proveedores);

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);

$tpl->asignar('new_observacion', $new_observacion);

$tpl->obtenerPlantilla();

unset($flash_error);
unset($flash_notice);






