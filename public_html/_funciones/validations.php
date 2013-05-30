<?php


// valida si el numero ingresado esta entre 1 y 12.
function is_month($month) {
    $mes = trim($month);
    $mes += 0;
    if($mes >= 1 && $mes <= 12) {
        return true;
    }else{
        return false;
    }
}

function is_correct_date($date = '32/32/1600') { // paso una fecha que dé false por si viene vacio el parámetro, que no me dé error
    if($date == '') {
        $date = '32/32/1600';
    }
    $fecha_dividida = explode('/', $date);
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
}

// 1 diario, 2 semanal, 3 mensual, 4 x días, 5 x semanas, 6 anualmente, 7 x meses
// function is_correct_period($x_tiempo, $period) { // unidad de período, y el id del período.
//     $is_correct = false;
//     if($x_tiempo == 1 && $period == 1) { // puede hacer un mantenimiento dos veces al día???
//         $is_correct = true;
//     }
//     if($x_tiempo > 0 && $x_tiempo <= 5 && $period == 2) { // semanal va entre 1 y 5
//         $is_correct = true;
//     }
//     if($x_tiempo > 0 && $x_tiempo <= 20 && $period == 3) { // mensual va entre 1 y 20
//         $is_correct = true;
//     }
//     if($x_tiempo > 0 && $x_tiempo <= 28 && $period == 4) { // x días
//         $is_correct = true;
//     }
//     if($x_tiempo > 0 && $x_tiempo <= 28 && $period == 5) { // x semana
//         $is_correct = true;
//     }
//     if($x_tiempo > 0 && $x_tiempo <= 28 && $period == 6) { // anualmente
//         $is_correct = true;
//     }
//     if($x_tiempo > 0 && $x_tiempo <= 28 && $period == 7) { // x días va entre 1 y 5
//         $is_correct = true;
//     }
//     return $is_correct;
// }

// function diaSemana($ano,$mes,$dia) {
//     // 0->domingo    | 6->sabado
//     $dia= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
//         return $dia;
// }

// function is_finde($date) {
//     $dia_semana = dia_semana($date);
//     if($dia_semana == 0 || $dia_semana == 6) {
//         return true;
//     }else{
//         return false;
//     }
// }



