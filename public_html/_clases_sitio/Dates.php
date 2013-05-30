<?php

class Dates {
    
    public static function ConvertToUnix($date) {
        if(!Validations::IsCorrectDate($date)) {
            return false;
        }
        $fecha_dividida = explode('/', $date);
        $dia = $fecha_dividida[0];
        $mes = $fecha_dividida[1];
        $anio = $fecha_dividida[2];
        $fecha_unix = mktime(0 ,0 ,0 ,$mes,$dia,$anio);
        return $fecha_unix;
    }

    public static function ConvertToPhpdate($date) {
        return gmdate("d/m/Y", $date);
    }

    public static function DayWeek($date) {
        $fecha_dividida = explode('/', $date);
        $dia = $fecha_dividida[0];
        $mes = $fecha_dividida[1];
        $anio = $fecha_dividida[2];
        // 0->domingo    | 6->sabado
        $dia= date("w",mktime(0, 0, 0, $mes, $dia, $anio));
        return $dia;
    }

    public static function DaysDiff($date_start, $date_end) {
        $f_unix_inicio = self::ConvertToUnix($date_start);
        $f_unix_final = self::ConvertToUnix($date_end);
        $dif_unix = $f_unix_final - $f_unix_inicio;
        $dias_diferencia = $dif_unix / (60 * 60 * 24);
        $dias_diferencia = abs($dias_diferencia);
        $dias_diferencia = floor($dias_diferencia);
        return $dias_diferencia;
    }

    // Devuelve la cantidad de días entre una fecha y otra, sin contar los feriados para ese país,
    // y los fines de semana(sábado y domingo).
    public static function RealDays($date_start, $date_end, $country) {
        $dias = 0;
        $days_diff = self::DaysDiff($date_start, $date_end);
        $check_date = self::AddDay($date_start);
        for( $i = 0 ; $i < $days_diff ; $i++) {
            if(!Validations::IsDayOff($check_date, $country) && !Validations::IsWeekend($check_date)) {
                $dias++;
            }
            $check_date = self::AddDay($check_date);
        }
        return $dias;
    }

    // Debo calcular fecha_vence / pasaron_dias / restan_dias / prioridad
    public static function CalculateDaysExpire($date_start, $active_days, $country) {
        $dias = 0;
        $date = date('d/m/Y');

        // CALCULO LA FECHA DE VENCIMIENTO
        $new_date = $date_start;
        for($i = 1 ; $i <= $active_days ; $i++) { // Le sumo los días activo a la fecha de inicio. Saco feriados y fin de semanas.
            $new_date = self::AddDay($new_date);
            // echo 'new_date: ' , $new_date;
            while(Validations::IsDayOff($new_date, $country) || Validations::IsWeekend($new_date)):
                $new_date = self::AddDay($new_date);
            endwhile;
        }
        $fecha_vencimiento = $new_date; // Es la fecha en el cual se vence el proceso, según cant de días activo que podia estar.

        // CALCULO LOS DÍAS $restan_dias o $pasaron_dias
        if(self::ConvertToUnix($fecha_vencimiento) < self::ConvertToUnix($date)){ // Ya venció. ROJO
            $restan_dias=0;
            $pasaron_dias = 0;
            $new_date = $fecha_vencimiento;
            while($new_date != $date):
                if(!Validations::IsDayOff($new_date, $country) && !Validations::IsWeekend($new_date)) {
                    $new_date = self::AddDay($new_date);
                    $pasaron_dias++;
                }else{
                    $new_date = self::AddDay($new_date);
                }

            endwhile;
            if($pasaron_dias >= 0 && $pasaron_dias < 5)      $prioridad = 'BAJA';
            if($pasaron_dias >= 5 && $pasaron_dias < 10)  $prioridad = 'MEDIA';
            if($pasaron_dias >= 10)                                     $prioridad = 'ALTA';
            $alarma = 'rojo';
        }elseif($fecha_vencimiento == $date){       // Vence hoy. AMARILLO
            $pasaron_dias = 0;
            $restan_dias = 0;
            $prioridad = 'ALTA';
            $alarma = 'amarillo';
        }else{                          // Falta para que venza. Calculo $restan_dias. VERDE
            $pasaron_dias = 0;
            $restan_dias = 0;
            $new_date = $date_start;
                    while($new_date != $fecha_vencimiento):
                        if(!Validations::IsDayOff($new_date, $country) && !Validations::IsWeekend($new_date)) {
                            $new_date = self::AddDay($new_date);
                            $restan_dias++;
                    }else{
                            $new_date = self::AddDay($new_date);
                    }
                    endwhile;
            if($restan_dias >= 0 && $restan_dias < 5) {
                
                $prioridad = 'ALTA';
            }      
            if($restan_dias >= 5 && $restan_dias < 10) {
                $prioridad = 'MEDIA';  
            }
            if($restan_dias >= 10) {
                $prioridad = 'BAJA';  
            }
            $alarma = 'verde';
        }
        // CALCULO PRIORIDAD
        
        

        $resp = array( 'fecha_vence' => $fecha_vencimiento,
                                'pasaron_dias' => $pasaron_dias,
                                'restan_dias' => $restan_dias,
                                'prioridad' => $prioridad,
                                'alarma' => $alarma);
        return $resp;
    }

    public static function AddDay($date) {
        if(Validations::IsCorrectDate($date)) {
            $date_unix = self::ConvertToUnix($date);    
            $date_add_one_day = $date_unix + 60 * 60 * 24;
            $date_add_one_day = self::ConvertToPhpdate($date_add_one_day);
            return $date_add_one_day; // retorna un día más. Siempre formato dd/mm/YYYY
        }else{
            return false; // la fecha es incorrectra
        }
    }

    function SumIfDayOff($date) {
        while(Validations::IsDayOff($date, 1) || Validations::IsWeekend($date) ) {
            $date = self::AddDay($date);
        }
        return $date;
    }    




}