<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


////////////////////////////////////      AJAX      ///////////////////////////////////////////////////////////////
if(isset($_POST['cuenta'])): // Busca la descripción, por el número de cuenta
    $descripcion = BDConsulta::consulta('search_descripcion', array($_POST['cuenta']), 'n');
    $desc = utf8_decode($descripcion[0]['descripcion']);
    header("descripcion: " . $desc);
endif;
if(isset($_POST['descripcion'])): // Busca la cuenta, por la descprcion
    $cuenta = BDConsulta::consulta('search_cuenta', array($_POST['descripcion']), 'n');
    header("cuenta: " . $cuenta[0]['cuenta']);
endif;
if(isset($_POST['id_gasto_del']) && !isset($_POST['modify']) ): // Elimina un detalle de tabla secundaria.
    $id_tabla_sec = $_POST['id_gasto_del'];
    $delete_sec = Process::DeleteSec('ger_planificacion_gastos', 'detalle', $id_tabla_sec);
    FormCommon::queryRespHeaderProcess($delete_sec);  // verifica si fue hecha correctamente la consulta
endif;
if(isset($_POST['id_gasto_edit']) ): // Edita un detalle de tabla secundaria
    $id_tabla_sec = $_POST['id_gasto_edit'];
    $update_detalle_inactivo = Process::ModifySec('', 'detalle', $id_tabla_sec, 'n');
    FormCommon::queryRespHeader($update_detalle_inactivo);
endif;



///  Por POST, del FORM  |  Tabla Principal (observaciones)///
if(isset($_POST['agregar'])):
    $observaciones = trim($_POST['observaciones']);
    $id_tabla_proc  = $_POST['id_tabla_proc'];
    $id_tabla   = $_POST['id_tabla'];
    do { // VALIDACIONES
        $validations = Validations::General(array(
                                    array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar observaciones.')
                                    ));
        if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break;
            }
        if(isset($_POST['first_time']) && $_POST['first_time'] == 'true' ) { // 1era VEZ
            $new_process = Process::CreateNewProcess('', $id_user, 'n' );
            if($new_process['error'] == true) {
                $flash_error = $new_process['notice_error'];
                $first_time = 'true'; $tpl->asignar('first_time', $first_time);
                break;
            }
            $id_tabla_proc = $new_process['id_tabla_proc'];     $id_tabla = $new_process['id_tabla'];
            $tpl->asignar('id_tabla_proc', $id_tabla_proc);       $tpl->asignar('id_tabla', $new_process['id_tabla']);
            $update_princ = Process::UpdatePrinc('', $id_tabla, $observaciones, 'n');
            if(isset($update_princ['error']) && $update_princ['error']) {
                $flash_error = $update_princ['notice_error'];
                $first_time = 'true'; $tpl->asignar('first_time', $first_time);
                break;
            }
            $flash_notice = 'Se cargó correctamente';
            $first_time = 'false'; $tpl->asignar('first_time', $first_time);
        }else{ // MODIFICA
            $update_princ = Process::UpdatePrinc('', $id_tabla, $observaciones,  'n');
            if(isset($update_princ['error']) && $update_princ['error']) {
                $flash_error = $update_princ['notice_error'];
                $first_time = 'true'; $tpl->asignar('first_time', $first_time);
                break;
            }
            $flash_notice = 'Registro modificado correctamente';
            $first_time = 'false'; $tpl->asignar('first_time', $first_time);
        }
        } while (0);
endif;





// Agregar gastos en la planificación de gastos.
if(isset($_POST['agregar_gasto'])):
    $cuenta = trim($_POST['cuenta']);
    $descripcion = trim($_POST['descripcion']);
    $detalle = trim($_POST['detalle']);
    $proveedor = trim($_POST['proveedor']);
    $mes = $_POST['mes'];
    $monto = Common::PutDot($_POST['monto']);
    $first_time = $_POST['first_time'];
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_tabla = $_POST['id_tabla'];
    do {
        if($first_time == 'true') { // TODAVIA no llenó la tabla principal
           $flash_error = 'Debe cargar primero las observaciones';
            break;
        }
        $validations = Validations::General(array(
                                array('field' => $detalle, 'null' => false, 'validation' => 'text', 'notice_error' => 'Debe ingresar detalle y/o incorrecto detalles.'),
                                array('field' => $mes, 'null' => false, 'validation' => 'is_month', 'notice_error' => 'Debe ingresar un mes del 01 al 12.'),
                                array('field' => $cuenta, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'No ingresó cuenta o no fue encontrada.',
                                            'table' => 'sis_cuentas.cuenta'),
                                array('field' => $descripcion, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'No ingresó descripción o no fue encontrada.',
                                            'table' => 'sis_cuentas.descripcion'),
                                array('field' => $monto, 'null' => false, 'notice_error' => 'Debe ingresar monto y debe ser númerico'),
                                array('field' => $proveedor, 'null' => false),
                                ));
        if($validations['error'] == true) { // ERROR
           $flash_error = $validations['notice_error'];
           $tpl->asignar('first_time', $first_time);
            break;
        }
        $id_sc = BDConsulta::consulta('search_sis_cuentas', array($cuenta), 'n');
        $id_cuenta = $id_sc[0]['id_sc'];
        $create_sec = Process::CreateSec('ger_planificacion_gastos', 'detalle', $id_tabla_proc); // PREPARO REGISTRO DE TABLA SECUNDARIA
        if($create_sec['error'] == true) { // ERROR
            $flash_error = $create_sec['notice_error'];
            $tpl->asignar('first_time', $first_time);
            break;
        }
        $update_detalle = BDConsulta::consulta('update_detalle', array($create_sec['id_tabla_sec'], $id_cuenta, $detalle, $mes, $monto, $proveedor), 'n');
        if(is_null($update_detalle)) { // ERROR
            $flash_error = 'No pudo ser insertado el nuevo gasto dentro de la Planilla de Gastos.';
            $tpl->asignar('first_time', $first_time);
            break;
        }
        $flash_notice = 'Se creó correctamente el nuevo gasto';
    } while(0);
endif;


// RESET PRINCIPALES
require_once '_php/forms_reset.php';
// Tabla principal
$observaciones = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('observaciones', $observaciones);
// Tabla Secundaria  |  Gastos
$gast_detalles = Process::getTablaSec('', 'detalle', $id_tabla_proc, 'n', 'sis_cuentas', 'cpr_proveedores');
$tpl->asignar('gast_detalles', $gast_detalles);
// MONTOS
$montos = Process::getTablaSecTotal('', 'detalle', $id_tabla_proc, 'monto', 'n');
$tpl->asignar('montos', $montos);
// Select PROVEEDORES
$proveedores = Process::getValuesSelect('cpr_proveedores', 'id_cpr_proveedores', 'nombre', 'n');
$tpl->asignar('proveedores', $proveedores);


$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();
unset($flash_error);
unset($flash_notice);
