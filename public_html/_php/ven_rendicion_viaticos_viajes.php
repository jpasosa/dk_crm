<?php
if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL

$tpl = new PlantillaReemplazos();

// obtengo id_tabla_proc_solicitud | id_tabla_solicitud
$id_tabla_proc_solicitud = $_GET[1];
$register = Process::getTabla('ven_solicitud_viaticos_viajes', $id_tabla_proc_solicitud, 'n');
$id_tabla_solicitud = $register[0]['id_ven_solicitud_viaticos_viajes'];
$tpl->asignar('id_tabla_proc_solicitud', $id_tabla_proc_solicitud);
$tpl->asignar('id_tabla_solicitud', $id_tabla_solicitud);


$flash_error = '';$flash_notice = '';$detalle = '';$reload = false;$fecha_inicio='';$fecha_fin=''; $break = false;
// if(!isset($new_observacion)) {
//     $new_observacion = 'true';    
// }
$id_user = Common::isLogin();

if(isset($_POST['enviar'])):    // ENVIAR FORMULARIO
        $send = ProcessSends::toNextProcess('', $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
        if($send['error'] == false) {
            header('Location: /enviado.html');
            exit();    
        }
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
endif;
if(!isset($_SESSION['primer_proceso_creado'])) {
    $_SESSION['primer_proceso_creado'] = false;
}


///////////////////////////////////////      AJAX      ////////////////////////////////////////
// ELIMINAR gastos
if(isset($_POST['id_gasto_del']) && $_POST['id_gasto_del'] > 0):
        $id_gasto_del = $_POST['id_gasto_del'];
        $delete_sec = Process::DeleteSec('ven_rendicion_viaticos_viajes', 'gast', $id_gasto_del);
        FormCommon::queryRespHeader($delete_sec);
endif;
// EDITAR gastos
if(isset($_POST['id_gasto_edit']) && $_POST['id_gasto_edit'] > 0):
        $id_gasto_edit = $_POST['id_gasto_edit'];
        $edit_sec = Process::ModifySec('', 'gast', $id_gasto_edit);
        FormCommon::queryRespHeader($edit_sec);
endif;





/////// COPIO TODOS LOS DATOS DE SOLICITUD DE VIATICOS VIAJES EN VEN_RENDICION_VIATICOS_VIAJES /////////
if($_SESSION['primer_proceso_creado'] == false):
        do {
            $new_process = Process::CreateNewProcess('', $id_user);
            if($new_process['error'] == true) {
                $flash_error = 'No pudo agregar el registro principal';
                break;    
            }
            $id_tabla = $new_process['id_tabla'];
            $id_tabla_proc = $new_process['id_tabla_proc'];
            $get_tabla_solicitud = Process::getTabla('ven_solicitud_viaticos_viajes', $id_tabla_proc_solicitud, 'n');
            if(isset($get_tabla_solicitud['error']) && $get_tabla_solicitud['error'] == true) {
                $flash_error = 'error';
                break;    
            }
            $fecha_inicio = $get_tabla_solicitud[0]['fecha_inicio'];
            $fecha_fin = $get_tabla_solicitud[0]['fecha_fin'];
            $observaciones = $get_tabla_solicitud[0]['observaciones'];
            $update_tabla = BDConsulta::consulta('update_tabla', array($id_tabla, $fecha_inicio, $fecha_fin, $observaciones), 'n');
            if($update_tabla == null) {
                $flash_error = 'error';
                break;
            }
            // Cargo los GASTOS de ven_solicitud_viaticos_viajes
            $get_tabla_sec_gastos = Process::getTablaSec('ven_solicitud_viaticos_viajes', 'gastos', $id_tabla_proc_solicitud, 'n');
            if($get_tabla_sec_gastos == null) {
                $flash_error = 'error';
                break;
            }
            foreach($get_tabla_sec_gastos as $gastos) {
                $detalle = $gastos['detalle'];
                $monto = $gastos['monto'];
                $id_sis_gastos_viajes = $gastos['id_sis_gastos_viajes'];
                $insert_tabla_gastos = BDConsulta::consulta('insert_tabla_gastos', array($id_tabla_proc, $detalle, $monto, $id_sis_gastos_viajes), 'n');
                if($insert_tabla_gastos == null){
                    $flash_error = 'error';
                    $break = true;
                    break;
                }
            }
            if($break)  break;
            // Cargo los CLIENTES de ven_solicitud_viaticos_viajes
            $get_tabla_sec_clientes = Process::getTablaSec('ven_solicitud_viaticos_viajes', 'clientes', $id_tabla_proc_solicitud, 'n');
            if($get_tabla_sec_clientes == null) {
                $flash_error = 'error';
                break;
            }
            foreach($get_tabla_sec_clientes as $clientes) {
                $id_ven_cliente_sucursales = $clientes['id_ven_cliente_sucursales'];
                $insert_tabla_clientes = BDConsulta::consulta('insert_tabla_clientes', array($id_tabla_proc, $id_ven_cliente_sucursales), 'n');
                if($insert_tabla_clientes == null){
                    $flash_error = 'error';
                    $break = true;
                    break;
                }
            }
            if($break)  break;
            
        }while(0);
endif;



///////////////////////////////// AGREGAR GASTOS |  POST /////////////////////////////////////////////////////
if(isset($_POST['agregar_ref'])):
    $referencia = trim($_POST['referencia']);                           
    $detalle = trim($_POST['detalle']);     
    $monto_real = Common::PutDot($_POST['monto']);
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_tabla = $_POST['id_tabla'];
    $id_tabla_proc_solicitud = $_POST['id_tabla_proc_solicitud'];
    do {
        $validations = Validations::General(array(
                                        array('field' => $referencia, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar la referencia.', 'table' => 'sis_gastos_viajes.id_sis_gastos_viajes'),
                                        array('field' => $monto_real, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'El monto falta y/o debe ser númerico'),
                                        array('field' => $detalle, 'null' => false, 'validation' => 'text', 'notice_error' => 'Debe agregar detalle.'),
                                        ));
        if($validations['error'] == true) {
           $flash_error = $validations['notice_error'];
            break; 
        }
        $tabla_sec = Process::CreateSec('', 'gast', $id_tabla_proc, 'n');
        if($tabla_sec['error'] == true) {
            $flash_error = $tabla_sec['notice_error'];
            break;
        }
        $id_tabla_sec = $tabla_sec['id_tabla_sec'];
        $update_tabla_sec = BDConsulta::consulta('update_gasto', array($id_tabla_sec, $referencia, $detalle, $monto_real), 'n');
        if(is_null($update_tabla_sec)) {
            $flash_error = 'No puedo insertar la referencia en la base de datos. Vuelva a intentarlo.';
            break;
        }
        $flash_notice = 'Nuevo gasto agregado correctamente';
    }while(0);
endif;



///////////  Por POST, del FORM  |  SUBIDA DE ARCHIVOS.//////////////////////////////////
if(isset($_POST['subir_archivo'])):
        $id_tabla_gastos = $_POST['id_tabla_gast'];
        $file = $_FILES['archivo'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOne('', 'gast', 'archivo', $id_tabla_gastos, $file, 'n');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
        }else{
            $flash_notice = $file_upload['notice_success'];
        }
endif;


///////////  Por POST, del FORM  |  MONTO REAL.//////////////////////////////////
if(isset($_POST['agregar_monto'])):
        $id_tabla_gastos = $_POST['id_tabla_gast'];
        $monto_real = $_POST['monto_real'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        $update_monto_real = BDConsulta::consulta('update_monto_real', array($id_tabla_gastos, Common::PutDot($monto_real)), 'n');
        if(is_null($update_monto_real)) {
            $flash_error = 'No pudo actualizar el Monto Real';
        }else{
            $flash_notice = 'Monto Real actualizado correctamente.';
        }
endif;






// RESET PRINCIPALES
$nombre_empleado = BDConsulta::consulta('empleado_nombres', array($id_user), 'n');
$nombres = $nombre_empleado[0]['nombre'] . ', ' . $nombre_empleado[0]['apellido'];
$tpl->asignar('nombre_empleado', $nombres);
if(!isset($id_tabla_proc))  $id_tabla_proc = -10;
if(!isset($id_tabla))           $id_tabla = -10;
$tpl->asignar('id_tabla_proc', $id_tabla_proc); // id del tabla_proc
$tpl->asignar('id_tabla', $id_tabla); // id del tabla_proc
$tpl->asignar('date', date('d/m/Y'));



// CLIENTES
$get_tabla_sec_clientes = Process::getTablaSec('', 'clientes', $id_tabla_proc, 'n', 'ven_cliente_sucursales', '', '', 'ven_cliente', 'sis_provincia', 'sis_pais');
$tpl->asignar('tabla_sec_clientes', $get_tabla_sec_clientes);

// MONTOS
$suma_de_montos = BDConsulta::consulta('suma_de_montos', array($id_tabla_proc_solicitud), 'n');
$tpl->asignar('suma_de_montos', $suma_de_montos);

// TABLA PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);

// GASTOS
$get_tabla_sec_gastos = Process::getTablaSec('', 'gast', $id_tabla_proc, 'n', 'sis_gastos_viajes');
foreach($get_tabla_sec_gastos AS $k => $gast) { // Agrego la diferencia para que muestre en la vista.
    if($gast['monto_real'] == null) $gast['monto_real'] = 0;
    $diferencia = $gast['monto_real'] - $gast['monto'];
    $get_tabla_sec_gastos[$k]['diferencia'] = $diferencia;
}
$tpl->asignar('tabla_sec_gastos', $get_tabla_sec_gastos);

// select de referencias
$referencias = Process::getValuesSelect('sis_gastos_viajes', 'id_sis_gastos_viajes', 'referencia', 'n');
$tpl->asignar('referencias', $referencias); 




$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);


else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
    header('Location: /menu.html');
    exit();
endif;

