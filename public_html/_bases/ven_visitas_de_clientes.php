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

    //  Selecciona las sucursales cargadas del cliente que cargó en la tabla principal
    //  IN:     (0->id_tabla, que es id_ven_visitas_de_clientes)
    public  function get_contactos ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_contacto AS vcc
            JOIN ven_cliente_sucursales AS vcs
                ON vcc.id_ven_cliente_sucursales=vcs.id_ven_cliente_sucursales
            JOIN ven_visitas_de_clientes_sucursales AS vvcs
                ON vcs.id_ven_cliente_sucursales=vvcs.id_ven_cliente_sucursales
            WHERE id_ven_visitas_de_clientes_proc = $valores[0]
                    AND vvcs.activo = 1
            ;
        ";
    }

    //  Selecciona las sucursales cargadas del cliente que cargó en la tabla principal
    //  IN:     (0->id_tabla_proc)
    public  function contactos ($valores=NULL){
        return "
            SELECT *
            FROM ven_visitas_de_clientes_contactos AS princ
            JOIN ven_cliente_contacto AS sec
                on princ.id_ven_cliente_contacto=sec.id_ven_cliente_contacto
            JOIN ven_cliente_sucursales AS terc
                on sec.id_ven_cliente_sucursales=terc.id_ven_cliente_sucursales
            WHERE id_ven_visitas_de_clientes_proc = $valores[0]
                    AND princ.activo = 1
            ;
        ";
    }

    //  Hace el update correspondiente sobre la tabla principal ven_visitas_de_clientes
    //  IN:     (0->$id_tabla_sec |  1->$id_ven_cliente_suc)
    public  function update_tabla_sec_contactos ($valores=NULL){
        return "
            UPDATE ven_visitas_de_clientes_contactos
            SET id_ven_cliente_contacto = $valores[1],
                    activo = 1
            WHERE id_ven_visitas_de_clientes_contactos = $valores[0]
            ; 
        ";
    }

     //  Hace el update correspondiente sobre la tabla principal ven_visitas_de_clientes
    //  IN:     (0->$id_tabla_sec |  1->$tema  |  2->$tema_tocado)
    public  function update_tabla_sec_temas ($valores=NULL){
        return "
            UPDATE ven_visitas_de_clientes_temas
            SET tema = '$valores[1]',
                    tema_tocado = $valores[2],
                    activo = 1
            WHERE id_ven_visitas_de_clientes_temas = $valores[0]
            ; 
        ";
    }


}