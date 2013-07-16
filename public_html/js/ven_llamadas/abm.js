$(document).ready(function() {

    //##### ELIMINAR cliente #########
    $("body").on("click", ".del_tema", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-'); //separa por -
        var id_tema = id_tema_del = clickedID[1];
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/ven_llamadas/1.html', // le pongo el 1, por que se debe mandar un id a ven_llamadas si no no funca.
                        dataType: "text",
                        data: {
                            id_tema_del: id_tema_del
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('tr#id_tema-' + id_tema).fadeOut("slow");
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Tema eliminado correctamente', 'El tema no pudo ser eliminado.', false, false)
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });



    //##### EDITAR CLIENTE  #########
    $("body").on("click", ".edit_tema", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_tema = id_tema_edit = clickedID[1];
        var selector = "tr#id_tema-" + id_tema + " td span.tema";
        var tema = $(selector).text();
        var tema_tocado = $("tr#id_tema-" + id_tema + " td span.tema_tocado").attr('id');
        var selector_tema_tocado = "select.tema_tocado option[value=" + tema_tocado + "]";
        jQuery.ajax({
                type: "POST",
                url: '/ven_llamadas/1.html', // le pongo el 1, por que se debe mandar un id a ven_llamadas si no no funca.
                dataType: "text",
                data: {
                    id_tema_edit: id_tema_edit
                },
                success:function(response){
                    $("textarea.tema").val(tema);
                    $(selector_tema_tocado).attr('selected','selected');
                    $("textarea.tema").focus();
                    $('tr#id_tema-'+id_tema).fadeOut("slow");
                    // $(".registros").append(response);
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
        });
    });




});