<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
if(isset($_POST['agregar'])):
        $expo = trim($_POST['expo']);
        $provincia = $_POST['provincia'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_inicio_unix = Dates::ConvertToUnix($fecha_inicio);
        $fecha_fin = $_POST['fecha_fin'];
        $fecha_fin_unix = Dates::ConvertToUnix($fecha_fin);
        $costo = Common::PutDot($_POST['costo']);
        $observaciones = $_POST['observaciones'];
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                        array('field' => $expo, 'null' => false, 'notice_error' => 'Debe completar la exposición.'),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta y/o no fue ingresada.'),
                                        array('field' => $costo, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'El costo no fue ingresado y/o no es correcto.'),
                                        array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar las observaciones.')
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
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $expo, $provincia, $fecha_inicio_unix, $fecha_fin_unix, $costo, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ =
                    BDConsulta::consulta('update_tabla_princ', array($id_tabla, $expo, $provincia, $fecha_inicio_unix, $fecha_fin_unix, $costo, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
            }
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

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();

unset($flash_error);
unset($flash_notice);




