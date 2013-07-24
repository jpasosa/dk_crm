<?php

class ven_llamadas extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal ven_llamadas
    //  IN:     (0->$$id_tabla  |  1->$id_ave_campania  |  2->$id_ven_cliente_contacto  |  3->$tipo_llamada  |  4->$prioridad  |  5->$fecha_unix  |  6->$hora  |  7->$observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_llamadas
            SET id_ave_campania = $valores[1],
                    id_ven_cliente_contacto = $valores[2],
                    tipo_llamada = '$valores[3]',
                    prioridad = '$valores[4]',
                    fecha = $valores[5],
                    hora = '$valores[6]',
                    observaciones = '$valores[7]'
            WHERE id_ven_llamadas = $valores[0]
            ;
        ";
    }

    //  IN:     (0->$id_tabla_sec  |  1->$tema  |  2->$tema_tocado)
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE ven_llamadas_temas
            SET tema = '$valores[1]',
                    tema_tocado = $valores[2],
                    activo = 1
            WHERE id_ven_llamadas_temas = $valores[0]
            ;
        ";
    }

    //  Selecciona los valores para hacer un select combinado, con
    //  IN:     (0->xxxxxxx  |  1->xxxxxxx)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function ven_cliente_contacto ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_contacto
            WHERE id_ven_cliente_sucursales = $valores[0]
            ;
        ";
    }

    // obtengo id_proc
    // Lo uso con AJAX para seleccionar
    public  function get_proc_ave_campania ($valores=NULL){
        return "
            SELECT id_ave_campania_proc
            FROM ave_campania_clientes
            WHERE id_ave_campania_clientes = $valores[0]
            ;
        ";
    }

    // obtengo id_proc
    // Lo uso con AJAX para seleccionar
    public  function get_ave_campania_clientes ($valores=NULL){
        return "
            SELECT *
            FROM ave_campania_clientes AS acc
                JOIN ven_cliente_contacto AS vcc
                    ON acc.id_ven_cliente_contacto=vcc.id_ven_cliente_contacto
                JOIN ven_cliente_sucursales AS vcs
                    ON vcc.id_ven_cliente_sucursales=vcs.id_ven_cliente_sucursales
                JOIN ven_cliente AS vc
                    ON vcs.id_ven_cliente=vc.id_ven_cliente
            WHERE acc.id_ave_campania_clientes = $valores[0]
            ;
        ";
    }

}