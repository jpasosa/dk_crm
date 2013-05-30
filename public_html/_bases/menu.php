<?php



class menu extends FormCommon {

        // todos los gastos de una planificacion de gerencia en un proceso dado y que estén activos.
    public  function new_forms ($valores=NULL){
        return "
            SELECT p.nombre AS nombre, p.proceso AS link
            FROM sis_procesos_flujos_dias AS pd
            JOIN sis_procesos AS p
                ON p.id_sis_procesos = pd.id_sis_procesos
            WHERE id_sis_areas = $valores[0]
                            AND proceso_orden = 1
            ; 
        ";
    }

}
