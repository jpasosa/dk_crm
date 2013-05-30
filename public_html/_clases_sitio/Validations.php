<?php

class Validations {



    public static function IsCorrectPeriod($x_tiempo, $period) {
        $is_correct = false;
        if($x_tiempo == 1 && $period == 1) { // puede hacer un mantenimiento dos veces al día???
            $is_correct = true;
        }
        if($x_tiempo > 0 && $x_tiempo <= 5 && $period == 2) { // semanal va entre 1 y 5
            $is_correct = true;
        }
        if($x_tiempo > 0 && $x_tiempo <= 20 && $period == 3) { // mensual va entre 1 y 20
            $is_correct = true;
        }
        if($x_tiempo > 0 && $x_tiempo <= 28 && $period == 4) { // x días
            $is_correct = true;
        }
        if($x_tiempo > 0 && $x_tiempo <= 28 && $period == 5) { // x semana
            $is_correct = true;
        }
        if($x_tiempo > 0 && $x_tiempo <= 28 && $period == 6) { // anualmente
            $is_correct = true;
        }
        if($x_tiempo > 0 && $x_tiempo <= 28 && $period == 7) { // x días va entre 1 y 5
            $is_correct = true;
        }
        return $is_correct;
    }

    //
    // VALIDACIONES DE FECHAS
    //
    public static function IsWeekend($date) {
       $dia_semana = Dates::DayWeek($date);
        if($dia_semana == 0 || $dia_semana == 6) {
            return true;
        }else{
            return false;
        } 
    }

    // valida si el numero ingresado esta entre 1 y 12.
    public static function IsMonth($month) {
        $mes = trim($month);
        $mes += 0;
        if($mes >= 1 && $mes <= 12) {
            return true;
        }else{
            return false;
        }
    }

    public static function IsCorrectDate($date = '32/32/1600') {
         // paso una fecha que dé false por si viene vacio el parámetro, que no me dé error
        if($date == '') {
            $date = '32/32/1600';
        }
        $fecha_dividida = explode('/', $date);
        if(count($fecha_dividida) == 3): // si hay dia, mes anio. . .
                $dia = $fecha_dividida[0];
                $mes = $fecha_dividida[1];
                $anio = $fecha_dividida[2];
                if($dia >= 1 && $dia <= 31 && $mes >= 1 && $mes <= 12 && $anio >= 2000 && $anio <= 2200) {
                    $fecha_numeros = true;
                }else{
                    $fecha_numeros = false;
                }
                if(checkdate($mes, $dia, $anio) && $fecha_numeros) {
                    return true;
                }else{
                    return false;
                }    
        else:
                return false;
        endif;
        
    }

    public static function IsDayOff($date, $country) {
        $day_off = false;
        $select_feriados = BDConsulta::consulta('select_feriados', array($country), 'n');
        foreach($select_feriados as $fer) {
            if($fer['fecha'] == $date) {
                $day_off = true;
            }
        }
        return $day_off;
    }
    // aquí ingresamos un array con todas las validaciones juntas que vayamos a hacer.
    // EJEMPLO
    // $validations = Validations::General(array(
    //                             array('field' => $_POST['detalle'],          'null' => false,        'validation' => 'text',
    //                                           'notice_error' => 'Debe ingresar detalle y/o incorrecto detalles.'),
    //                             array('field' => $_POST['mes'], 'null' => false, 'validation' => 'is_month',
    //                                          'notice_error' => 'Debe ingresar un mes del 01 al 12.'),
    //                             array('field' => $_POST['cuenta'], 'null' => false, 'validation' => 'field_search', 
    //                                          'notice_error' => 'No ingresó cuenta o no fue encontrada.',         'table' => 'sis_cuentas.cuenta'),
    //                             array('field' => $_POST['descripcion'], 'null' => false, 'validation' => 'field_search', 'notice_error' => 'No ingresó descripción o no fue encontrada.',
    //                                         'table' => 'sis_cuentas.descripcion'),
    //                             array('field' => $_POST['monto'], 'null' => false, 'notice_error' => 'Debe ingresar monto y debe ser númerico'),
    //                             array('field' => $_POST['proveedor'], 'null' => false),
    //                             ));
    public static function General($validations) {
        $resp['error'] = false; $resp['notice_error'] = '';
        
        foreach($validations as $val) {
             if($val['null'] == false ) { // Verifica si está vacio el campo.
                 if($val['field'] == '') {
                     $resp['error'] = true;
                     $resp['notice_error'] = $val['notice_error'];
                 }
             }
             
            if($resp['error'] == false && isset($val['validation'])):
                    switch($val['validation']) {
                        case 'numeric': // este hay que probarlo bien
                            if(!is_numeric($val['field'])) {
                                $resp['error'] = true;
                                $resp['notice_error'] = $val['notice_error'];
                            }
                            break;
                        case 'is_month':
                            if(!self::IsMonth($val['field'])) {
                                $resp['error'] = true;
                                $resp['notice_error'] = $val['notice_error'];
                            }
                            break;
                        case 'date':
                            if (!self::IsCorrectDate($val['field'])) {
                                $resp['error'] = true;
                                $resp['notice_error'] = $val['notice_error'];
                            }
                            break;
                        case 'date_is_weekend':
                            if (self::IsWeekend($val['field'])) {
                                $resp['error'] = true;
                                $resp['notice_error'] = $val['notice_error'];
                            }
                            break;
                        case 'is_correct_period':
                            $exp = explode('.', $val['extra']);
                            $x_tiempo = $exp[0];
                            $periodicidad = $exp[1];
                            if (!self::IsCorrectPeriod($x_tiempo, $periodicidad)) {
                                $resp['error'] = true;
                                $resp['notice_error'] = $val['notice_error'];
                            }
                            break;
                        case 'is_day_off':
                            if(isset($val['extra'])) {
                                $country = $val['extra'];    
                            }else {
                                $country = 1;
                            }
                            if (self::IsDayOff($val['field'], $country)) {
                                $resp['error'] = true;
                                $resp['notice_error'] = $val['notice_error'];
                            }
                            break;
                        case 'field_search':
                            $exp = explode('.', $val['table']);
                            $tabla = $exp[0];
                            $campo = $exp[1];
                            $field_search = BDConsulta::consulta('field_search', array($tabla, $campo, $val['field']), 'n');
                            if(is_null($field_search)) {
                                $resp['error'] = true;
                                $resp['notice_error'] = $val['notice_error'];
                            }
                            break;
                        case 'max':
                            $max = $val['valor_max'];
                            if($val['field'] > $max) {
                                $resp['error'] = true;
                                $resp['notice_error'] = $val['notice_error'];
                            }
                            break; 
                        default:
                        case 'min':
                            $min = $val['valor_min'];
                            if($val['field'] < $min) {
                                $resp['error'] = true;
                                $resp['notice_error'] = $val['notice_error'];
                            }
                            break; 
                        default:
                    }
            endif;
        
            if($resp['error'] == true) { // debe salir del foreach, si hay algun error en algún campo.
                break;
            }

        }
        
        return $resp;
    }
    

}// FIN DE VALIDACIONES DE FECHAS