<!-- Estilos -->
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<link href="css/formCommon.css" rel="stylesheet" type="text/css" />
<link href="css/form16.css" rel="stylesheet" type="text/css" />

<!-- FAVICON -->
<link rel="shortcut icon" href="_php/favicon.ico" >
<!-- Javascript -->
<script src="js/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery_172.js"></script>
<script type="text/javascript" src="js/form16/add-del-edit-hotel.js"></script>
<script type="text/javascript" src="js/form16/file-upload.js"></script>
<!-- <script type="text/javascript" src="js/formCommon/functions.js"></script> -->
<script type="text/javascript" src="js/easySlider1.7.js"></script> <!-- SLIDER -->
<script type="text/javascript" src="js/formCommon/jquery.ba-dotimeout.min.js"></script> <!-- TimeOut -->
<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script> 
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script> <!-- FANCY BOX -->
<script type="text/javascript" src="js/pngfix.js"></script><!-- PNG FIX -->
<!--[if IE 6]>
        <script src="js/pngfix.js"></script>
        <script>
            DD_belatedPNG.fix('.png_bg, img');
        </script>
        
<![endif]-->

<!-- FUNCION PARA IR ARRIBA -->
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
    $('a[rel=top]').bind('click',function(event){
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500,'easeInOutExpo');
        /*
        if you don't want to use the easing effects:
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1000);
        */
        event.preventDefault();
    });
});
    </script>
    <script type="text/javascript">
/* FANCYBOX PARA LOS POPUPS. */
        $(document).ready(function() {
                $('a.fb_dynamic').each(function(){  
                    var dWidth  = parseInt($(this).attr('href').match(/width=[0-9]+/i)[0].replace('width=',''));  
                    var dHeight     =  parseInt($(this).attr('href').match(/height=[0-9]+/i)[0].replace('height=',''));  
                    $(this).fancybox({  
                        'width':dWidth,  
                        'height':dHeight, 
                        'overlayColor': "#000", 
                        'autoScale'         : false,  
                        'transitionIn'      : 'elastic',  
                        'transitionOut'     : 'fade',  
                        'type'          : 'iframe'  
                    });  
                });  
});
</script>



<!-- <body id="Cuenta"> -->
<div id="wrapper" >
    <section>
        <div id="head">
            <div id="logo" class="png_bg"><a href="index.html"></a></div>
        </div>
    </section>
    <section>
        <div id="mainMenu" style="height:30px;"></div>
        <div id="bandaColor" class="azul"></div>
    </section>

