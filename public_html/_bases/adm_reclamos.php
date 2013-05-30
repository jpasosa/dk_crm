<?php

class adm_reclamos extends FormCommon {
    
    //  Hace el update en la tabla principal
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->reclamo  |  3->id_ven_cliente_contacto  |  4->id_crp_proveedores)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE adm_reclamos
            SET asunto = '$valores[1]',
                    reclamo = '$valores[2]',
                    id_ven_cliente_contacto = $valores[3],
                    id_crp_proveedores = $valores[4]
            WHERE id_adm_reclamos = $valores[0]
            ; 
        ";
    }
}