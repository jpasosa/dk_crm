<?php




class cpr_proveedores extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->$nombre  |  2->$clave_ident  |  3->$direccion  |  4->$tipo  |  5->$observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE cpr_proveedores
            SET  nombre = '$valores[1]',
                    clave_identificacion_tributaria = '$valores[2]',
                    direccion = '$valores[3]',
                    tipo = '$valores[4]',
                    observaciones_proveedores = '$valores[5]'
            WHERE id_cpr_proveedores = $valores[0]
            ;
        ";
    }



}