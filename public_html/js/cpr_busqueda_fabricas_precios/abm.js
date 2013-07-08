$(document).ready(function() {

    //##### ELIMINAR PRODUCTO #########
    $("body").on("click", ".del_prod", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_prod = id_prod_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: "/cpr_busqueda_fabricas_precios.html",
                        dataType: "text",
                        data: {
                            id_prod_del: id_prod_del
                        },
                        success:function(response, status, xhr){
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Eliminado con éxito', 'El producto NO pudo ser eliminado.', false, false)
                            $('tr#id_prod-' + id_prod_del).fadeOut("slow");
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
    $("body").on("click", ".edit_prod", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_prod = id_prod_edit = clickedID[1];
        var selector = "tr#id_prod-" + id_prod + " span.producto";
        var producto = $(selector).text();
        var selector = "tr#id_prod-" + id_prod + " span.precio";
        var precio = $(selector).text();
        var selector = "tr#id_prod-" + id_prod + " span.detalle";
        var detalle = $(selector).text();
        var selector = "tr#id_prod-" + id_prod + " span.cantidad_min";
        var cantidad_min = $(selector).text();
        jQuery.ajax({
                type: "POST",
                url: "/cpr_busqueda_fabricas_precios.html",
                dataType: "text",
                data: {
                    id_prod_edit: id_prod_edit
                },
                success:function(response, status, xhr){
                    // $("body").append(response);
                    $("input.producto").val(producto);
                    $("input.precio").val(precio);
                    $("input.detalle").val(detalle);
                    $("input.cantidad_min").val(cantidad_min);
                    $("input.producto").focus();
                    $('tr#id_prod-' + id_prod).fadeOut("slow");
                    // FlashMessFull(xhr.getResponseHeader("success_query"), 'Gasto preparado para ser editado', 'El Gasto que va a editar no se pasó a inactivo. Luego eliminelo de la lista.', false, false)
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });

});





