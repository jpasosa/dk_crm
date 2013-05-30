<?php




class forms_start_coment extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ave_comparacion_hoteles
    //  IN:     (0->$id_ven_cliente_contacto)
    //  OUT:    null o 1
    public  function select_clientes ($valores=NULL){
        return "
            SELECT *, contacto.telefono AS telefono_ven_cliente_contacto
            FROM ven_cliente_contacto AS contacto
            JOIN ven_cliente_sucursales AS sucursales
                ON contacto.id_ven_cliente_sucursales=sucursales.id_ven_cliente_sucursales
            JOIN ven_cliente AS cliente
                ON sucursales.id_ven_cliente=cliente.id_ven_cliente
            WHERE contacto.id_ven_cliente_contacto = $valores[0]
            ; 
        ";
    }

}