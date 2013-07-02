<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_prod_del']) && $_POST['id_prod_del'] > 0):  // ELIMINAR un producto
        $id_prod_del = $_POST['id_prod_del'];
        $del_tabla_sec = Process::DeleteSec('', 'prod', $id_prod_del);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;

if(isset($_POST['id_prod_edit']) && $_POST['id_prod_edit'] > 0): // EDITAR  un producto
        $id_prod_edit = $_POST['id_prod_edit'];
        $edit_tabla_sec = Process::ModifySec('', 'prod', $id_prod_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;

///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
if(isset($_POST['agregar'])):
        $proveedor = trim($_POST['proveedor']);
        $direccion = $_POST['direccion'];
        $observaciones = $_POST['observaciones'];
        $provincia = $_POST['provincia'];
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                        array('field' => $proveedor, 'null' => false, 'notice_error' => 'Debe completar el proveedor.'),
                                        array('field' => $direccion, 'null' => false, 'notice_error' => 'Debe completar la dirección.'),
                                        array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe completar las observaciones.')
                                        ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break;
            }
            if($first_time == 'true' ) { // Primera VEZ
                $new_process = Process::CreateNewProcess('', $id_user);
                if($new_process['error'] == true) {
                    $flash_error = 'No pudo agregar el registro principal arriba';
                    break;
                }
                $flash_notice = $new_process['notice_success'];
                $id_tabla = $new_process['id_tabla'];
                $id_tabla_proc = $new_process['id_tabla_proc'];
                $tpl->asignar('id_tabla', $id_tabla);
                $tpl->asignar('id_tabla_proc', $id_tabla_proc);
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $proveedor, $direccion, $provincia, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ =
                    BDConsulta::consulta('update_tabla_princ', array($id_tabla, $proveedor, $direccion, $provincia, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
            }
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;






///////////////////////////////// AGREGAR REFERENCIAS DE PRODUCTOS |  POST
if(isset($_POST['agregar_prod'])):
        $referencia_de_producto = $_POST['referencia_de_producto'];
        $cantidad = $_POST['cantidad'];
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes, observaciones y cliente.';
                break;
            }
            $validations = Validations::General(array(
                                       array('field' => $referencia_de_producto, 'null' => false, 'notice_error' => 'Debe completar la referencia del producto.'),
                                       array('field' => $cantidad, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'Debe completar la cantidad y/o debe ser númerica.')
                                       ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break;
            }
            $tabla_sec = Process::CreateSec('', 'prod', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $referencia_de_producto, $cantidad), 'n');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el gasto.';
                break;
            }
            $flash_notice = 'Nuevo producto agregado correctamente.';
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
// TABLA SECUNDARIA (las referencias de los productos)
$get_tabla_sec_prod = Process::getTablaSec('', 'prod', $id_tabla_proc, 'n');
$tpl->asignar('tabla_sec', $get_tabla_sec_prod);



$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);




