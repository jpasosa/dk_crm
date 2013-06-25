<?php

class cpr_visitas_expo extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal cpr_visitas_expo
    //  IN:     (0->$id_tabla  |  1->$expo  |  2->id_sis_provincia  |  3->$fecha_inicio  |  4->$fecha_fin  |  5->$costo   |  6->$observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE cpr_visitas_expo
            SET exposicion = '$valores[1]',
                    id_sis_provincia = $valores[2],
                    fecha_inicio = $valores[3],
                    fecha_fin = $valores[4],
                    costo = $valores[5],
                    observaciones = '$valores[6]'
            WHERE id_cpr_visitas_expo = $valores[0]
            ;
        ";
    }

}