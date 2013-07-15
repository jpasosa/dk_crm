<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';
if(!isset($reg_sec_nuevo))  $reg_sec_nuevo = true; // cuando comienza un registro secundario nuevo. en este caso los productos. . . .
if(!isset($actual_key))  $actual_key = 0; // cuando comienza un registro secundario nuevo. en este caso los productos. . . .


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_detalle_del']) && $_POST['id_detalle_del'] > 0):  // ELIMINAR un detalle
        $id_detalle_del = $_POST['id_detalle_del'];
        $del_tabla_sec = Process::DeleteSec('', 'detalle', $id_detalle_del);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;

if(isset($_POST['id_detalle_edit']) && $_POST['id_detalle_edit'] > 0): // EDITAR  item tabla secundaria
        $id_detalle_edit = $_POST['id_detalle_edit'];
        $edit_tabla_sec = Process::ModifySec('', 'detalle', $id_detalle_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;

///////////////////////////////// AGREGAR PRODUCTOS |  POST
if(isset($_POST['agregar_prod'])):
        $nombre = $_POST['nombre'];
        $nombre_pedido = $_POST['nombre_pedido'];
        $detalle = $_POST['detalle'];
        $cantidad = $_POST['cantidad'];
        $observaciones = $_POST['observaciones'];
        $precio_deseado = Common::PutDot($_POST['precio_deseado']);
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_sec = $_POST['id_tabla_sec'];
        $actual_key = $_POST['actual_key'];
        do {
            $validations = Validations::General(array(
                                        array('field' => $precio_deseado, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'El precio deseado no es correcto y/o no fue ingresado.'),
                                        array('field' => $nombre, 'null' => false, 'notice_error' => 'El detalle no fue ingresado.'),
                                        array('field' => $detalle, 'null' => false, 'notice_error' => 'Debe ingresar el detalle.'),
                                        array('field' => $cantidad, 'null' => false, 'notice_error' => 'Debe ingresar la cantidad.'),
                                        array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar las observaciones.'),
                                        ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break;
            }
            if($first_time == 'true'){ // Si es la primera vez, debe crear tabla principal
                $new_process = Process::CreateNewProcess('', $id_user, 's');
                if($new_process['error'] == true) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $id_tabla = $new_process['id_tabla'];
                $id_tabla_proc = $new_process['id_tabla_proc'];
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $nombre_pedido), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $tabla_sec = Process::CreateSec('', 'prod', $id_tabla_proc, 'n');
                if($tabla_sec['error'] == true) {
                    $flash_error = $tabla_sec['notice_error'];
                    break;
                }
                $id_tabla_sec = $tabla_sec['id_tabla_sec'];
                $first_time = 'false';
            }
            if($id_tabla_sec == -10) {
                $tabla_sec = Process::CreateSec('', 'prod', $id_tabla_proc, 'n');
                if($tabla_sec['error'] == true) {
                    $flash_error = $tabla_sec['notice_error'];
                    break;
                }
                $id_tabla_sec = $tabla_sec['id_tabla_sec'];
            }
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $nombre, $detalle, $cantidad, $precio_deseado, $observaciones), 's');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el detalle.';
                break;
            }
            $id_tabla_sec = -10; // lo pone en -10, para que sepa que tiene que empezar otro registro secundario nuevo
            $flash_notice = 'Nuevo producto agregado correctamente.';
            $actual_key++;
        }while(0);
        $tpl->asignar('first_time', $first_time);
        $tpl->asignar('id_tabla', $id_tabla);
        $tpl->asignar('id_tabla_sec', $id_tabla_sec);
        $tpl->asignar('id_tabla_proc', $id_tabla_proc);
endif;



///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS.////////////////////////////////// (pertenece también a la tabla principal)
if(isset($_POST['subir_archivo'])):
    $nombre_pedido = $_POST['nombre_pedido'];
    $first_time = $_POST['first_time'];
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_tabla = $_POST['id_tabla'];
    $id_tabla_sec = $_POST['id_tabla_sec'];
    $actual_key = $_POST['actual_key'];
    do {
        if($first_time == 'true'){ // Si es la primera vez, debe crear tabla principal
                $new_process = Process::CreateNewProcess('', $id_user, 's');
                if($new_process['error'] == true) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $id_tabla = $new_process['id_tabla'];
                $id_tabla_proc = $new_process['id_tabla_proc'];
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $nombre_pedido), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $tabla_sec = Process::CreateSec('', 'prod', $id_tabla_proc, 'n');
                if($tabla_sec['error'] == true) {
                    $flash_error = $tabla_sec['notice_error'];
                    break;
                }
                $id_tabla_sec = $tabla_sec['id_tabla_sec'];
                $first_time = 'false';
        }
        if($id_tabla_sec == -10) {
            $tabla_sec = Process::CreateSec('', 'prod', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
        }
        $file = $_FILES['archivo'];
        if(Process::isEmptyColumn('', 'prod', 'archivo_1', $id_tabla_sec, 's')) {
            $campo = 'archivo_1';
        }elseif(Process::isEmptyColumn('', 'prod', 'archivo_2', $id_tabla_sec, 's')) {
            $campo = 'archivo_2';
        }elseif(Process::isEmptyColumn('', 'prod', 'archivo_3', $id_tabla_sec, 's')) {
            $campo = 'archivo_3';
        }elseif(Process::isEmptyColumn('', 'prod', 'archivo_4', $id_tabla_sec, 's')) {
            $campo = 'archivo_4';
        }elseif(Process::isEmptyColumn('', 'prod', 'archivo_5', $id_tabla_sec, 's')) {
            $campo = 'archivo_5';
        }else{
            $flash_error = 'Ya subió 5(cinco) archivos. No puede subir más.';
            break;
        }
        $file_upload = ProcessFiles::FileUploadOne('', 'prod', $campo, $id_tabla_sec, $file);
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
        $reg_sec_nuevo = false;
    }while(0);
