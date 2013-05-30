<?php




class ave_comparacion_aerolineas extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ave_comparacion_hoteles
    //  IN:     (0->$id_tabla  |  1->$pais_ciudad  |  2->fecha_inicio  |  3->fecha_fin  |  4->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ave_comparacion_aerolineas
            SET id_sis_provincia = $valores[1],
                    fecha_inicio = $valores[2],
                    fecha_fin = $valores[3],
                    observaciones = '$valores[4]'
            WHERE id_ave_comparacion_aerolineas = $valores[0]
            ; 
        ";
    }

    //  Hace el update correspondiente sobre la tabla secundaria "ave_comparacion_hoteles_opc"
    //  IN:     (0->$id_tabla_sec  |  1->$hotel  |  2->comentario  |  3->costo)
    //  OUT:    null o 1. Hace el update
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE ave_comparacion_aerolineas_opc
            SET aerolinea = '$valores[1]',
                    comentario = '$valores[2]',
                    costo = $valores[3]
            WHERE id_ave_comparacion_aerolineas_opc = $valores[0]
            ; 
        ";
    }

    //  Hace el update correspondiente sobre la tabla secundaria "ave_comparacion_hoteles_opc"
    //  IN:     (0->$id_tabla_sec  |  1->$hotel  |  2->comentario  |  3->costo  |  4->archivo)
    //  OUT:    null o 1. Hace el update
    public  function update_tabla_sec_archivo ($valores=NULL){
        return "
            UPDATE ave_comparacion_aerolineas_opc
            SET aerolinea = '$valores[1]',
                    comentario = '$valores[2]',
                    costo = $valores[3],
                    archivo = '$valores[4]'
            WHERE id_ave_comparacion_aerolineas_opc = $valores[0]
            ; 
        ";
    }

}