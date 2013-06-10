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

    //##### ELIMINAR SUCURSALES  #########
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

    
    //##### EDITAR SUCURSALES  #########
    $("body").on("click", ".edit_suc", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_suc = id_suc_edit = clickedID[1];
        var selector = "tr#id_suc-" + id_suc + " td span.nombre_sucursal";
        var nombre_sucursal = $(selector).text();
        var selector = "tr#id_suc-" + id_suc + " td span.direccion";
        var direccion = $(selector).text();
        var selector = "tr#id_suc-" + id_suc + " td span.telefono";
        var telefono = $(selector).text();
        jQuery.ajax({
                type: "POST", 
                url: "/ven_cliente.html",
                dataType: "text",
                data: {
                    id_suc_edit: id_suc_edit
                },
                success:function(response){
                    $("input.nombre_sucursal").val(nombre_sucursal);
                    $("input.direccion").val(direccion);
                    $("input.telefono").val(telefono);
                    $("input.nombre_sucursal").focus();
                    $('tr#id_suc-'+id_suc_edit).fadeOut("slow");
                    // $(".registros").append(response);
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });

    //##### ELIMINAR CONTACTOS  #########
    $("body").on("click", ".del_contacto", function(delRef) {
        delRef.returnValue = false;
        var clickedID = this.id.split('-');
        var id_contacto_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({ 
                        type: "POST", 
                        url: "/ven_cliente.html",
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

    //##### EDITAR CONTACTOS  #########
    $("body").on("click", ".edit_contacto", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_contacto = id_contacto_edit = clickedID[1];
        var selector = "tr#id_contacto-" + id_contacto + " td span.nombre";
        var nombre = $(selector).text();
        var selector = "tr#id_contacto-" + id_contacto + " td span.apellido";
        var apellido = $(selector).text();
        var selector = "tr#id_contacto-" + id_contacto + " td span.sector";
        var sector = $(selector).text();
        var selector = "tr#id_contacto-" + id_contacto + " td span.puesto";
        var puesto = $(selector).text();
        var selector = "tr#id_contacto-" + id_contacto + " td span.nombre";
        var datos = $(selector).attr('title');
        var datos_separados = datos.split('|');
        var mail = datos_separados[0];
        var telefono = datos_separados[1];
        var celular = datos_separados[2];
        var selector = "tr#id_contacto-" + id_contacto + " td span.nombre_sucursal";
        var id_sucursal = $(selector).attr('id');
        var selector_sucursal = "select.sucursal option[value=" + id_sucursal + "]";
        jQuery.ajax({
                type: "POST", 
                url: "/ven_cliente.html",
                dataType: "text",
                data: {
                    id_contacto_edit: id_contacto_edit
                },
                success:function(response){
                    $("input.nombre_cont").val(nombre);
                    $("input.apellido_cont").val(apellido);
                    $("input.sector").val(sector);
                    $("input.puesto").val(puesto);
                    $("input.celular_cont").val(celular);
                    $("input.telefono_cont").val(telefono);
                    $("input.mail_cont").val(mail);
                    $(selector_sucursal).attr('selected','selected');
                    $("input.nombre_cont").focus();
                    $('tr#id_contacto-'+id_contacto_edit).fadeOut("slow");
                    // $(".registros").append(response);
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });




});