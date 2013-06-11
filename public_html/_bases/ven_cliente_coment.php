<?php


class ven_cliente_coment extends FormCommon {
    


        //  Selecciona las sucursales cargadas del cliente que cargó en la tabla principal
    //  IN:     (0->id_tabla, que es id_ven_cliente)
    public  function get_tabla_suc ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_sucursales
            WHERE id_ven_cliente = $valores[0]
                        AND activo = 1
            ;
        ";
    }

    //  Selecciono los contactos que fui agregando
    //  IN:     (0->id_tabla, que es id_ven_cliente)
    public  function get_tabla_contactos ($valores=NULL){
        return "
            SELECT *, cont.telefono AS telefono_contacto, suc.telefono AS telefono_sucursal
            FROM ven_cliente_contacto AS cont
            JOIN ven_cliente_sucursales AS suc
                ON cont.id_ven_cliente_sucursales=suc.id_ven_cliente_sucursales
            WHERE suc.id_ven_cliente = $valores[0]
                        AND cont.activo=1
            ;
        ";
    }



}