<?php



// function convert_to_unix($date) {
//     $fecha_dividida = explode('/', $date);
//     $dia = $fecha_dividida[0];
//     $mes = $fecha_dividida[1];
//     $anio = $fecha_dividida[2];
//     $fecha_unix = mktime(0 ,0 ,0 ,$mes,$dia,$anio);
//     return $fecha_unix;
// }

// function convert_to_phpdate($date) {
//     return gmdate("d/m/Y", $date);
// }


// function dia_semana($fecha) {
//     $fecha_dividida = explode('/', $fecha);
//     $dia = $fecha_dividida[0];
//     $mes = $fecha_dividida[1];
//     $anio = $fecha_dividida[2];
//     // 0->domingo    | 6->sabado
//     $dia= date("w",mktime(0, 0, 0, $mes, $dia, $anio));
//     return $dia;
// }

// function dif_fechas($fecha_inicio, $fecha_final) {
//     $f_unix_inicio = convert_to_unix($fecha_inicio);
//     $f_unix_final = convert_to_unix($fecha_final);
//     $dif_unix = $f_unix_final - $f_unix_inicio;
//     $dias_diferencia = $dif_unix / (60 * 60 * 24);
//     $dias_diferencia = abs($dias_diferencia);
//     $dias_diferencia = floor($dias_diferencia);
//     return $dias_diferencia;
// }

// function add_day($date) {
//     if(is_correct_date($date)) {
//         $date_unix = convert_to_unix($date);    
//         $date_add_one_day = $date_unix + 60 * 60 * 24;
//         $date_add_one_day = convert_to_phpdate($date_add_one_day);
//         return $date_add_one_day; // retorna un día más. Siempre formato dd/mm/YYYY
//     }else{
//         return false; // la fecha es incorrectra
//     }
// }




// function put_comma($value) {
//     $value_comma = str_replace('.', ',', $value);                             
//     return $value_comma;
// }

// function put_point($value) {
//     $value_point = str_replace(',', '.', $value);                             
//     return $value_point;
// }

// function quitar_area($proceso) {
//     $proceso_exp = explode('_', $proceso);
//     unset($proceso_exp[0]);
//     $proceso_imp = implode('_', $proceso_exp);
//     return $proceso_imp;
// }















