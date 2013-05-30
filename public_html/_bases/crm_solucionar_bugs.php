<?php




class crm_solucionar_bugs extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->reporte)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE crm_solucionar_bugs
            SET  asunto = '$valores[1]',
                    reporte = '$valores[2]'
            WHERE id_crm_solucionar_bugs = $valores[0]
            ; 
        ";
    }



}