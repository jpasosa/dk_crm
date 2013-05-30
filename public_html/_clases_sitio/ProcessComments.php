<?php

class ProcessComments {
    
    // devuelve todos los comentarios desde el pr_orden 1 hasta el anterior al pr_orden del tabla_proc actual
    // esto hace tal y tal cosa
    public static function getAll($pr_proceso, $id_tabla_proc, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = Process::NameProcess();
        }
        do {
            $all_tabla_proc = Process::getAllTablaProc($pr_proceso, $id_tabla_proc, $deb);
            if(is_null($all_tabla_proc) || isset($all_tabla_proc['error']) && $all_tabla_proc['error']  == true) {
                $error = true;
                $notice_error = 'No pudo obtener todos los procesos';
                break;      
            }

            foreach($all_tabla_proc as $k => $com) {
                if($com['id_tabla_proc'] == $id_tabla_proc) {
                    unset($all_tabla_proc[$k]);
                }
            }
            
        }while(0);
        
        if($error == false) {
            $resp = $all_tabla_proc; // Si no hubo errores, devuelve el array
        }else{ // HUBO ERRORES
            $resp = array(
                'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        }

        return $resp;
        
    }
}