endif;



///////////  Por POST, del FORM. SUBIDA DE FOTOS.////////////////////////////////// (pertenece también a la tabla principal)
if(isset($_POST['subir_foto'])):
    $nombre_pedido = $_POST['nombre_pedido'];
    $first_time = $_POST['first_time'];
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_tabla = $_POST['id_tabla'];
    $id_tabla_sec = $_POST['id_tabla_sec'];
    $actual_key = $_POST['actual_key'];
    do {
        if($first_time == 'true') { // Si es la primera vez, debe crear tabla principal
                $new_process = Process::CreateNewProcess('', $id_user, 's');
                if($new_process['error'] == true) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $id_tabla = $new_process['id_tabla'];
                $id_tabla_proc = $new_process['id_tabla_proc'];
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $nombre_pedido), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $tabla_sec = Process::CreateSec('', 'prod', $id_tabla_proc, 'n');
                if($tabla_sec['error'] == true) {
                    $flash_error = $tabla_sec['notice_error'];
                    break;
                }
                $id_tabla_sec = $tabla_sec['id_tabla_sec'];
                $first_time = 'false';
        }
        $file = $_FILES['foto'];
        if($id_tabla_sec == -10) { // debe crear un registro secundario nuevo.
            $tabla_sec = Process::CreateSec('', 'prod', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
        }
        if(Process::isEmptyColumn('', 'prod', 'foto_1', $id_tabla_sec, 's')) {
            $campo = 'foto_1';
        }elseif(Process::isEmptyColumn('', 'prod', 'foto_2', $id_tabla_sec, 's')) {
            $campo = 'foto_2';
        }elseif(Process::isEmptyColumn('', 'prod', 'foto_3', $id_tabla_sec, 's')) {
            $campo = 'foto_3';
        }elseif(Process::isEmptyColumn('', 'prod', 'foto_4', $id_tabla_sec, 's')) {
            $campo = 'foto_4';
        }elseif(Process::isEmptyColumn('', 'prod', 'foto_5', $id_tabla_sec, 's')) {
            $campo = 'foto_5';
        }else{
            $flash_error = 'Ya subió 5(cinco) archivos. No puede subir más.';
            break;
        }
        $file_upload = ProcessFiles::FileUploadOne('', 'prod', $campo, $id_tabla_sec, $file, 'foto', 's');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
        $reg_sec_nuevo = false;
    }while(0);
endif;




// RESET PRINCIPALES
require_once '_php/forms_reset.php';







if($first_time == 'true') { // La primera vez que entra, debe calcular el número de pedido.
    $fecha = date('d/m/Y'); // Busco registros que pertenezacn a fecha actual
    $search_nombre_pedido = BDConsulta::consulta('tabla_princ_fecha_actual', array($fecha), 'n');
    if(!is_null($search_nombre_pedido)) {
        $search_nombre_pedido = end($search_nombre_pedido);
        $nombre_pedido = $search_nombre_pedido['nombre_pedido']; // Agarro el ultimo nombre_pedido del dia, si es que existe.
        $nro_pedido = explode(" ", $nombre_pedido);
        $nro_pedido = $nro_pedido[2];
        $ult_nro_pedido = $nro_pedido + 1;
    } else {
        $ult_nro_pedido = 1; // Es el primer pedido del día
    }

    $nombre_pedido = $fecha . ' Pedido ' . $ult_nro_pedido;
    $tpl->asignar('nombre_pedido', $nombre_pedido);
}


// Tabla PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);

// TABLA SECUNDARIA (los detalles)
$prod = Process::getTablaSec('', 'prod', $id_tabla_proc, 'n');
$tpl->asignar('tabla_sec', $prod);

// Carga los nombre de los archivos y fotos para poder mostrarlos en la vista.
if(isset($prod['error']) && $prod['error'] || $reg_sec_nuevo) { // TODAVIA NO EXISTE LA TABLA SECUNDARIA o comenzó una nueva
    $archivos = array('', '','','','');
    $fotos = array('', '','','','');
}else{   // SI YA EXISTE LA TABLA SECUNDARIA, ASIGNA LOS NOMBRES DE LOS ARCHIVOS Y FOTOS
    $archivos = array($prod[$actual_key]['archivo_1'], $prod[$actual_key]['archivo_2'], $prod[$actual_key]['archivo_3'], $prod[$actual_key]['archivo_4'], $prod[$actual_key]['archivo_5']);
    $fotos = array($prod[$actual_key]['foto_1'], $prod[$actual_key]['foto_2'], $prod[$actual_key]['foto_3'], $prod[$actual_key]['foto_4'], $prod[$actual_key]['foto_5']);
}
$tpl->asignar('archivos', $archivos);
$tpl->asignar('fotos', $fotos);
$tpl->asignar('reg_sec_nuevo', $reg_sec_nuevo);
$tpl->asignar('actual_key', $actual_key);


$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();

unset($flash_error);
unset($flash_notice);




