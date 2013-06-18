<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_prod_del']) && $_POST['id_prod_del'] > 0):  // ELIMINAR un cliente
        $id_prod_del = $_POST['id_prod_del'];
        $del_tabla_sec = Process::DeleteSec('', 'prod', $id_prod_del);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;

if(isset($_POST['id_prod_edit']) && $_POST['id_prod_edit'] > 0): // EDITAR  item tabla secundaria
        $id_prod_edit = $_POST['id_prod_edit'];
        $edit_tabla_sec = Process::ModifySec('', 'prod', $id_prod_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;

///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
if(isset($_POST['agregar'])):
        $ven_cliente_sucursales = trim($_POST['ven_cliente_sucursales']);                                  
        $observaciones = $_POST['observaciones'];
        if(isset($_POST['exhibiendo_mercaderia'])) {
            $exhibiendo_mercaderia = $_POST['exhibiendo_mercaderia'];
        }else {
            $exhibiendo_mercaderia = '';
        }
        if(isset($_POST['mercaderia_lugar'])) {
            $mercaderia_lugar = $_POST['mercaderia_lugar'];
        } else {
            $mercaderia_lugar = '';
        }
        if(isset($_POST['buena_cantidad_productos'])) {
            $buena_cantidad_productos = $_POST['buena_cantidad_productos'];
        } else {
            $buena_cantidad_productos = '';
        }
        $poner_punto_venta = $_POST['poner_punto_venta'];
        $poner_banner = $_POST['poner_banner'];
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                        array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar observaciones.'),
                                        array('field' => $exhibiendo_mercaderia, 'null' => false, 'notice_error' => 'Debe completar exhibiendo mercaderia.'),
                                        array('field' => $mercaderia_lugar, 'null' => false, 'notice_error' => 'Debe completar mercaderia lugar.'),
                                        array('field' => $buena_cantidad_productos, 'null' => false, 'notice_error' => 'Debe completar si hay una buena cantidad de productos.'),
                                        array('field' => $poner_punto_venta, 'null' => false, 'notice_error' => 'Debe completar si se puede poner punto de venta.'),
                                        array('field' => $poner_banner, 'null' => false, 'notice_error' => 'Debe completar si se puede poner un banner.'),
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
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $ven_cliente_sucursales, $observaciones, $exhibiendo_mercaderia, $mercaderia_lugar, $buena_cantidad_productos, $poner_punto_venta, $poner_banner), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;    
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ =
                    BDConsulta::consulta('update_tabla_princ', array($id_tabla, $ven_cliente_sucursales, $observaciones, $exhibiendo_mercaderia, $mercaderia_lugar, $buena_cantidad_productos, $poner_punto_venta, $poner_banner), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
            }
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;

///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS.//////////////////////////////////
if(isset($_POST['subir_archivo'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'):
            $flash_error = 'Debe cargar primero el asunto y las observaciones.';
            break;
        endif;
        $file = $_FILES['archivo'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUpload('', $id_tabla_proc, $file, 'n');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;




///////////////////////////////// AGREGAR LLAMADA DE CLIENTES |  POST 
if(isset($_POST['agregar_prod'])):
        $referencia = $_POST['referencia'];                       
        $precio = Common::PutDot($_POST['precio']);
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
                                        array('field' => $precio, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'El precio no es correcto y/o no fue ingresado.'),
                                        array('field' => $cantidad, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'La cantidad no fue ingresada y/o no es númerica.'),
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
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $referencia, $cantidad, $precio), 'n');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el producto.';
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
// PARA EL SELECT de VEN_CLIENTE_SUCURSALES
$ven_cliente_sucursales = Process::getValuesSelectRel('ven_cliente_sucursales', 'ven_cliente', '', '', '', 'n');
$tpl->asignar('ven_cliente_sucursales', $ven_cliente_sucursales);
// NOMBRE DE ARCHIVOS CARGADOS
$files = Process::getFiles('', $id_tabla_proc);
$tpl->asignar('files', $files);
// // PARA EL SELECT de PRO_PRODUCTOS
$pro_productos_select = Process::getValuesSelectRel('pro_productos', '', '', '', '', 'n');
$tpl->asignar('pro_productos_select', $pro_productos_select);
// TABLA SECUNDARIA (los productos)
$get_tabla_sec_prod = Process::getTablaSec('', 'prod', $id_tabla_proc, 'n', 'pro_productos');
$tpl->asignar('tabla_sec', $get_tabla_sec_prod);


$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();

unset($flash_error);
unset($flash_notice);




