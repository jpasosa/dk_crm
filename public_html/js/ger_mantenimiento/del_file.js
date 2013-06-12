$(document).ready(function() {

    //##### ELIMINAR archivo #########
    $(".files").on("click", ".del_file", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-'); //separa por -
        var id_file = clickedID[1]; 
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/ger_mantenimiento.html', // TODO: resolver que no tenga que poner el vhost local
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

    //##### ELIMINAR archivo #########
    $(".mails").on("click", ".del_mail", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-');
        var id_mail = clickedID[1]; 
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/ger_mantenimiento.html', // TODO: resolver que no tenga que poner el vhost local
                        dataType: "text",
                        data: {
                            id_mail: id_mail
                        },
                        success:function(response, status, xhr){
                            if(xhr.getResponseHeader("success_query") == 'true') {
                                $('a#mail-'+id_mail).fadeOut("slow");
                                $('a#mail-'+id_mail).fadeOut("slow");
                            }
                            FlashMessFull(xhr.getResponseHeader("success_query"), 'Mail eliminado correctamente', 'El mail no pudo ser eliminado.', false, false);
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                });
        }
    });






});