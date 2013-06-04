<?php


if($mant_date_unix < $date_unix):   // VERDE
    array_push($recordatory['verde'], array('nombre' => 'YTD | Mantenimientos (recordatorios)',
                                                                    'id_tabla_proc' => '',
                                                                    'fecha_inicio' => $mant_date,
                                                                    'fecha_vence' => Dates::AddDay($mant_date),
                                                                    'restan' => '1',
                                                                    'prioridad' => 'BAJA',
                                                                    ));
endif;

if($mant_date_unix == $date_unix):   // AMARILLO
    array_push($recordatory['amarillo'], array('nombre' => 'YTD | Mantenimientos (recordatorios)',
                                                                    'id_tabla_proc' => '',
                                                                    'fecha_inicio' => $mant_date,
                                                                    'fecha_vence' => Dates::AddDay($mant_date),
                                                                    'restan' => '0',
                                                                    'prioridad' => 'MEDIA',
                                                                    ));
endif;

if($mant_date_unix > $date_unix):   // ROJO
    array_push($recordatory['rojo'], array('nombre' => 'YTD | Mantenimientos (recordatorios)',
                                                                    'id_tabla_proc' => '',
                                                                    'fecha_inicio' => $mant_date,
                                                                    'fecha_vence' => Dates::AddDay($mant_date),
                                                                    'pasaron' => 'resolver esto',
                                                                    'prioridad' => 'ALTA',
                                                                    ));
endif;

