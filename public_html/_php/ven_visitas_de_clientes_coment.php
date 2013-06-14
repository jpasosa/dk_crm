<?php
if($_GET[1] != '' && $_GET[1] > 0):  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
        require_once '_php/forms_start_coment.php';
        // TABLA PRINCIPAL
        $get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'ven_cliente', 'sis_provincia');
        $tpl->asignar('tabla', $get_tabla);
        // TABLA SECUNDARIA (sucursales)
        $sucursales = Process::getTablaSec('', 'sucursales', $id_tabla_proc, 'n', 'ven_cliente_sucursales');
        $flash_error = Common::setErrorMessage($sucursales); // Si tuviera error, lo carga en $flash_error para mostrar.
        $tpl->asignar('tabla_sec_sucursales', $sucursales);
        // TABLA SECUNDARIA (contactos)
        $contactos = Process::getTablaSec('', 'contactos', $id_tabla_proc, 'n', 'ven_cliente_contacto');
        $flash_error = Common::setErrorMessage($contactos);
        $tpl->asignar('tabla_sec_contactos', $contactos);
        // TABLA SECUNDARIA (tema)
        $temas = Process::getTablaSec('', 'temas', $id_tabla_proc, 'n');
        $flash_error = Common::setErrorMessage($temas);
        $tpl->asignar('tabla_sec_temas', $temas);
        require_once '_php/forms_end_coment.php';
        $tpl->obtenerPlantilla();
        unset($flash_error);
        unset($flash_notice);
else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
        header('Location: /menu.html');
        exit();
endif;
