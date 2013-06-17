$(document).ready(function() {

    //##### ELIMINAR cliente #########
    $("body").on("click", ".del_cliente", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-'); //separa por -
        var id_cliente = id_cliente_del = clickedID[1]; 
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/ave_campania.html',
                        dataType: "text",
                        data: {
                            id_cliente_del: id_cliente_del
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('tr#id_cliente-' + id_cliente).fadeOut("slow");
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Cliente eliminado correctamente', 'El cliente no pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });


   
    //##### EDITAR CLIENTE  #########
    $("body").on("click", ".edit_cliente", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_cliente = id_cliente_edit = clickedID[1];
        var selector = "tr#id_cliente-" + id_cliente + " td span.hora";
        var hora = $(selector).text();
        var cliente = $("tr#id_cliente-" + id_cliente + " td span.cliente").attr('id');
        var contacto = $("tr#id_cliente-" + id_cliente + " td span.contacto").attr('id');
        var selector_cliente = "select.cliente option[value=" + cliente + "]";
        var selector_contacto = "select.contacto option[value=" + contacto + "]";
        jQuery.ajax({
                type: "POST", 
                url: "/ave_campania.html",
                dataType: "text",
                data: {
                    id_cliente_edit: id_cliente_edit
                },
                success:function(response){
                    $("input.horario").val(hora);
                    $(selector_cliente).attr('selected','selected');
                    $(selector_contacto).attr('selected','selected');
                    $("input.horario").focus();
                    $('tr#id_cliente-'+id_cliente).fadeOut("slow");
                    // $(".registros").append(response);
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });




});