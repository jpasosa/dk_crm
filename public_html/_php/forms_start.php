<?php

$flash_error = '';$flash_notice = '';$detalle = '';$reload = false;
$id_user = Common::isLogin();

if(isset($_POST['enviar'])):
        $exception = new Exception;
        $trace = $exception->getTrace();
        $file = $trace[0]['file'];
        $file = explode('/', $file);
        $file = end($file);
        $file = explode('.', $file);
        $pr_proceso = $file[0];
        if($pr_proceso == 'ger_otros_pedidos')
        {       // DIRIGO A UN ÁREA ESPECIFICA EL SIGUIENTE PROCESO
                $get_tabla = Process::getTabla($pr_proceso, $_POST['id_tabla_proc'], 'n');
                $id_sis_areas = $get_tabla[0]['id_sis_areas'];
                $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar_area', 'n', $id_sis_areas);
        }

        elseif($pr_proceso == 'ger_mantenimiento')
        {   // Según caso debo mandar a un área específica.
                $id_user = $_SESSION['id_user'];
                $area = BDConsulta::consulta('area', array($id_user), 'n');
                $id_area = $area[0]['id_sis_areas'];
                if($id_area != 3){
                    // el area es distinta de tres. si esta en el paso 1, debe mandarlo a GERENCIA, si esta en el proceso_orden 3 debe cerrarlo
                    $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
                }elseif($id_area == 3) { // GERENCIA
                    // debo investigar quien lo empezó y mandar al paso que corresponda. . .
                    $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
                }else { // Hay algun error desconocido, debe ir a pantalla de ERROR
                    header('Location: /error.html');
                    exit();
                }
        }

        else
        { // VA AL SIGUIENTE PROCESO NORMALMENTE
            $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
        }

        if($send['error'] == false) {
            header('Location: /enviado.html');
            exit();
        }
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
endif;





