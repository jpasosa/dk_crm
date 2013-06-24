$(document).ready(function() {

     //##### CUENTA Y TRAE DESCRIPCIÓN #########
    $("select.cuenta").blur(function(search){
        search.returnValue = false;
        search.preventDefault();
        var cuenta = $("select.cuenta").val();
        var selector_descripcion = "select.descripcion option[value=" + cuenta + "]";
        $(selector_descripcion).attr('selected','selected');
    });

    //##### DESCRIPCIÓN Y TRAE CUENTA #########
    $("select.descripcion").blur(function(search){
        search.returnValue = false;
        search.preventDefault();
        var descripcion = $("select.descripcion").val();
        var selector_cuenta = "select.cuenta option[value=" + descripcion + "]";
        $(selector_cuenta).attr('selected','selected');
    });

    //##### ELIMINAR DETALLE #########
    $("body").on("click", ".del_detalle", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_detalle = id_detalle_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: "/adm_ytd_gastos_costos.html",
                        dataType: "text",
                        data: {
                            id_detalle_del: id_detalle_del
                        },
                        success:function(response, status, xhr){
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Eliminado con éxito', 'El detalle NO pudo ser eliminado.', false, false)
                            $('tr#id_detalle-' + id_detalle_del).fadeOut("slow");
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        // location.reload();
        // $(".observaciones textarea").focus();
    }
    });

    //##### EDITAR item tabla secundaria #########
    $("body").on("click", ".edit_detalle", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_detalle = id_detalle_edit = clickedID[1];

        var selector = "tr#id_detalle-" + id_detalle + " span.detalle";
        var detalle = $(selector).text();
        var selector = "tr#id_detalle-" + id_detalle + " span.factura";
        var factura = $(selector).text();
        var selector = "tr#id_detalle-" + id_detalle + " span.monto";
        var monto = $(selector).text();

        var cuenta = $("tr#id_detalle-" + id_detalle + " td span.cuenta").attr('id');
        var selector_cuenta = "select.cuenta option[value=" + cuenta + "]";
        var selector_descripcion = "select.descripcion option[value=" + cuenta + "]";
        var proveedor = $("tr#id_detalle-" + id_detalle + " td span.proveedor").attr('id');
        var selector_proveedor = "select.proveedor option[value=" + proveedor + "]";
        var area = $("tr#id_detalle-" + id_detalle + " td span.area").attr('id');
        var selector_area = "select.area option[value=" + area + "]";
        jQuery.ajax({
                type: "POST",
                url: "/adm_ytd_gastos_costos.html",
                dataType: "text",
                data: {
                    id_detalle_edit: id_detalle_edit
                },
                success:function(response, status, xhr){
                    // $("body").append(response);
                    $("input.detalle").val(detalle);
                    $("input.factura").val(factura);
                    $("input.monto").val(monto);
                    $(selector_cuenta).attr('selected','selected');
                    $(selector_descripcion).attr('selected','selected');
                    $(selector_proveedor).attr('selected','selected');
                    $(selector_area).attr('selected','selected');
                    $("input.detalle").focus();
                    $('tr#id_detalle-' + id_detalle).fadeOut("slow");
                    // FlashMessFull(xhr.getResponseHeader("success_query"), 'Gasto preparado para ser editado', 'El Gasto que va a editar no se pasó a inactivo. Luego eliminelo de la lista.', false, false)
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });

});





