<?php

class forms_reset extends FormCommon {
    
    //  trae un registro de ven_cliente_contacto
    //  IN:     (0->id_ven_cliente_contacto)
    //  OUT:    nos dice si existe user y pass }
    public  function select_ven_cliente_contacto ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_contacto AS contacto
            JOIN ven_cliente_sucursales AS sucursales
                ON contacto.id_ven_cliente_sucursales=sucursales.id_ven_cliente_sucursales
            JOIN ven_cliente AS cliente
                ON sucursales.id_ven_cliente=cliente.id_ven_cliente
            WHERE id_ven_cliente_contacto = $valores[0]
            ; 
        ";
    }

}