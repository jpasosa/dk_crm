<?php




class dis_recibir_trabajar_artes extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE dis_recibir_trabajar_artes
            SET  asunto = '$valores[1]',
                    observaciones = '$valores[2]'
            WHERE id_dis_recibir_trabajar_artes = $valores[0]
            ; 
        ";
    }



}