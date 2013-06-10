<?php

class ven_cliente extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal ven_cliente
    //  IN:     (0->$id_tabla  |  1->$empresa  |  2->sitio  |  3->cuit  |  4->telefono  |  5->mail  |  6->observaciones  |  7->id_sis_provincia )
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_cliente
            SET empresa = '$valores[1]',
                    sitio_web = '$valores[2]',
                    identificacion_tributaria = '$valores[3]',
                    telefono = '$valores[4]',
                    mail_solicitante = '$valores[5]',
                    observaciones = '$valores[6]',
                    habilitado = 1,
                    id_sis_provincia = $valores[7]
            WHERE id_ven_cliente = $valores[0]
            ; 
        ";
    }


    //  inserta en ven_cliente_sucursales
    //  IN:     (0->id_ven_cliente  |  1->nombre_sucursal  |  2->direccion |  3->telefono)
    public  function insert_suc ($valores=NULL){
        return "
            INSERT INTO ven_cliente_sucursales
            (id_ven_cliente, nombre_sucursal, direccion, telefono, activo)
            VALUES
            ($valores[0], '$valores[1]', '$valores[2]', '$valores[3]', 1)
            ; 
        ";
    }


    //  Selecciona las sucursales cargadas del cliente que cargó en la tabla principal
    //  IN:     (0->id_tabla, que es id_ven_cliente)
    public  function get_tabla_suc ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_sucursales
            WHERE id_ven_cliente = $valores[0]
            ;
        ";
    }


    //  Selecciono los contactos que fui agregando
    //  IN:     (0->id_tabla, que es id_ven_cliente)
    public  function get_tabla_contactos ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_contacto AS cont
            JOIN ven_cliente_sucursales AS suc
                ON cont.id_ven_cliente_sucursales=suc.id_ven_cliente_sucursales
            WHERE suc.id_ven_cliente = $valores[0]
                        AND suc.activo=1
            ;
        ";
    }


    //  Selección de sucursales en contacto.
    //  IN:     (0->id_tabla, que es id_ven_cliente)
    public  function select_suc ($valores=NULL){
        return "
            SELECT id_ven_cliente_sucursales AS id, nombre_sucursal AS nombre
            FROM ven_cliente_sucursales
            WHERE id_ven_cliente = $valores[0]
            ;
        ";
    }

    //  Hago el insert en ven_cliente_contacto
    //  IN:     (0->nombre   |  1->apellido  |  2->sucursal  |  3->mail  |  4->telefono  |  5->celular  |  6->sector  |  7->puesto)
    public  function insert_contacto ($valores=NULL){
        return "
             INSERT INTO ven_cliente_contacto
                (nombre, apellido, id_ven_cliente_sucursales, mail, telefono, celular, sector, puesto, activo)
            VALUES
                ('$valores[0]', '$valores[1]', $valores[2], '$valores[3]', '$valores[4]', '$valores[5]', '$valores[6]', '$valores[7]', 1)
            ;
        ";
    }







}