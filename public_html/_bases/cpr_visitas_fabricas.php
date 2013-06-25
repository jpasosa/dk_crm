<?php

class cpr_visitas_fabricas extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal cpr_visitas_fabricas
    //  IN:     (0->$id_tabla  |  1->$fabrica  |  2->id_sis_provincia  |  3->$fecha_inicio  |  4->$fecha_fin  |  5->$costo   |  6->$observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE cpr_visitas_fabricas
            SET fabrica = '$valores[1]',
                    id_sis_provincia = $valores[2],
                    fecha_inicio = $valores[3],
                    fecha_fin = $valores[4],
                    costo = $valores[5],
                    observaciones = '$valores[6]'
            WHERE id_cpr_visitas_fabricas = $valores[0]
            ;
        ";
    }

}