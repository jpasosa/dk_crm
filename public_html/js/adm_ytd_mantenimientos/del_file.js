$(document).ready(function() {

    //##### ELIMINAR archivo #########
    $("body").on("click", ".del_file", function(e) {
        e.returnValue = false;
        var clickedID = this.id.split('-'); //separa por -
        var id_file = clickedID[1]; 
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: '/adm_ytd_mantenimientos.html', // TODO: resolver que no tenga que poner el vhost local
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
});