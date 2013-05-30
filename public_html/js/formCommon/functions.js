function FlashMess(type, message) { // 1er version de FlasMess, + simple que la siguiente. . . . // Son mensajes Flash por AJAX
     if(message != '') {
         if (type == "error") {
            $('div.flash_error').css('display', 'block');
                $('div.flash_error').text('');
                $("div.flash_error").append(message);
                setTimeout(function() {
                    $('div.flash_error').fadeOut(3000, function(){ 
                    $('div.flash_error').css('display', 'none');
                });
            }, 4500);

        }else if (type == "notice") {
                $('div.flash_notice').css('display', 'block');
                $('div.flash_notice').text('');
                $("div.flash_notice").append(message);
                setTimeout(function() {
                    $('div.flash_notice').fadeOut(3000, function(){ 
                    $('div.flash_notice').css('display', 'none');
                });
            }, 3500);
        }else{
            // no especificó notice o error. no hace nada.
        }
    }else{
        // mensaje vacio, no hace nada.
    }
    setTimeout(function() {
                    return true;
                }, 5000);
};



function FlashMessFull(error, notice_mess, error_mess, reload, top) { // Son mensajes Flash por AJAX, obteniendo el objeto respuesta del POST
    // alert(error);
    if(!notice_mess || notice_mess == ' ') {
        var notice_mess = 'La acción fue correctamente realizada';
    }
    if(!error_mess || error_mess == ' ') {
        var error_mess = 'La acción reciente no pudo ser ejecutada.';
    }
     if(error == 'false') {
        // $('html, body').animate({ scrollTop: 0 }, 'slow'); // voy arriba
        $('div.flash_error').css('display', 'block');
        $('div.flash_error').text('');
        $("div.flash_error").append(error_mess);
        if(top) {
            $('html, body').animate({ scrollTop: 0 }, 'slow');    
        }
        setTimeout(function() {
            $('div.flash_error').fadeOut(3000, function(){ 
            $('div.flash_error').css('display', 'none');
        });
    }, 3500);
    }else if (error == 'true') {
        
            // $('html, body').animate({ scrollTop: 0 }, 'slow'); // voy arriba
            $('div.flash_notice').css('display', 'block');
            $('div.flash_notice').text('');
            $("div.flash_notice").append(notice_mess);
            if(top) {
                $('html, body').animate({ scrollTop: 0 }, 'slow');    
            }
            $.doTimeout( 4000, function(){
                $('div.flash_notice').fadeOut(2000, function() {
                    $('div.flash_notice').css('display', 'none');    
                });
            }); 
                
            // 
        //     setTimeout(function() {
        //         $('div.flash_notice').fadeOut(3000, function(){ 
        //         $('div.flash_notice').css('display', 'none');
        //     });
        // }, 2500);
    } else{
        // alert('debe entrar aca');
        // $('html, body').animate({ scrollTop: 0 }, 'slow'); // voy arriba
        $('div.flash_error').css('display', 'block');
        $('div.flash_error').text('');
        $("div.flash_error").append('Error inesperado.');
        if(top) {
            $('html, body').animate({ scrollTop: 0 }, 'slow');    
        }
        setTimeout(function() {
            $('div.flash_error').fadeOut(3000, function(){ 
            $('div.flash_error').css('display', 'none');
        });
        }, 3500);
    }
    if(reload) {
        setTimeout(function() {
        location.reload(true);
        }, 5000);    
    }
    
}

$("table tr:nth-child(even)").addClass("striped"); // hace el sebra

function reiniciar() {
    setTimeout(function() {
    location.reload();
}, 6000);
}

// Hace desaparecer los carteles de errores o de noticias después de un tiempo. Carteles comunes, sin ajax.

setTimeout(function() {
    $('div.disp_error').css('display', 'none');
}, 5000);
setTimeout(function() {
    $('div.disp_notice').css('display', 'none');
}, 5000);


// Hace el sebra cuando recarga la página
$(document).ready(function() {
    $("table tr:nth-child(even)").addClass("striped"); // hace el sebra
})






    
