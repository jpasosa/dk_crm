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
        if($pr_proceso == 'ger_otros_pedidos') { // DIRIGO A UN ÁREA ESPECIFICA EL SIGUIENTE PROCESO
            $get_tabla = Process::getTabla($pr_proceso, $_POST['id_tabla_proc'], 'n');
            $id_sis_areas = $get_tabla[0]['id_sis_areas'];
            $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar_area', 'n', $id_sis_areas);
        }else{ // VA AL SIGUIENTE PROCESO NORMALMENT
            $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');    
        }
        
        if($send['error'] == false) {
            header('Location: /enviado.html');
            exit();    
        }
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
endif;





