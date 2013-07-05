<?php




class rh_rendicion_dias_enfermedad extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->fecha_inicio  |  2->fecha_fin  |  3->cant_dias  |  4->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE rh_rendicion_dias_enfermedad
            SET  fecha_inicio = $valores[1],
                    fecha_fin = $valores[2],
                    cantidad_dias = $valores[3],
                    observaciones = '$valores[4]'
            WHERE id_rh_rendicion_dias_enfermedad = $valores[0]
            ;
        ";
    }



}