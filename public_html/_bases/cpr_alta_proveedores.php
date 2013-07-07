<?php




class cpr_alta_proveedores extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->$nombre  |  2->$clave_ident  |  3->$direccion  |  4->$tipo  |  5->$observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE cpr_alta_proveedores
            SET  nombre = '$valores[1]',
                    clave_identificacion_tributaria = '$valores[2]',
                    direccion = '$valores[3]',
                    tipo = '$valores[4]',
                    observaciones = '$valores[5]'
            WHERE id_cpr_alta_proveedores = $valores[0]
            ;
        ";
    }



}