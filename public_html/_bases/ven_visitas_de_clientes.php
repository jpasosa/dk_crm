<?php

class ven_visitas_de_clientes extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal ven_visitas_de_clientes
    //  IN:     (0->$id_tabla  |  1->$id_ven_cliente  |  2->fecha  |  3->hora  |  4->sis_provincia  |  5->direccion)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_visitas_de_clientes
            SET id_ven_cliente = $valores[1],
                    fecha = $valores[2],
                    hora = '$valores[3]',
                    id_sis_provincia = $valores[4],
                    direccion = '$valores[5]'
            WHERE id_ven_visitas_de_clientes = $valores[0]
            ; 
        ";
    }


     //  Hace el update correspondiente sobre la tabla principal ven_visitas_de_clientes
    //  IN:     (0->$id_tabla_sec |  1->$id_ven_cliente_suc)
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE ven_visitas_de_clientes_sucursales
            SET id_ven_cliente_sucursales = $valores[1],
                    activo = 1
            WHERE id_ven_visitas_de_clientes_sucursales = $valores[0]
            ; 
        ";
    }


    //  Selecciona las sucursales cargadas del cliente que cargó en la tabla principal
    //  IN:     (0->id_tabla, que es id_ven_visitas_de_clientes)
    public  function get_sucursales ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_sucursales
            WHERE id_ven_cliente = $valores[0]
                    AND activo = 1
            ;
        ";
    }

    //  Selecciona las sucursales cargadas del cliente que cargó en la tabla principal
    //  IN:     (0->id_tabla, que es id_ven_visitas_de_clientes)
    public  function sucursales ($valores=NULL){
        return "
            SELECT *
            FROM ven_visitas_de_clientes_sucursales AS princ
            JOIN ven_cliente_sucursales AS sec
                ON princ.id_ven_cliente_sucursales=sec.id_ven_cliente_sucursales
            WHERE id_ven_visitas_de_clientes_proc = $valores[0]
                    AND princ.activo = 1
            ;
        ";
    }


}