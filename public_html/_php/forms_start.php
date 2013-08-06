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

        // Viene de ave_campania
        elseif($pr_proceso == 'ven_llamadas') // Viene de ave_campania, entonces en ave_campania, hay que poner  id_tabla_proc en -2, para entender
        {                                                       // que está en un segundo paso; entonces al buscar los que están cerrados, ya no selecciona estos. . . .
                $id_user = $_SESSION['id_user'];
                $id_tabla = $_POST['id_tabla'];
                $edit_ave_campania = BDConsulta::consulta('edit_ave_campania', array($id_tabla), 'n'); // Tenemos que poner en -2 id_tabla_proc de ave_campania
                if(!is_null($edit_ave_campania)){
                    $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
                }else { // Hay algun error desconocido, debe ir a pantalla de ERROR
                    header('Location: /error.html');
                    exit();
                }
        }

        elseif($pr_proceso == 'adm_audit_stock_limpieza_detalle') // Viene de viene de adm_audit_stock_limpieza, hay que poner  id_tabla_proc en -2, para entender
        {                                                       // que está en un segundo paso; entonces al buscar los que están cerrados, ya no selecciona estos. . . .
                $id_user = $_SESSION['id_user'];
                $id_tabla = $_POST['adm_audit_stock_limpieza']; // el id_tabla anterior, es decir de adm_audit_stock_limpieza
                $edit_adm_audit_stock_limpieza = BDConsulta::consulta('edit_adm_audit_stock_limpieza', array($id_tabla), 's'); // Tenemos que poner en -2 id_tabla_proc de ave_campania
                if(!is_null($edit_adm_audit_stock_limpieza)){
                    $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
                }else { // Hay algun error desconocido, debe ir a pantalla de ERROR
                    header('Location: /error.html');
                    exit();
                }
        }


        elseif($pr_proceso == 'tra_carga_mercaderia_transito')
        {
                $id_user = $_SESSION['id_user'];
                $id_tabla = $_POST['id_tra_packing_list']; // el id_tabla anterior, es decir de adm_audit_stock_limpieza
                $edit_tra_packing_list = BDConsulta::consulta('edit_tra_packing_list', array($id_tabla), 'n'); // Tenemos que poner en -2 id_tabla_proc de ave_campania
                if(!is_null($edit_tra_packing_list)){
                    $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
                }else { // Hay algun error desconocido, debe ir a pantalla de ERROR
                    header('Location: /error.html');
                    exit();
                }
        }

        elseif($pr_proceso == 'tra_ytd_entrada')
        {
                if(isset($_POST['id_prod']) && isset($_SESSION['id_user']) && isset($_POST['id_tra_carga_mercaderia_transito']) && isset($_POST['id_tabla_proc']))
                {
                    $id_user = $_SESSION['id_user'];
                    $id_tra_carga_mercaderia_transito = $_POST['id_tra_carga_mercaderia_transito']; // el id_tabla anterior.
                    $edit_tra_carga_mercaderia_transito = BDConsulta::consulta('edit_tra_carga_mercaderia_transito', array($id_tra_carga_mercaderia_transito), 'n'); // Tenemos que poner en -2 id_tabla_proc de ave_campania
                    if(!is_null($edit_tra_carga_mercaderia_transito)){
                        foreach($_POST['id_prod'] AS $id_prod) {
                            $insert_tra_ytd_entrada_prod = BDConsulta::consulta('insert_tra_ytd_entrada_prod', array($id_prod), 'n');
                        }

                        $send = ProcessSends::toNextProcess($pr_proceso, $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
                    }else { // Hay algun error desconocido, debe ir a pantalla de ERROR
                        header('Location: /error.html');
                        exit();
                    }
                }
                else
                {
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





