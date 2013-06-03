<?php

class ProcessMaint {    

    // Selecciona los recordatorios correspondientes a ese proceso. me pasan id_tabla de adm_ytd_mantenimietnos
    public static function getRecordatorys($id_tabla, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        do {
            $first_proc = Process::getOnlyFirstProcess('adm_ytd_mantenimientos', $id_tabla, $deb);
            if(isset($first_proc['error']) && $first_proc['error'] == true) {
                $notice_error = $first_proc['notice_error'];
                break;
            }
        }while(0);
        
        if($error == false) {
            $resp = $first_proc; // Si no hubo errores, devuelve el array
        }else{ // HUBO ERRORES
            $resp = array(
                'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        }

        return $resp;
    }

    public static function CalculateMant($proceso, $x_tiempo, $periodicidad) {
        $lim_period = "31/06/2013"; // esta variable debe ser definida en configuraciones globales.
        $lim_period_unix = Dates::ConvertToUnix($lim_period);
        $id_process = 1; // esto es el id del proceso. lo tengo q sacar de algun lado. . .
        switch ($periodicidad) {
            case 1: // DIARIO
                $fecha_reg = $fecha_inicio;
                $fecha_reg_unix = Dates::ConvertToUnix($fecha_reg);
                while($fecha_reg_unix <= $lim_period_unix) {
                    $set_fecha_recordatorio = BDConsulta::consulta('set_fecha_recordatorio', array($id_process, $fecha_reg_unix), 'n');    
                    $fecha_reg = Dates::ConvertToPhpdate($fecha_reg_unix);
                    $fecha_reg = Dates::AddDay($fecha_reg);
                    $fecha_reg_unix = Dates::ConvertToUnix($fecha_reg);
                };
                
                $fechas_recordatorio = BDConsulta::consulta('fechas_recordatorio', array($id_process), 'n');    
                
                break;
            case 2: // SEMANAL
                switch($x_tiempo) {
                    case 1: // 1 vez a la semana
                        $fecha_reg = $fecha_inicio;
                        $fecha_reg_unix = Dates::ConvertToUnix($fecha_reg);
                        while($fecha_reg_unix <= $lim_period_unix) {
                            $set_fecha_recordatorio = BDConsulta::consulta('set_fecha_recordatorio', array($id_process, $fecha_reg_unix), 'n');    
                            $fecha_reg_unix = $fecha_reg_unix + 60 * 60 * 24 * 7; // le sumo 7 días.
                            $fecha_reg = Dates::ConvertToPhpdate($fecha_reg_unix);
                            $fecha_reg = Dates::SumIfDayOff($fecha_reg);
                            $fecha_reg_unix = Dates::ConvertToUnix($fecha_reg);
                        }
                        // me dice las fechas que insertó en la tabla.
                        $fechas_recordatorio = BDConsulta::consulta('fechas_recordatorio', array($id_process), 'n');
                        break;
                    case 2: // 2 veces a la semana, conviene que reparta entre martes y jueves
                        // todo
                        break;
                    case 3: // 3 veces a la semana, conviene lunes, miércoles y viernes.
                        // todo
                        break;
                    case 4: // 4 veces a la semana, Lunes, martes, miércoles, jueves, x si alguno es feriado, pasa al viernes.
                        // todo
                        break;
                    case 5: // 5 veces a la semana, todos los días
                        // todo
                        break;
                    default:
                        // ninguna de las anterior. ERROR
                }
                break;
            case 3: // MENSUAL
                // todo
                break;
            case 4: // x DÍAS
                // todo
                break;
            case 5: // x SEMANAS
                // todo
                break;
            case 6: // ANUAL
                // todo
                break;
            case 7: // x MESES
                // todo
                break;
            default:
                // Error, no debería existir otro valor por el momento.
        }

        $fecha_unix = Dates::ConvertToUnix($fecha_inicio);
        $update_mant = BDConsulta::consulta('update_mant_principal', array($id_proccess, $id_ytd_mant, $asunto, $x_tiempo, $fecha_unix, $periodicidad, $observaciones), 'n');
        $flash_notice = 'Se creó correctamente el nuevo mantenimiento';

        return true;
    }













}