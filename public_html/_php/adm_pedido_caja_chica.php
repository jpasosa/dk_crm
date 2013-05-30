<?php


$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_file']) && $_POST['id_file'] > 0):          // ELIMINAR ARCHIVO
        $id_tabla = $_POST['id_file'];
        $del_file = ProcessFiles::DeleteFilePrinc('', 'archivo', $id_tabla);
        FormCommon::queryRespHeader($del_file);        
endif;
if(isset($_POST['cuenta'])):        // BUSCA LA DESCRIPCIÓN POR EL NÚMERO DE CUENTA
        $descripcion = BDConsulta::consulta('search_descripcion', array($_POST['cuenta']), 'n');
        $desc = utf8_decode($descripcion[0]['descripcion']);
        header("descripcion: " . $desc);
        // FormCommon::queryRespHeader($descripcion);
endif;
if(isset($_POST['descripcion'])):   // BUSCA LA CUENTA POR LA DESCRIPCIÓN
        $cuenta = BDConsulta::consulta('search_cuenta', array($_POST['descripcion']), 'n');
        header("cuenta: " . $cuenta[0]['cuenta']);
        // FormCommon::queryRespHeader($descripcion);
endif;
if(isset($_POST['id_gasto_del']) && $_POST['id_gasto_del'] > 0):    // ELIMINAR GASTO
        $delete_sec = Process::DeleteSec('', 'detalle', $_POST['id_gasto_del']);
        FormCommon::queryRespHeader($delete_sec);
endif;
if(isset($_POST['id_gasto_edit']) && $_POST['id_gasto_edit'] > 0):  // MODIFICAR GASTO
        $edit_sec = Process::ModifySec('', 'detalle', $_POST['id_gasto_edit']);
        $area = $_POST['area'];                     $tpl->asignar('area', $area);
        $proveedor = $_POST['proveedor'];   $tpl->asignar('proveedor', $proveedor);
        FormCommon::queryRespHeader($edit_sec);
endif;




///  Por POST, del FORM  |  Tabla Principal (observaciones)///
if(isset($_POST['agregar'])):
    $observaciones = trim($_POST['observaciones']);
    $first_time = $_POST['first_time'];
    $id_tabla_proc  = $_POST['id_tabla_proc'];
    $id_tabla   = $_POST['id_tabla'];     
    do { // VALIDACIONES
           $validations = Validations::General(array(
                                    array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar una observación.')
                                    ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            if($first_time == 'true' ) { // 1era VEZ
                $new_process = Process::CreateNewProcess('', $id_user, 'n' );
                if($new_process['error'] == true) {
                    $flash_error = $new_process['notice_error'];
                    break;
                }
                $id_tabla_proc = $new_process['id_tabla_proc'];     $id_tabla = $new_process['id_tabla'];
                $tpl->asignar('id_tabla_proc', $id_tabla_proc);       $tpl->asignar('id_tabla', $new_process['id_tabla']);
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo cargar el registro.';
                    break;
                }
                $flash_notice = 'Se cargó correctamente';
                $first_time = 'false';
            }else{ // MODIFICA
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo hacer la actualización.';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente';
            }
        } while (0);
        $tpl->asignar('first_time', $first_time);
endif;

///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS.////////////////////////////////// (pertenece también a la tabla principal)
if(isset($_POST['subir_archivo'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'):
                $flash_error = 'Debe cargar primero observaciones.';
                break;
        endif;
        $file = $_FILES['archivo'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'archivo', $id_tabla, $file, 'n', true);
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;




///////////////////////////////// AGREGAR TABLA SECUNDARIA (gastos) |  POST 
if(isset($_POST['agregar_gasto'])):
    $cuenta = trim($_POST['cuenta']);
    $descripcion = trim($_POST['descripcion']);
    $detalle = trim($_POST['detalle']);
    $proveedor = trim($_POST['proveedor']);
    $factura = trim($_POST['factura']);
    $monto = Common::PutDot($_POST['monto']);
    $area = trim($_POST['area']);
    $first_time = $_POST['first_time'];
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_tabla = $_POST['id_tabla'];
    do {
        if($first_time == 'true') {
            $flash_error = 'Debe ingresar antes las observaciones.';
            break;
        }
        $validations = Validations::General(array(
                                array('field' => $detalle, 'null' => false, 'validation' => 'text', 'notice_error' => 'Debe ingresar detalle y/o incorrecto detalles.'),
                                array('field' => $factura, 'null' => false, 'validation' => 'text', 'notice_error' => 'Debe ingresar la factura.'),
                                array('field' => $cuenta, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'No ingresó cuenta o no fue encontrada.',
                                            'table' => 'sis_cuentas.cuenta'),
                                array('field' => $descripcion, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'No ingresó descripción o no fue encontrada.',
                                            'table' => 'sis_cuentas.descripcion'),
                                array('field' => $proveedor, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar proveedor válido',
                                            'table' => 'crp_proveedores.id_crp_proveedores'),
                                array('field' => $area, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar área válida',
                                            'table' => 'sis_areas.id_sis_areas')
                                ));
        if($validations['error'] == true) {
           $flash_error = $validations['notice_error'];
            break; 
        }
        $tabla_sec = Process::CreateSec('', 'detalle', $id_tabla_proc, 'n');
        if($tabla_sec['error'] == true) {
            $flash_error = $tabla_sec['notice_error'];
            break;
        }
        $id_tabla_sec = $tabla_sec['id_tabla_sec'];
        $id_sc = BDConsulta::consulta('search_sis_cuentas', array($cuenta), 'n');
        $id_sis_cuenta = $id_sc[0]['id_sc'];
        $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $id_sis_cuenta, $detalle, $factura, $area, $monto, $proveedor), 'n');
        if(is_null($update_tabla_sec)) {
            $flash_error = 'No pudo insertar el gasto.';
            break;  
        }
        $flash_notice = 'Nuevo gasto agregado correctamente.';
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;



// RESET PRINCIPALES
require_once '_php/forms_reset.php';
// TABLA PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// NOMBRE DE ARCHIVOS CARGADOS
$files = BDConsulta::consulta('get_file', array($id_tabla), 'n');
$file = $files[0]['archivo'];
$tpl->asignar('file', $file);
// SELECT DE PROVEEDOR
$proveedores = Process::getValuesSelect('crp_proveedores', 'id_crp_proveedores', 'nombre', 'n');
$tpl->asignar('proveedores', $proveedores);
// SELECT DE AREA
$areas = Process::getValuesSelect('sis_areas', 'id_sis_areas', 'area', 'n');
$tpl->asignar('sel_area', $areas);
// TABLA SECUNDARIA (los gastos)
$gast_detalles = Process::getTablaSec('', 'detalle', $id_tabla_proc, 'n', 'sis_cuentas', 'crp_proveedores', 'sis_areas');
$tpl->asignar('tabla_sec', $gast_detalles);
// MONTO TOTAL
$monto_total = Process::getTablaSecTotal('', 'detalle', $id_tabla_proc, 'monto');
if(isset($monto_total['error']) && $monto_total['error'] == true) {
    $monto_total = 0.00;
}else{
    $monto_total = $monto_total['monto_total'];    
}
$tpl->asignar('monto_total', $monto_total);
// MENSAJES FLASH
$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
// LEVANTO VISTA
$tpl->obtenerPlantilla();

