<?php
$tpl = new PlantillaReemplazos();
require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_client']) && $_POST['id_client'] > 0):  // ELIMINAR cliente
        $id_client = $_POST['id_client'];
        $elim_cliente = Process::DeleteSec('', 'clientes', $id_client);
        FormCommon::queryRespHeader($elim_cliente);
endif;
if(isset($_POST['id_gasto_del']) && $_POST['id_gasto_del'] > 0): // ELIMINAR gastos
        $id_gasto_del = $_POST['id_gasto_del'];
        $delete_sec = Process::DeleteSec('', 'gastos', $id_gasto_del);
        FormCommon::queryRespHeader($delete_sec);
endif;
if(isset($_POST['id_gasto_edit']) && $_POST['id_gasto_edit'] > 0): // EDITAR gastos
        $id_gasto_edit = $_POST['id_gasto_edit'];
        $edit_sec = Process::ModifySec('', 'gastos', $id_gasto_edit);
        FormCommon::queryRespHeader($delete_sec);
endif;

///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  fecha_inicio, fecha_fin, observaciones   |  POST
if(isset($_POST['agregar_fechas'])):
        $observaciones = trim($_POST['observaciones']);                                  
        $fecha_inicio = trim($_POST['fecha_inicio']);     
        $fecha_fin = trim($_POST['fecha_fin']);
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                    array('field' => $observaciones, 'null' => false, 'validation' => 'text', 'notice_error' => 'Debe ingresar las observaciones.'),
                                    array('field' => $fecha_inicio, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha de inicio es incorrecta y/o falta agregar.'),
                                    array('field' => $fecha_fin, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha de finalización es incorrecta y/o falta agregar.')
                                    ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            $fecha_inicio_unix = Dates::ConvertToUnix($fecha_inicio);
            $fecha_fin_unix = Dates::ConvertToUnix($fecha_fin);
            if($fecha_inicio_unix > $fecha_fin_unix) {
                $flash_error = 'La fecha de inicio debe ser menor que la fecha de finalización';
                break;
            }
            if(isset($_POST['first_time']) && $_POST['first_time'] == 'true' ) { // Primera VEZ
                $new_process = Process::CreateNewProcess('', $id_user);
                if($new_process['error'] == true) {
                    $flash_error = 'No pudo agregar el registro principal';
                    $first_time = 'true';
                    break;    
                }
                $flash_notice = $new_process['notice_success'];
                $id_tabla = $new_process['id_tabla'];
                $id_tabla_proc = $new_process['id_tabla_proc'];
                $tpl->asignar('id_tabla', $id_tabla);
                $tpl->asignar('id_tabla_proc', $id_tabla_proc);
                $update_princ = Process::UpdatePrinc('', $id_tabla, $observaciones);
                if($update_princ['error'] == true) {
                    $flash_error = $update_princ['notice_error'];
                    $first_time = 'true';
                    break;
                }
                $update_fechas = BDConsulta::consulta('update_fechas', array($id_tabla_proc, $id_tabla, $fecha_inicio_unix, $fecha_fin_unix, $observaciones), 'n');
                if(is_null($update_fechas)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    $first_time = 'true';
                    break;    
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $fecha_inicio_unix = Dates::ConvertToUnix($fecha_inicio);
                $fecha_fin_unix = Dates::ConvertToUnix($fecha_fin);
                $update_fechas = BDConsulta::consulta('update_fechas', array($id_tabla_proc, $id_tabla, $fecha_inicio_unix, $fecha_fin_unix, $observaciones), 'n');
                if(is_null($update_fechas)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                    $first_time = 'true';
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }
        }while(0);
        $tpl->asignar('first_time', $first_time);
        $tpl->asignar('id_tabla', $id_tabla);
        $tpl->asignar('id_tabla_proc', $id_tabla_proc);
endif;


///////////////////////////////// AGREGAR GASTOS |  POST 
if(isset($_POST['agregar_ref'])):
        $referencia = trim($_POST['referencia']);                           
        $detalle = trim($_POST['detalle']);     
        $monto = Common::PutDot($_POST['monto']);
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes, observaciones, fecha de inicio y fin';
                break;  
            }
            $validations = Validations::General(array(
                                        array('field' => $referencia, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar la referencia.', 'table' => 'sis_gastos_viajes.id_sis_gastos_viajes'),
                                        array('field' => $detalle, 'null' => false, 'validation' => 'text', 'notice_error' => 'Debe agregar detalle.'),
                                        array('field' => $monto, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'El monto falta y/o debe ser númerico')
                                        ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            $tabla_sec = Process::CreateSec('', 'gastos', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
            $update_tabla_sec = BDConsulta::consulta('update_gasto', array($id_tabla_sec, $referencia, $detalle, $monto), 'n');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el gasto.';
                break;  
            }
            $flash_notice = 'Nuevo gasto agregado correctamente.';
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;



///////////////////////////////// AGREGAR CLIENTES  |   POST
// Agregar clientes
if(isset($_POST['agregar_cliente']) && $_POST['cliente']) {
    $client_suc_id = $_POST['cliente'];
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_tabla = $_POST['id_tabla'];
    $first_time = $_POST['first_time'];
    do{
        if($first_time == 'true') { // TODAVIA no llenó la tabla principal
           $flash_error = 'Debe ingresar antes, observaciones, fecha de inicio y fin';
            break;  
        }
        $existClient = BDConsulta::consulta('comprobar_cliente', array($id_tabla_proc, $client_suc_id), 'n'); // debe comprobar que dicho cliente no esté ya agregado en el proceso actual
        if(!is_null($existClient)) {
            $flash_error = 'El cliente seleccionado ya está agregado.';
            break;
        }
        $insert_cliente = BDConsulta::consulta('insert_cliente', array($id_tabla_proc, $client_suc_id), 'n');
        if(is_null($insert_cliente)) {
            $flash_error = "El cliente no pudo ser agregado.";
            break;
        }
        $flash_notice = "El cliente fue agregado correctamente.";
    }while(0);
    $tpl->asignar('first_time', $first_time);
}


// RESET PRINCIPALES
require_once '_php/forms_reset.php';



// $last_id = BDConsulta::consulta('lastId_ven_solicitud_viaticos_viajes', '', 'n');
// $id_ven_solicitud_viaticos_viajes = $last_id[0]['id']; // tengo ultimo id de ven_solicitud_viaticos_viajes
// $tpl->asignar('id_ven_solicitud_viaticos_viajes', $id_ven_solicitud_viaticos_viajes);
// ultimo id de los procesos
// $id_tabla_proc = $id_ven_solicitud_viaticos_viajes_proc = $last_id[0]['id_proc'];
// $tpl->asignar('id_tabla_proc', $id_tabla_proc);

// $select_fechas_observ = BDConsulta::consulta('select_fechas_oberv', array($id_ven_solicitud_viaticos_viajes), 'n');
// $tpl->asignar('fechas_ob', $select_fechas_observ);



 // Select CLIENTES
$clientes_show = BDConsulta::consulta('clientes_habilitados_show', '', 'n');
$tpl->asignar('clientes_show', $clientes_show);
// CLIENTES seleccionados
$clientes = BDConsulta::consulta('clientes_en_proceso_full', array($id_tabla_proc), 'n'); // clientes en el proceso
$tpl->asignar('clientes', $clientes); 
// MONTOS
$suma_de_montos = BDConsulta::consulta('suma_de_montos', array($id_tabla_proc), 'n'); // clientes en el proceso
$tpl->asignar('suma_de_montos', $suma_de_montos);
// Tabla PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// Select de REFERENCIAS
$referencias = BDConsulta::consulta('referencias_show', '', 'n'); 
$tpl->asignar('referencias', $referencias);
// Tabla Secundaria  |  Gastos
$clientes_gastos = BDConsulta::consulta('clientes_gastos', array($id_tabla_proc), 'n'); // clientes en el proceso
$tpl->asignar('clientes_gastos', $clientes_gastos);



$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);




