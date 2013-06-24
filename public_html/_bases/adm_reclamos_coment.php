<?php




class adm_reclamos_coment extends FormCommon {




    //  Selecciona el proveedor
    //  IN:     (0->$id_crp_proveedores)
    //  OUT:
    public  function get_crp_proveedor ($valores=NULL){
        return "
            SELECT  nombre
            FROM cpr_proveedores
            WHERE id_cpr_proveedores = $valores[0]
            ;
        ";
    }

    //  Selecciona el ven_cliente_contacto
    //  IN:     (0->$id_ven_cliente_contacto)
    //  OUT:
    public  function get_ven_cliente_contacto ($valores=NULL){
        return "
            SELECT  vcc.nombre, vcc.apellido, suc.nombre_sucursal
            FROM ven_cliente_contacto AS vcc
            JOIN ven_cliente_sucursales AS suc
                ON vcc.id_ven_cliente_sucursales=suc.id_ven_cliente_sucursales
            WHERE id_ven_cliente_contacto = $valores[0]
            ;
        ";
    }

     //  Selecciona el ven_cliente
    //  IN:     (0->$id_ven_cliente_contacto)
    //  OUT:
    public  function get_ven_cliente ($valores=NULL){
        return "
            SELECT  vc.empresa
            FROM ven_cliente_contacto AS vcc
            JOIN ven_cliente_sucursales AS suc
                ON vcc.id_ven_cliente_sucursales=suc.id_ven_cliente_sucursales
            JOIN ven_cliente AS vc
                ON suc.id_ven_cliente=vc.id_ven_cliente
            WHERE id_ven_cliente_contacto = $valores[0]
            ;
        ";
    }



}