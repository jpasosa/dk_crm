<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['referencia'])): // Busca el producto
    $precio = BDConsulta::consulta('search_precio', array($_POST['referencia']), 'n');
    $precio = utf8_decode($precio[0]['precio']);
    header("precio: " . $precio);
endif;
if(isset($_POST['producto'])): // Busca la referencia
    $precio = BDConsulta::consulta('search_precio', array($_POST['producto']), 'n');
    $precio = utf8_decode($precio[0]['precio']);
    $max = $precio * 1.05;
    $min = $precio * 0.95;
    $_POST['max'] = $max;
    $_POST['min'] = $min;
    header("precio: " . $precio);
endif;
if(isset($_POST['id_tabla_sec']) && $_POST['id_tabla_sec'] > 0):  // ELIMINAR item tabla secundaria
        $id_tabla_sec = $_POST['id_tabla_sec'];
        $del_tabla_sec = Process::DeleteSec('', 'prod', $id_tabla_sec);
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
                                       array('field' => $nombre, 'null' => false, 'notice_error' => 'Debe ingresar el nombrede la sucursal.'),
                                       array('field' => $direccion, 'null' => false, 'notice_error' => 'Debe ingresar la dirección de la sucursal.'),
                                       array('field' => $telefono, 'null' => false, 'notice_error' => 'Debe ingresar el teléfono de la sucursal.')
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
            $id_ven_cliente = $id_tabla;
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $id_ven_cliente, $nombre, $direccion, $telefono), 'n');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el gasto.';
                break;  
            }
            $flash_notice = 'Nueva sucursal agregada correctamente.';
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

// PARA EL SELECT de PAISES
$paises = Process::getValuesSelectRel('sis_provincia', 'sis_pais', '', '', '', 'n');
$tpl->asignar('paises', $paises);



// PARA EL SELECT de las direcciones de VEN_CLIENTE_SUCURSALES seleccionado (x ahora no está hecho con AJAX lo seleccionado, trae todas)
$clientes_direcciones = BDConsulta::consulta('clientes_direcciones', array(), 'n');
$tpl->asignar('clientes_direcciones', $clientes_direcciones);

// TABLA SECUNDARIA (los pedidos)
$get_tabla_sec_prod = Process::getTablaSec('', 'prod', $id_tabla_proc, 'n', 'pro_productos');
$tpl->asignar('tabla_sec', $get_tabla_sec_prod);

// // PARA EL SELECT de PRO_PRODUCTOS
$pro_productos_select = Process::getValuesSelectRel('pro_productos', '', '', '', '', 'n');
$tpl->asignar('pro_productos_select', $pro_productos_select);


$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);




