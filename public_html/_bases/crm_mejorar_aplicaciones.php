<?php




class crm_mejorar_aplicaciones extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->reporte)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE crm_mejorar_aplicaciones
            SET  asunto = '$valores[1]',
                    mejora = '$valores[2]'
            WHERE id_crm_mejorar_aplicaciones = $valores[0]
            ; 
        ";
    }



}