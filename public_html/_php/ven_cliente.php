<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_suc_del']) && $_POST['id_suc_del'] > 0):  // ELIMINAR item tabla secundaria
        $id_tabla_sec = $_POST['id_suc_del'];
        $del_tabla_sec = Process::DeleteSec('', 'sucursales', $id_tabla_sec);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;
if(isset($_POST['id_tabla_sec_edit']) && $_POST['id_tabla_sec_edit'] > 0): // EDITAR  item tabla secundaria
        $id_tabla_sec_edit = $_POST['id_tabla_sec_edit'];
        $edit_tabla_sec = Process::ModifySec('', 'prod', $id_tabla_sec_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;

///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
if(isset($_POST['agregar'])):
        $id_sis_provincia = $_POST['provincia'];
        $empresa = trim($_POST['empresa']);                                  
        $sitio = trim($_POST['sitio']);                                  
        $cuit = trim($_POST['cuit']);                                  
        $telefono = trim($_POST['telefono']);                                  
        $mail = trim($_POST['mail']);                                  
        $observaciones = trim($_POST['observaciones']);                                  
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                    array('field' => $empresa, 'null' => false, 'notice_error' => 'Debe ingresar el nombre de la empresa.'),
                                    array('field' => $sitio, 'null' => false, 'notice_error' => 'Debe ingresar el sitio web.'),
                                    array('field' => $cuit, 'null' => false, 'notice_error' => 'Debe ingresar el cuit.'),
                                    array('field' => $telefono, 'null' => false, 'notice_error' => 'Debe ingresar el telefono.'),
                                    array('field' => $mail, 'null' => false, 'notice_error' => 'Debe ingresar el mail.'),
                                    array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar observaciones.')
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
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $empresa, $sitio, $cuit, $telefono, $mail, $observaciones, $id_sis_provincia), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;    
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $empresa, $sitio, $cuit, $telefono, $mail, $observaciones, $id_sis_provincia), 'n');
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
        $nombre = $_POST['nombre'];                       
        $direccion = $_POST['direccion'];                       
        $telefono = $_POST['telefono'];
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes los datos del cliente.';
                break;  
            }
            $validations = Validations::General(array(
                                       array('field' => $nombre, 'null' => false, 'notice_error' => 'Debe ingresar el nombre de la sucursal.'),
                                       array('field' => $direccion, 'null' => false, 'notice_error' => 'Debe ingresar la dirección de la sucursal.'),
                                       array('field' => $telefono, 'null' => false, 'notice_error' => 'Debe ingresar el teléfono de la sucursal.')
                                       ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            $insert_suc = BDConsulta::consulta('insert_suc', array($id_tabla, $nombre, $direccion, $telefono), 'n');
            if(is_null($insert_suc)) {
                $flash_error = 'No se pudo insertar la sucursal en la base de datos.';
                break;
            }
            $flash_notice = 'Nueva sucursal agregada correctamente.';
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;



///////////////////////////////// AGREGAR CONTACTO |  POST 
if(isset($_POST['agregar_contacto'])):
        $nombre = $_POST['nombre'];                       
        $apellido = $_POST['apellido'];                       
        $sucursal = $_POST['sucursal'];
        $mail = $_POST['mail'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $sector = $_POST['sector'];
        $puesto = $_POST['puesto'];
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes los datos del cliente.';
                break;  
            }
            $validations = Validations::General(array(
                                       array('field' => $nombre, 'null' => false, 'notice_error' => 'Debe ingresar el nombre del contacto.'),
                                       array('field' => $apellido, 'null' => false, 'notice_error' => 'Debe ingresar el apellido del contacto.'),
                                       array('field' => $mail, 'null' => false, 'notice_error' => 'Debe ingresar el mail del contacto.'),
                                       array('field' => $telefono, 'null' => false, 'notice_error' => 'Debe ingresar el teléfono del contacto.'),
                                       array('field' => $celular, 'null' => false, 'notice_error' => 'Debe ingresar el celular del contacto.'),
                                       array('field' => $sector, 'null' => false, 'notice_error' => 'Debe ingresar lel sector del contacto.'),
                                       array('field' => $puesto, 'null' => false, 'notice_error' => 'Debe ingresar el puesto del contacto.')
                                       ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            $insert_contacto = BDConsulta::consulta('insert_contacto', array($nombre, $apellido, $sucursal, $mail, $telefono, $celular, $sector, $puesto), 'n');
            if(is_null($insert_contacto)) {
                $flash_error = 'No se pudo insertar el contacto en la base de datos.';
                break;
            }
            $flash_notice = 'Nuevo contacto agregado correctamente.';
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
// TABLA SECUNDARIA (sucursales)
$get_tabla_suc = BDConsulta::consulta('get_tabla_suc', array($id_tabla), 'n');
$tpl->asignar('tabla_suc', $get_tabla_suc);
// // PARA EL SELECT de SUCURSALES
$select_suc = BDConsulta::consulta('select_suc', array($id_tabla), 'n');
$tpl->asignar('select_suc', $select_suc);
// TABLA SECUNDARIA (contactos)
$get_tabla_contactos = BDConsulta::consulta('get_tabla_contactos', array($id_tabla), 'n');
$tpl->asignar('tabla_contactos', $get_tabla_contactos);

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);




