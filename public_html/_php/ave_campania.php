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
        $campania = trim($_POST['campania']);                                  
        $motivo = $_POST['motivo'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_inicio_unix = Dates::ConvertToUnix($fecha_inicio);
        $mlg_fecha_inicio = $_POST['mlg_fecha_inicio'];
        $mlg_fecha_inicio_unix = Dates::ConvertToUnix($mlg_fecha_inicio);
        $hora = $_POST['hora'];
        $mlg_asunto = $_POST['mlg_asunto'];
        $mlg_texto = $_POST['mlg_texto'];
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                        array('field' => $campania, 'null' => false, 'notice_error' => 'Debe haberse completado automáticamente Campaña.'),
                                        array('field' => $motivo, 'null' => false, 'notice_error' => 'Debe completar el Motivo.'),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta y/o no fue ingresada.'),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'date_is_weekend', 'notice_error' => 'Fecha de Inicio cae un fin de semana.'),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'is_day_off', 'notice_error' => 'La fecha de inicio cae un feriado.',
                                                    'extra' => '1'),
                                        array('field' => $mlg_fecha_inicio, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha de inicio del Mailing no es correcta y/o no fue ingresada.'),
                                        array('field' => $hora, 'null' => false, 'notice_error' => 'La hora no fue ingresada.'),
                                        array('field' => $mlg_asunto, 'null' => false, 'notice_error' => 'El asunto del Mailing no fue ingresado.'),
                                        array('field' => $mlg_texto, 'null' => false, 'notice_error' => 'El texto del mailing no fue ingresado.')
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
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $campania, $motivo, $fecha_inicio_unix, $hora, $mlg_fecha_inicio_unix, $mlg_asunto, $mlg_texto), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;    
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ =
                    BDConsulta::consulta('update_tabla_princ', array($id_tabla, $campania, $motivo, $fecha_inicio_unix, $hora, $mlg_fecha_inicio_unix, $mlg_asunto, $mlg_texto), 'n');
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
if(isset($_POST['subir_mail'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero los demás campos.';
            break;
        }
        $file = $_FILES['archivo'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'mlg_plantilla', $id_tabla, $file, 'n', true);
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;




///////////////////////////////// AGREGAR PRODUCTOS |  POST 
if(isset($_POST['agregar_prod'])):
        $date = date('d/m/Y');
        $date_unix = Dates::ConvertToUnix($date);
        $referencia = $_POST['referencia'];                       
        $producto = $_POST['producto'];                       
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $max = $_POST['max'];
        $min = $_POST['min'];
        // $p = Common::PutDot($_POST['monto']);
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes, observaciones y cliente.';
                break;  
            }
            $validations = Validations::General(array(
                                       array('field' => $referencia, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar la referencia.', 'table' => 'pro_productos.id_pro_productos'),
                                       array('field' => $producto, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar el producto.', 'table' => 'pro_productos.id_pro_productos'),
                                       array('field' => $precio, 'null' => false, 'validation' => 'max', 'valor_max' => $max,
                                                    'notice_error' => 'No puede superar el 5% del precio.' . 'MAX: ' . $max . ' / min: ' . $min ),
                                       array('field' => $precio, 'null' => false, 'validation' => 'min', 'valor_min' => $min, 'notice_error' => 'No puede ser inferior el 5% del precio'),
                                       array('field' => $cantidad, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'Debe completar cantidad y/o debe ser numerica.')
                                       ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            if($referencia != $producto) {
                $flash_error = 'No coinciden los productos';
                break;  
            }
            $tabla_sec = Process::CreateSec('', 'prod', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $producto, $cantidad, $precio, $date_unix), 'n');
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




