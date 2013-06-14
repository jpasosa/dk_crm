$(document).ready(function() {

    //##### ELIMINAR EN SUCURSALES  #########
    $("body").on("click", ".del_suc", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_suc_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/ven_visitas_de_clientes.html",
                        dataType: "text",
                        data: {
                            id_suc_del: id_suc_del
                        },
                        success:function(response, status, xhr){
                            $('tr#id_suc-'+id_suc_del).fadeOut("slow");
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'La sucursal fue eliminada con éxito', 'La sucursal NO pudo ser eliminada.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
        // location.reload();
        // $("input.hotel").focus();
    });

    //##### ELIMINAR EN CONTACTOS  #########
    $("body").on("click", ".del_contacto", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_contacto_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/ven_visitas_de_clientes.html",
                        dataType: "text",
                        data: {
                            id_contacto_del: id_contacto_del
                        },
                        success:function(response, status, xhr){
                            $('tr#id_contacto-'+id_contacto_del).fadeOut("slow");
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'El contacto fue eliminado con éxito', 'El contacto no pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
        // location.reload();
        // $("input.hotel").focus();
    });

    
    //##### EDITAR EN SUCURSALES  #########
    $("body").on("click", ".edit_suc", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_suc = id_suc_edit = clickedID[1];
        var nombre_sucursal = $("tr#id_suc-" + id_suc + " td span.nombre_sucursal").attr('id');
        var selector_nombre_sucursal = "select.sucursal option[value=" + nombre_sucursal + "]";
        jQuery.ajax({
                type: "POST", 
                url: "/ven_visitas_de_clientes.html",
                dataType: "text",
                data: {
                    id_suc_edit: id_suc_edit
                },
                success:function(response){
                    $(selector_nombre_sucursal).attr('selected','selected');
                    $('tr#id_suc-'+id_suc_edit).fadeOut("slow");
                    $(input.agregar_suc).focus();
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });

    //##### EDITAR EN CONTACTOS  #########
    $("body").on("click", ".edit_contacto", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_contacto = id_contacto_edit = clickedID[1];
        var nombre = $("tr#id_contacto-" + id_contacto + " td span.nombre").attr('id');
        var selector_nombre = "select.contacto option[value=" + nombre + "]";
        jQuery.ajax({
                type: "POST", 
                url: "/ven_visitas_de_clientes.html",
                dataType: "text",
                data: {
                    id_contacto_edit: id_contacto_edit
                },
                success:function(response){
                    $(selector_nombre).attr('selected','selected');
                    $('tr#id_contacto-'+id_contacto_edit).fadeOut("slow");
                    $(input.agregar_contacto).focus();
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });




});