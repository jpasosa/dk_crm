<?php


if($mant_date_unix > $date_unix):   // VERDE
    array_push($recordatory['verde'], array('id_tabla_proc' => $id_tabla_proc,
                                                                    'proceso_nombre' => 'YTD | Mantenimientos (recordatorios)',
                                                                    'proceso_proceso' => 'adm_ytd_mantenimiento_recordatorio',
                                                                    'fecha_inicio' => $mant_date,
                                                                    'fecha_vence' => Dates::AddDay($mant_date),
                                                                    'restan_dias' => '1',
                                                                    'pasaron_dias' => '1',
                                                                    'prioridad' => 'BAJA',
                                                                    ));
endif;

if($mant_date_unix == $date_unix):   // AMARILLO
    array_push($recordatory['amarillo'], array('id_tabla_proc' => $id_tabla_proc,
                                                                    'proceso_nombre' => 'YTD | Mantenimientos (recordatorios)',
                                                                    'proceso_proceso' => 'adm_ytd_mantenimiento_recordatorio',
                                                                    'fecha_inicio' => $mant_date,
                                                                    'fecha_vence' => Dates::AddDay($mant_date),
                                                                    'restan_dias' => '1',
                                                                    'pasaron_dias' => '1',
                                                                    'prioridad' => 'MEDIA',
                                                                    ));
endif;

if($mant_date_unix < $date_unix):   // ROJO
    array_push($recordatory['rojo'], array('id_tabla_proc' => $id_tabla_proc,
                                                                    'proceso_nombre' => 'YTD | Mantenimientos (recordatorios)',
                                                                    'proceso_proceso' => 'adm_ytd_mantenimiento_recordatorio',
                                                                    'fecha_inicio' => $mant_date,
                                                                    'fecha_vence' => Dates::AddDay($mant_date),
                                                                    'restan_dias' => '1',
                                                                    'pasaron_dias' => '1',
                                                                    'prioridad' => 'ALTA',
                                                                    ));
endif;


