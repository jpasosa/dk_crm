$(document).ready(function() {

    //##### ELIMINAR producto #########
    $("body").on("click", ".del_prod", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-'); //separa por -
        var id_prod = id_prod_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/adm_audit_stock_limpieza_detalle/1.html',
                        dataType: "text",
                        data: {
                            id_prod_del: id_prod_del
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('tr#id_prod-' + id_prod).fadeOut("slow");
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Producto eliminado correctamente', 'El producto no pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });



    //##### EDITAR PRODUCTO  #########
    $("body").on("click", ".edit_prod", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_prod = id_prod_edit = clickedID[1];

        var producto = $("tr#id_prod-" + id_prod + " td span.referencia").attr('id');
        var problema = $("tr#id_prod-" + id_prod + " td span.problema").attr('id');
        var selector_producto = "select.referencia option[value=" + producto + "]";
        var selector_problema = "select.problemas option[value=" + problema + "]";
        jQuery.ajax({
                type: "POST",
                url: '/adm_audit_stock_limpieza_detalle/1.html',
                dataType: "text",
                data: {
                    id_prod_edit: id_prod_edit
                },
                success:function(response){
                    $('tr#id_prod-' + id_prod).fadeOut("slow");
                    //$("select.referencia").focus();
                    // $(".registros").append(response);
                    $(selector_producto).attr('selected','selected');
                    $(selector_problema).attr('selected','selected');
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });




});