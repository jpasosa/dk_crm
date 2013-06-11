<?php




class adm_propuestas_mejoras extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE adm_propuestas_mejoras
            SET  asunto = '$valores[1]',
                    mejora = '$valores[2]'
            WHERE id_adm_propuestas_mejoras = $valores[0]
            ; 
        ";
    }



}