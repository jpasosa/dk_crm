<?php




class rh_pedido_dias_libres extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->fecha_inicio  |  2->fecha_fin  |  3->cant_dias  |  4->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE rh_pedido_dias_libres
            SET  fecha_inicio = $valores[1],
                    fecha_fin = $valores[2],
                    cantidad_dias = $valores[3],
                    observaciones = '$valores[4]'
            WHERE id_rh_pedido_dias_libres = $valores[0]
            ; 
        ";
    }



}