<?php




class adm_pedido_caja_chica extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal de ave_comparacion_hoteles
    //  IN:     (0->$id_tabla  |  1->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE adm_pedido_caja_chica
            SET observaciones = '$valores[1]'
            WHERE id_adm_pedido_caja_chica = $valores[0]
            ;
        ";
    }

    //  Hace el update correspondiente sobre la tabla secundaria "ave_comparacion_hoteles_opc"
    //  IN:     (0->$id_tabla_sec  |  1->$id_sis_cuentas  |  2->detalle  |  3->factura  |  4->id_sis_areas  |  5->monto  |  6->id_cpr_proveedores)
    //  OUT:    null o 1. Hace el update
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE adm_pedido_caja_chica_detalle
            SET activo = 1,
                    id_sis_cuentas = $valores[1],
                    detalle = '$valores[2]',
                    factura = '$valores[3]',
                    id_sis_areas = $valores[4],
                    monto = $valores[5],
                    id_cpr_proveedores = $valores[6]
            WHERE id_adm_pedido_caja_chica_detalle = $valores[0]
            ;
        ";
    }


    //  Hace el update correspondiente sobre la tabla secundaria "ave_comparacion_hoteles_opc"
    //  IN:     (0->$id_tabla)
    //  OUT:    null o 1. Hace el update
    public  function get_file ($valores=NULL){
        return "
            SELECT archivo
            FROM adm_pedido_caja_chica
            WHERE id_adm_pedido_caja_chica = $valores[0]
            ;
        ";
    }

    // busca la descripcion en tabla sis_cuentas
    public  function search_descripcion ($valores=NULL){
        return "
            SELECT descripcion
            FROM sis_cuentas
            WHERE cuenta = $valores[0]
            ;
        ";
    }

    // busca la descripcion en tabla sis_cuentas
    public  function search_cuenta ($valores=NULL){
        return "
            SELECT cuenta
            FROM sis_cuentas
            WHERE descripcion = '$valores[0]'
            ;
        ";
    }

}