<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_suc_del']) && $_POST['id_suc_del'] > 0):  // ELIMINAR una SUCURSAL
        $id_tabla_sec = $_POST['id_suc_del'];
        $del_tabla_sec = Process::DeleteSec('', 'sucursales', $id_tabla_sec);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;
if(isset($_POST['id_suc_edit']) && $_POST['id_suc_edit'] > 0): // EDITAR una SUCURSAL
        $id_tabla_sec_edit = $_POST['id_suc_edit'];
        $edit_tabla_sec = Process::ModifySec('', 'sucursales', $id_tabla_sec_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;
if(isset($_POST['id_contacto_del']) && $_POST['id_contacto_del'] > 0):  // ELIMINAR un CONTACTO
        $id_tabla_sec = $_POST['id_contacto_del'];
        $del_tabla_sec = Process::DeleteSec('', 'contacto', $id_tabla_sec);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;
if(isset($_POST['id_contacto_edit']) && $_POST['id_contacto_edit'] > 0): // EDITAR una SUCURSAL
        $id_tabla_sec_edit = $_POST['id_contacto_edit'];
        $edit_tabla_sec = Process::ModifySec('', 'contacto', $id_tabla_sec_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;

///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
if(isset($_POST['agregar'])):
        $id_sis_provincia = $_POST['provincia'];
        $cliente = trim($_POST['cliente']);
        $fecha = trim($_POST['fecha']);
        $fecha_unix = Dates::ConvertToUnix($fecha);                             
        $hora = trim($_POST['hora']);
        $direccion = trim($_POST['direccion']);
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                    array('field' => $id_sis_provincia, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar País / Ciudad', 'table' => 'sis_provincia.id_sis_provincia'),
                                    array('field' => $cliente, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar Cliente', 'table' => 'ven_cliente.id_ven_cliente'),
                                    array('field' => $hora, 'null' => false, 'notice_error' => 'Debe ingresar la hora.'),
                                    array('field' => $direccion, 'null' => false, 'notice_error' => 'Debe ingresar la dirección.'),
                                    array('field' => $fecha, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta o no fue ingresada.')
                                    ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            if($first_time == 'true' ) { // Primera VEZ
                $new_process = Process::CreateNewProcess('', $id_user);
                if($new_process['error'] == true) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;    
                }
                $flash_notice = $new_process['notice_success'];
                $id_tabla = $new_process['id_tabla'];
                $id_tabla_proc = $new_process['id_tabla_proc'];
                $tpl->asignar('id_tabla', $id_tabla);
                $tpl->asignar('id_tabla_proc', $id_tabla_proc);
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $cliente, $fecha_unix, $hora, $id_sis_provincia, $direccion), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;    
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $cliente, $fecha_unix, $hora, $id_sis_provincia, $direccion), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
            }
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;


///////////////////////////////// AGREGAR SUCURSALES |  POST 
if(isset($_POST['agregar_suc'])):
        $sucursal = $_POST['sucursal'];                       
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes los datos del cliente.';
                break;  
            }
            $validations = Validations::General(array(
                                       array('field' => $sucursal, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar la sucursal.', 'table' => 'ven_cliente_sucursales.id_ven_cliente_sucursales')
                                       ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            $tabla_sec = Process::CreateSec('', 'sucursales', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $sucursal), 'n');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el pedido.';
                break;  
            }
            $flash_notice = 'Nueva sucursal cargada correctamente.';
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;



///////////////////////////////// AGREGAR CONTACTO |  POST 
if(isset($_POST['agregar_contacto'])):
        $contacto = $_POST['contacto'];                       
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes los datos del cliente.';
                break;  
            }
            $validations =
                Validations::General(array(
                   array('field' => $contacto, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar el contacto.', 'table' => 'ven_cliente_contacto.id_ven_cliente_contacto')
                    ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            $tabla_sec = Process::CreateSec('', 'sucursales', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $contacto), 'n');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el pedido.';
                break;  
            }
            $flash_notice = 'Nuevo pedido agregado correctamente.';
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;




// RESET PRINCIPALES
require_once '_php/forms_reset.php';



// Tabla PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// PARA EL SELECT de PAISES
$paises = Process::getValuesSelectRel('sis_provincia', 'sis_pais', '', '', '', 'n');
$tpl->asignar('paises', $paises);
// PARA EL SELECT de CLIENTES
$clientes = Process::getValuesSelectRel('ven_cliente', '', '', '', '', 'n');
$tpl->asignar('clientes', $clientes);


// // PARA EL SELECT de SUCURSALES
$get_sucursales = BDConsulta::consulta('get_sucursales', array($get_tabla[0]['id_ven_cliente']), 'n');
$tpl->asignar('get_sucursales', $get_sucursales);

// TABLA SECUNDARIA (sucursales)
$sucursales = BDConsulta::consulta('sucursales', array($id_tabla_proc), 'n');
$tpl->asignar('sucursales', $sucursales);


//
// Debagueo un objeto / arreglo / variable
//
echo ' <br/> <div style="font-weight: bold; color: green;"> $sucursales: </div> <pre>' ;
echo '<div style="color: #3741c6;">';
if(is_array($sucursales)) {
    print_r($sucursales);
}else {
var_dump($sucursales);    
}
echo '</div>';
echo '</pre>';
// die('--FIN--DEBUGEO----');



$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);




