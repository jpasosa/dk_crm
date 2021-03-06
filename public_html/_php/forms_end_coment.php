<?php

// Obtengo el archivo de donde fue llamado.
$exception = new Exception;
$trace = $exception->getTrace();
$file = $trace[0]['file'];
$file = explode('/', $file);
$file = end($file);
$file = explode('.', $file);
$pr_proceso = $file[0];
if(!stristr($pr_proceso, '_coment') === FALSE) { // si tiene _coment, debe eliminarlo, para escribir bien el proceso.
    $pr_proceso = str_replace('_coment', '', $pr_proceso);
    $no_comments = false; // debe mostrar los comentarios, por que no es un recordatorio, es un coments comun y silvestre.
}

if(!stristr($pr_proceso, '_recordatorio') === FALSE) { // si tiene _recordatorio, debe eliminarlo, para escribir bien el proceso.
    $pr_proceso = str_replace('_recordatorio', '', $pr_proceso);
    $no_comments = true;
}


// COMENTARIOS
if(isset($no_comments) && !$no_comments) {
    $all_comments = ProcessComments::getAll($pr_proceso, $id_tabla_proc, 'n');
    $flash_error = Common::setErrorMessage($all_comments); // Si tuviera error, lo carga en $flash_error para mostrar.
    $tpl->asignar('all_comments', $all_comments);
}


// Siempre debe ingresar un comentario, para hacer un submit
if(isset($_POST['comentario']) && $_POST['comentario'] == '' &&
    (isset($_POST['aprobar']) || isset($_POST['solicitar_correccion']) ||  isset($_POST['desaprobar']) ) ) { // Envia COMENTARIOS
        $flash_error = 'Debes ingresar un comentario antes de enviar el proceso.';
}

// Envía al siguiete proceso, o rechaza.
if(isset($_POST['comentario']) && $_POST['comentario'] != '' &&
    (isset($_POST['aprobar']) || isset($_POST['solicitar_correccion']) ||  isset($_POST['desaprobar']) ) ) { // Envia COMENTARIOS
    $comment = $_POST['comentario'];
    if(isset($_POST['aprobar'])) {
        $accion = 'aprobar';
    }
    if(isset($_POST['desaprobar'])) {
        $accion = 'desaprobar';
    }
    if(isset($_POST['solicitar_correccion'])) {
        $accion = 'correccion';
    }

    if($pr_proceso == 'bod_entrada_mercaderia') { // Va a tener que controlar si es el ultimo proceso, va a hacer UPADATE sobre PRO_PRODUCTOS
        $is_last = Process::isLastFlDias($pr_proceso, $id_tabla_proc );
        if($is_last) {
            $all_reg = Process::getTablaSec($pr_proceso, 'prod', $id_tabla_proc, 's');
            foreach($all_reg AS $prod) {  // debe hacer el update sobre tabla PRO_PRODUCTOS
                $update_productos = BDConsulta::consulta('update_productos',
                                                array
                                                (
                                                $prod['id_pro_productos'], $prod['id_pro_marca'],$prod['id_pro_subfamilia'],$prod['productos_por_caja_bem'],$prod['alto_bem'],
                                                $prod['ancho_bem'],$prod['fondo_bem'],$prod['volumen_bem'],$prod['peso_bem'],$prod['precio_bem'], $prod['foto_bem']
                                                ), 'n');
            }
        }
    }

    $comentario = ProcessSends::toNextProcess($pr_proceso, $id_user, $id_tabla_proc, $comment, $accion, 's');
    if($comentario['error'] == false) {
        header('Location: /enviado.html');
        exit();
    }
}

// Cierro un mantenimiento (caso especial en los recordatorios de los mantenimientos)
if(isset($_POST['cerrar_mant'])) {
    $update_cierre = BDConsulta::consulta('update_cierre', array($_POST['id_tabla']), 'n');
    if(!is_null($update_cierre)) {
        header('Location: /mant_cerrado.html');
        exit();
    }else{
        $flash_error = 'No pudo hacer el cierre del mantenimiento cargado.';
    }
}

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->asignar('id_tabla_proc', $id_tabla_proc);