<section>
    <div id="contenido" style="padding-top:0px;">
        <div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;">
        </div>
        <div id="fondoCatalogo" style="background:url(img/fondos/bg_cuenta.jpg) center top repeat-y;">
            <div id="izquierda" style="width:247px;">
                <ul id="menuCategoriasIzq">
                    <li class="first"><a href="#" class="active">► Tareas</a>
                        <ul>
                            <li><a href="#" class="subactive">» Pedido de compras</a></li>
                            <li><a href="#" class="sub">» Pedido de nuevo servicio</a></li>
                            <li><a href="#" class="sub">» Reclamos</a></li>
                            <li><a href="#" class="sub">» Propuestas de mejoras</a></li>
                        </ul>
                    </li>
                    <li><a href="#">► Informes</a>
                        <ul>
                            <li><a href="#" class="sub">» Agenda</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
                
            <div class="form16" id="proc-{$id_proces}"> <!-- lo uso para ver el id del proceso -->
                <div class="flash_error"></div> <!-- estos van a saltar por AJAX -->
                <div class="flash_notice"></div>
                {if $flash_error != '' }
                    <div class="disp_error"> {$flash_error} </div> <!-- estos vienen del controlador -->                    
                {/if}
                {if $flash_notice != '' }
                    <div class="disp_notice"> {$flash_notice} </div> <!-- estos vienen del controlador -->                    
                {/if}
                <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
                    <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
                    <hr />
                    <h1 class="azul bold"><span class="txt22 normal">Asistente de ventas</span> | Comparación Hoteles</h1>
                    <hr />
                    <p class="txt10 uppercase">Fecha de inicio del trámite: <span class="azul">10/19/2012</span></p>
                    <hr />
                    <p>Empleado: <span class="azul">Gabriel Pujol</span></p>
                    <p>País / ciudad: <span class="azul">Colombia / Honduras</span></p>
                    <p>Fecha de inicio: <span class="azul">10/25/2012</span></p>
                    <p>Fecha fin: <span class="azul">12/26/2012</span></p>
                    <p>Observaciones: <span class="azul">Los gastos de hotel corren por cuenta del cliente.</span></p>

                    <hr />
                    <p class="azul txt18" style="margin:0px 0 10px 0;">Hoteles:</p>
                    <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
                        <tr>
                            <td width="70" bgcolor="#4685CA"><p class="blanco">Hotel </p></td>
                            <td width="200" align="left" bgcolor="#4685CA"><p class="blanco">Comentario</p></td>
                            <td width="50" align="center" bgcolor="#4685CA"><p class="blanco">Costo</p></td>
                            <td width="60" align="center" bgcolor="#4685CA"><p class="blanco">Archivo</p></td>
                            <td width="70" align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
                        </tr>

                        <!-- traigo de la base de datos, los hoteles cargados -->
                        {foreach item=ho from=$hoteles_opc }
                        <tr id="id_hotel-{$$ho[id_ave_comparacion_hoteles_opc]}">
                            <td>
                                <!-- <input type="text" class="campo" name="hotel" value="{$$ho[hotel]}" readonly="true" /> -->
                                <span class="hotel">{$$ho[hotel]}</span>
                            </td>
                            <td>
                                <!-- <input type="text" class="campo" name="comentario" value="{$$ho[comentario]}" readonly="true" /> -->
                                <span class="comentario">{$$ho[comentario]}</span>
                            </td>
                            <td align="center">
                                <!-- <input type="text" class="campo" name="costo" value="{$$ho[costo]}" readonly="true" /> -->
                                <span class="costo">{$$ho[costo]}</span>
                            </td>
                            <td class="archivo">
                                <span class="archivo">{$$ho[archivo]}</span>
                            </td>
                            <td>
                                <a href="#">
                                    <img id="id_hotel-{$$ho[id_ave_comparacion_hoteles_opc]}" class="del_hotel" src="img/iconos/delete.gif" alt="quitar" border="0" />
                                </a> 
                                <a href="#">
                                    <img id="id_hotel-{$$ho[id_ave_comparacion_hoteles_opc]}" class="edit_hotel" src="img/iconos/edit.gif" alt="editar" border="0" />
                                </a>
                                {if $$ho['archivo'] != "" }
                                    <a href="#">
                                        <img id="id_hotel-{$$ho[id_ave_comparacion_hoteles_opc]}" class="download_hotel"
                                                src="img/iconos/file_download.png" alt="bajar" border="0" title="{$$ho[archivo]}"
                                                width="16" height="16" />
                                    </a>
                                {/if}   
                            </td>
                        </tr>
                        {/foreach}
                        <tr> <!-- aqui cargo un nuevo hotel -->
                            <form name="add_hotel" action="/form16.html" method="post" enctype="multipart/form-data" >
                                <td class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                                    <div class="hotel">
                                        <label> Hotel: </label>
                                        <input name="hotel" class="hotel" type="text" />
                                    </div>
                                    <div class="comentario">
                                        <label> Comentario: </label>
                                        <input name="comentario" class="comentario" type="text" />
                                    </div>
                                    <div class="costo">
                                        <label> Costo: </label>
                                        <input name="costo" class="costo" type="text" />
                                    </div>
                                    <div class="archivo">
                                        <label class="archivo"> Archivo </label>
                                        <input type="file" class="archivo" name="archivo" value="quepasavieja" />
                                    </div>
                                     <input class="id_proc" name="id_proc" type="hidden" value="{$id_proces}" />
                                     <input class="viene_de_edit" name="viene_de_edit" type="hidden" value="false" />
                                     <input class="nombre_archivo" name="nombre_archivo" type="hidden" value="" />
                                     <input class="agregar_hotel" type="submit" value="Agregar">
                                    <!-- <button class="add_hotel" id="add_hotel" type="button"> Agregar </button> -->
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <td height="40" colspan="5" align="right" bgcolor="#86AEDB">
                                <a href="formas_de_pago.html" class="eliminar bold uppercase">enviar</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
            <br style="clear:both;" />
        </div>
        <div id="foot"> </div>
    </div>
</section>
</div>
<!-- </body> -->
</html>
