$(document).ready(function() {

    //##### ELIMINAR archivo #########
    $("body").on("click", ".del_file", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-'); //separa por -
        var id_file = clickedID[1]; 
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/adm_pedido_caja_chica.html', // TODO: resolver que no tenga que poner el vhost local
                        dataType: "text",
                        data: {
                            id_file: id_file
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('a#file-'+id_file).fadeOut("slow");
                                $('a#file_name-'+id_file).fadeOut("slow");
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Archivo eliminado correctamente', 'El archivo no pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });

    //##### ELIMINAR EN GASTOS  #########
    $("body").on("click", ".del_suc", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_suc_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/ven_cliente.html",
                        dataType: "text",
                        data: {
                            id_suc_del: id_suc_del
                        },
                        success:function(response, status, xhr){
                            $('tr#id_suc-'+id_suc_del).fadeOut("slow");
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'La sucursal fue eliminada con éxito', 'La sucursal no pudo ser eliminada.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
        // location.reload();
        $("input.hotel").focus();
    });

    
    //##### EDITAR EN GASTOS  #########
    $("body").on("click", ".edit_gasto", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_gasto = id_gasto_edit = clickedID[1];
        var selector = "tr#id_gastos-" + id_gasto + " td span.cuenta";
        var cuenta = $(selector).text();
        var selector = "tr#id_gastos-" + id_gasto + " td span.descripcion";
        var descripcion = $(selector).text();
        var selector = "tr#id_gastos-" + id_gasto + " td span.detalle";
        var detalle = $(selector).text();
        var proveedor = $("tr#id_gastos-" + id_gasto + " td span.proveedor").attr('id');
        var selector = "tr#id_gastos-" + id_gasto + " td span.factura";
        var factura = $(selector).text();
        var area = $("tr#id_gastos-" + id_gasto + " td span.area").attr('id');
        var selector = "tr#id_gastos-" + id_gasto + " td span.monto";
        var monto = $(selector).text();
        var selector_area = "select.area option[value=" + area + "]";
        var selector_proveedor = "select.proveedor option[value=" + proveedor + "]";
        jQuery.ajax({
                type: "POST", 
                url: "/adm_pedido_caja_chica.html",
                dataType: "text",
                data: {
                    id_gasto_edit: id_gasto_edit,
                    area: area,
                    proveedor: proveedor
                },
                success:function(response){
                    $("input.cuenta").val(cuenta);
                    $("input.descripcion").val(descripcion);
                    $("input.detalle").val(detalle);
                    $("input.factura").val(factura);
                    $("input.monto").val(monto);
                    $(selector_area).attr('selected','selected');
                    $(selector_proveedor).attr('selected','selected');
                    $("input.cuenta").focus();
                    $('tr#id_gastos-'+id_gasto_edit).fadeOut("slow");
                    // $(".registros").append(response);
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });




});