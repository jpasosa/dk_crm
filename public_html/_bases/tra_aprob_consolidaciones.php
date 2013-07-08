<?php




class tra_aprob_consolidaciones extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->fecha  |  2->$ven_cliente_contacto  |  3->$contacto  |  4->$direccion  |  5->$telefono  |  6->$mail  |  7->$hora  |  8->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE tra_aprob_consolidaciones
            SET  fecha = $valores[1],
                    id_ven_cliente_contacto = $valores[2],
                    contacto = '$valores[3]',
                    direccion = '$valores[4]',
                    telefono_cons = '$valores[5]',
                    mail_cons = '$valores[6]',
                    hora = '$valores[7]',
                    observaciones_cons = '$valores[8]'
            WHERE id_tra_aprob_consolidaciones = $valores[0]
            ;
        ";
    }



}