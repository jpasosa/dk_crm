<?php





if($_GET[1] != '' && $_GET[1] > 0)

{  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL

$tpl = new PlantillaReemplazos();
require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_tema_del']) && $_POST['id_tema_del'] > 0):  // ELIMINAR un tema
        $id_tema_del = $_POST['id_tema_del'];
        $del_tabla_sec = Process::DeleteSec('ven_llamadas', 'temas', $id_tema_del);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;
if(isset($_POST['id_tema_edit']) && $_POST['id_tema_edit'] > 0): // EDITAR  un tema
        $id_tema_edit = $_POST['id_tema_edit'];
        $edit_tabla_sec = Process::ModifySec('ven_llamadas', 'temas', $id_tema_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;



///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
if(isset($_POST['agregar'])):
        $fecha = $_POST['fecha'];
        $fecha_unix = Dates::ConvertToUnix($fecha);
        $tipo_llamada = $_POST['tipo_llamada'];
        $prioridad = $_POST['prioridad'];
        $hora = $_POST['hora'];
        $observaciones = $_POST['observaciones'];
        $id_ave_campania = $_POST['id_ave_campania'];
        $id_ven_cliente_contacto = $_POST['id_ven_cliente_contacto'];
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                        array('field' => $fecha, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta y/o no fue ingresada.'),
                                        array('field' => $tipo_llamada, 'null' => false, 'notice_error' => 'Falta definir tipo de llamada.'),
                                        array('field' => $prioridad, 'null' => false, 'notice_error' => 'Falta definir la prioridad.'),
                                        array('field' => $hora, 'null' => false, 'notice_error' => 'La hora no fue ingresada.'),
                                        array('field' => $observaciones, 'null' => false, 'notice_error' => 'Falta definir las observaciones.')
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
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $id_ave_campania, $id_ven_cliente_contacto, $tipo_llamada, $prioridad, $fecha_unix, $hora, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ =
                    BDConsulta::consulta('update_tabla_princ', array($id_tabla, $id_ave_campania, $id_ven_cliente_contacto, $tipo_llamada, $prioridad, $fecha_unix, $hora, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
            }
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;



///////////////////////////////// AGREGAR TEMAS A TOCAR O TEMAS YA TOCADOS |  POST
if(isset($_POST['agregar_tema'])):
        $tema = $_POST['tema'];
        $tema_tocado = $_POST['tema_tocado'];
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe completar antes el registro principal.';
                break;
            }
            $validations = Validations::General(array(
                                       array('field' => $tema, 'null' => false, 'notice_error' => 'Debe ingresar el tema.')
                                       ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break;
            }
            $tabla_sec = Process::CreateSec('', 'temas', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $tema, $tema_tocado), 'n');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el tema.';
                break;
            }
            $flash_notice = 'Nuevo tema agregado correctamente.';
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;

// RESET PRINCIPALES
require_once '_php/forms_reset.php';


$id_ave_campania_clientes = $_GET[1];

// obtengo tabla_proc, para buscar todas las tablas que debo cargar.
$get_proc_ave_campania = BDConsulta::consulta('get_proc_ave_campania', array($id_ave_campania_clientes), 'n');
if(!is_null($get_proc_ave_campania)) {
    // Tabla ave_campania
    $id_ave_campania_proc = $get_proc_ave_campania[0]['id_ave_campania_proc'];
    $tabla_ave_campania = Process::getTabla('ave_campania', $id_ave_campania_proc, 'n');
    $tpl->asignar('tabla_ave_campania', $tabla_ave_campania);
    // Tabla ave_campania_clientes
    $ave_campania_clientes = BDConsulta::consulta('get_ave_campania_clientes', array($id_ave_campania_clientes), 'n');
    $tpl->asignar('ave_campania_clientes', $ave_campania_clientes);
    $id_ave_campania = $tabla_ave_campania[0]['id_ave_campania'];
    $tpl->asignar('id_ave_campania', $id_ave_campania);
    $id_ven_cliente_contacto = $ave_campania_clientes[0]['id_ave_campania_clientes'];
    $tpl->asignar('id_ven_cliente_contacto', $id_ven_cliente_contacto);
    $tpl->asignar('id_ave_campania_clientes', $id_ave_campania_clientes);


    // TABLA PRINCIPAL  (ven_llamadas)
    $get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
    $tpl->asignar('tabla', $get_tabla);

    // TABLA SECUNDARIA (Temas a tratar o tratados)
    $tabla_sec_temas = Process::getTablaSec('', 'temas', $id_tabla_proc, 'n');
    $tpl->asignar('tabla_sec', $tabla_sec_temas);

    $tpl->asignar('flash_error', $flash_error);
    $tpl->asignar('flash_notice', $flash_notice);
    $tpl->obtenerPlantilla();


    unset($flash_error);
    unset($flash_notice);


}else{
    // ERROR, NO PUDO ENCONTRAR id_ave_campania_proc.. . . .
    header('Location: /menu.html');
    exit();
}













}else{ // es el primer if, en donde si no pasó un id_tabla_sec, vuelve al menu principal.
        header('Location: /menu.html');
        exit();
}





