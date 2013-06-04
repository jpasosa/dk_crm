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


    // Calcula los mantenimientos que debe hacer entre dos fechas, segun su periodicidad y tiempos.
    public static function CalculateMant($start_date, $period, $x_time, $id_tabla_proc, $end_date = '') {
        $notice_error = ''; $notice_success = ''; $error = false;
        
        do {
            if(!Validations::IsCorrectDate($start_date)) {
                $error = true;
                $notice_error = 'Fecha de comienzo inválida';
                break;    
            }
            
            if($end_date != ''):
                    echo 'start_date: ' , $start_date, 'period: ' , $period, 'x_time: ' , $x_time, 'end_date: ' , $end_date;
                    if(!Validations::IsCorrectDate($end_date)) {
                        $error = true;
                        $notice_error = 'Fecha de comienzo inválida';
                        break;    
                    }else{
                        $start_date_unix = Dates::ConvertToUnix($start_date);
                        $end_date_unix = Dates::ConvertToUnix($end_date);
                        if($start_date_unix >= $end_date_unix) {
                            $error = true;
                            $notice_error = 'Fecha de inicio posterior a la de fin';
                            break;    
                        }
                    }
            else:   // Cálculo de $end_date en funcion de periodicidad.
                    $start_date_unix = Dates::ConvertToUnix($start_date);
                    if($period == 1){ // DIARIO
                        $days = 5;
                    }elseif($period == 2){ // SEMANAL
                        $days = 31;
                    }elseif($period == 3){ // MENSUAL
                        $days = 31 * 3;
                    }elseif($period == 4){ // x DIA
                        $days = 20;
                    }elseif($period == 5){ // x SEMANA
                        $days = 31 * 2;
                    }elseif($period == 6){ // ANUAL
                        $days = 365 * 2;
                    }elseif($period == 7){ // x MESES
                        $days = 365;
                    }else{
                        // error
                        break;
                    }
                    $end_date_unix = $start_date_unix + 60 * 60 * 24 * $days;

            endif;

            
            
            
            // FECHA ACTUAL
            $date = date('d/m/Y');
            $date_unix = Dates::ConvertToUnix($date);
            // Fecha INICIO
            $mant_date = $start_date;
            $mant_date_unix = Dates::ConvertToUnix($mant_date);
            // Preparo Arrays
            $recordatory['rojo'] = Array();
            $recordatory['amarillo'] = Array();
            $recordatory['verde'] = Array();
            $primer_fecha = true;



            switch ($period) {
                

                case 1: // DIARIO
                    while($mant_date_unix < $end_date_unix) {
                        if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)) {
                            require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                        }
                        $mant_date = Dates::AddDay($mant_date);
                        $mant_date_unix = Dates::ConvertToUnix($mant_date);
                    }
                    break;
                

                case 2: // SEMANAL
                    switch($x_time) {
                        case 1: // 1 vez a la semana
                            while($mant_date_unix < $end_date_unix) {
                                if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)) {
                                    require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                                    $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * 7; // le sumo 7 días.
                                    $mant_date = Dates::ConvertToPhpdate($mant_date_unix);
                                }else{ // cayo un ferido o fin de semana.
                                    $mant_date = Dates::AddDay($mant_date);
                                    $mant_date_unix = Dates::ConvertToUnix($mant_date);
                                }
                            }
                            break;
                        case 2: // 2 veces a la semana, MARTES Y JUEVES
                            while($mant_date_unix < $end_date_unix) {
                                if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)
                                        && (Dates::DayWeek($mant_date) == 2 || Dates::DayWeek($mant_date) == 4) ) {
                                    require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                                    if(Dates::DayWeek($mant_date) == 2) {
                                        $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * 2; // le sumo 2 días.    
                                    }
                                    if(Dates::DayWeek($mant_date) == 4) {
                                        $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * 5; // le sumo 5 días.    
                                    }
                                    $mant_date = Dates::ConvertToPhpdate($mant_date_unix);
                                }else{ // cayo un ferido o fin de semana.
                                    $mant_date = Dates::AddDay($mant_date);
                                    $mant_date_unix = Dates::ConvertToUnix($mant_date);
                                }
                            }
                            break;
                        case 3: // 3 veces a la semana, LUNES, MIERCOLES Y VIERNES
                            while($mant_date_unix < $end_date_unix) {
                                if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)
                                        && (Dates::DayWeek($mant_date) == 1 || Dates::DayWeek($mant_date) == 3 || Dates::DayWeek($mant_date) == 5) ) {
                                    require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                                    if(Dates::DayWeek($mant_date) == 1 || Dates::DayWeek($mant_date) == 3) {
                                        $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * 2; // le sumo 2 días.    
                                    }
                                    if(Dates::DayWeek($mant_date) == 5) { // si es viernes
                                        $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * 3; // le sumo 3 días.    
                                    }
                                    $mant_date = Dates::ConvertToPhpdate($mant_date_unix);
                                }else{ // cayo un ferido o fin de semana.
                                    $mant_date = Dates::AddDay($mant_date);
                                    $mant_date_unix = Dates::ConvertToUnix($mant_date);
                                }
                            }
                            break;
                        case 4: // 4 veces a la semana, LUNES, MARTES, MIERCOLES, JUEVES
                            while($mant_date_unix < $end_date_unix) {
                                if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)
                                        && (Dates::DayWeek($mant_date) == 1 || Dates::DayWeek($mant_date) == 2
                                                || Dates::DayWeek($mant_date) == 3 || Dates::DayWeek($mant_date) == 4) ) {
                                    require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                                    $mant_date = Dates::AddDay($mant_date);
                                    $mant_date_unix = Dates::ConvertToUnix($mant_date);
                                }else{ // cayo un ferido o fin de semana.
                                    $mant_date = Dates::AddDay($mant_date);
                                    $mant_date_unix = Dates::ConvertToUnix($mant_date);
                                }
                            }
                            break;
                        case 5: // 5 veces a la semana, LUNES, MARTES, MIERCOLES, JUEVES, VIERNES
                            while($mant_date_unix < $end_date_unix) {
                                if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)) {
                                    require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                                }
                                $mant_date = Dates::AddDay($mant_date);
                                $mant_date_unix = Dates::ConvertToUnix($mant_date);
                            }
                            break;
                        default:
                            $error = true;
                            $notice_error = 'Período inexistente';
                            break;
                    }
                    break;
                

                case 3: // MENSUAL
                    while($mant_date_unix < $end_date_unix) {
                        if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)) {
                            require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                            $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * 31; // le sumo 31 días.
                            $mant_date = Dates::ConvertToPhpdate($mant_date_unix);
                        }else{
                            $mant_date = Dates::AddDay($mant_date);
                            $mant_date_unix = Dates::ConvertToUnix($mant_date);    
                        }
                    }
                    break;
                

                case 4: // x DÍAS
                    while($mant_date_unix < $end_date_unix) {
                        if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)) {
                            require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                            $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * $x_time; // le sumo x_dias
                            $mant_date = Dates::ConvertToPhpdate($mant_date_unix);
                        }else{
                            $mant_date = Dates::AddDay($mant_date);
                            $mant_date_unix = Dates::ConvertToUnix($mant_date);    
                        }
                    }
                    break;
                

                case 5: // x SEMANAS
                    while($mant_date_unix < $end_date_unix) {
                        if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)) {
                            require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                            $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * 7 * $x_time; // le sumo x_semanas
                            $mant_date = Dates::ConvertToPhpdate($mant_date_unix);
                        }else{
                            $mant_date = Dates::AddDay($mant_date);
                            $mant_date_unix = Dates::ConvertToUnix($mant_date);    
                        }
                    }
                    break;
                

                case 6: // ANUAL
                    while($mant_date_unix < $end_date_unix) {
                        if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)) {
                            require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                            $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * 365; // le sumo 1 año
                            $mant_date = Dates::ConvertToPhpdate($mant_date_unix);
                        }else{
                            $mant_date = Dates::AddDay($mant_date);
                            $mant_date_unix = Dates::ConvertToUnix($mant_date);    
                        }
                    }
                    break;
                

                case 7: // x MESES
                    while($mant_date_unix < $end_date_unix) {
                        if(!Validations::IsWeekend($mant_date) && !Validations::IsDayOff($mant_date, 1)) {
                            require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY
                            $mant_date_unix = $mant_date_unix + 60 * 60 * 24 * 31 * $x_time; // le sumo x_meses
                            $mant_date = Dates::ConvertToPhpdate($mant_date_unix);
                        }else{
                            $mant_date = Dates::AddDay($mant_date);
                            $mant_date_unix = Dates::ConvertToUnix($mant_date);    
                        }
                    }
                    break;
                

                default:
                    $error = true;
                    $notice_error = 'Período inexistente';
                    break;
            }
            if($error)  break;  // si ya sale del switch con error, que retorne ERROR.

           
        }while(0);
        if(isset($recordatory['verde'][0])){
            unset($recordatory['verde'][0]);
        }elseif(isset($recordatory['amarillo'][0])) {
            unset($recordatory['amarillo'][0]);
        }elseif(isset($recordatory['rojo'][0])) {
            unset($recordatory['rojo'][0]);
        }
        
        return $recordatory;
    }

    // Calcula solamente el primer mantenimiento, segun fecha_inicio que habíamos puesto.
    public static function CalculateFirstMant($start_date, $id_tabla_proc) {
        $notice_error = ''; $notice_success = ''; $error = false;
        do {
            if(!Validations::IsCorrectDate($start_date)) {
                $error = true;
                $notice_error = 'Fecha de comienzo inválida';
                break;    
            
            }

            // FECHA ACTUAL
            $date = date('d/m/Y');
            $date_unix = Dates::ConvertToUnix($date);
            // Fecha INICIO
            $mant_date = $start_date;
            $mant_date_unix = Dates::ConvertToUnix($mant_date);
            // Preparo Arrays
            $recordatory['rojo'] = Array();
            $recordatory['amarillo'] = Array();
            $recordatory['verde'] = Array();
            require '_funciones/ProcessMaint_recordatory.php'; // CARGO ARRAY con el aviso del primer recordatorio
        }while(0);
        return $recordatory;
    }













}