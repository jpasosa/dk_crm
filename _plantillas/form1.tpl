<!-- Estilos -->
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<link href="css/form1.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
<!-- FAVICON -->
<link rel="shortcut icon" href="_php/favicon.ico" >
<!-- Javascript -->
<script src="js/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery_172.js"></script>
<script type="text/javascript" src="js/formCommon/jquery-ui.js"></script>
<script> $(function() {$( "#datepicker_start" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script> $(function() {$( "#datepicker_end" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script type="text/javascript" src="js/form1/add-del-edit.js"></script>
<script type="text/javascript" src="js/formCommon/functions.js"></script>

<!-- SLIDER -->
<script type="text/javascript" src="js/easySlider1.7.js"></script>
<!-- FANCY BOX -->
<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<!-- PNG FIX -->
<script type="text/javascript" src="js/pngfix.js"></script>
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















































<!-- <body id="Cuenta"> --> <!-- hay que ver esto -->
<div id="wrapper" >
    <section>
        <div id="head">
            <div id="logo" class="png_bg">
                <a href="index.html"></a>
            </div>
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
                        <li class="first">
                            <a href="#" class="active">► Tareas</a>
                            <ul>
                                <li><a href="#" class="subactive">» Pedido de compras</a></li>
                                <li><a href="#" class="sub">» Pedido de nuevo servicio</a></li>
                                <li><a href="#" class="sub">» Reclamos</a></li>
                                <li><a href="#" class="sub">» Propuestas de mejoras</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">► Informes</a>
                            <ul>
                                <li><a href="#" class="sub">» Agenda</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                {html_form name="form1"}
                <div class="flash_error"></div>
                <div class="flash_notice"></div>
                <div class="form1" id="proc-{$id_proces}"> <!-- lo uso para ver el id del proceso -->
                <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
                    <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
                    
                    <hr />
                    <h1 class="azul bold">
                        <span class="txt22 normal">Solicitud de viáticos viajes</span>
                    </h1>
                    <hr />
                    <p class="txt10 uppercase">
                        Fecha de inicio del trámite:
                        <span class="azul">{$fecha_actual}</span>
                    </p>
                    <hr />
                    <p>
                        Empleado:
                        <span class="azul">{$nombre_empleado}</span>
                    </p>
                    <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
                        <tr>
                            <td width="350" bgcolor="#4685CA"><p class="blanco">Cliente </p></td>
                            <td width="122" align="left" bgcolor="#4685CA"><p class="blanco">País</p></td>
                            <td width="123" align="center" bgcolor="#4685CA"><p class="blanco">Ciudad</p></td>
                            <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
                        </tr>
                        <!-- <div class="clientes_new"> </div> -->
                        {foreach item=cl from=$clientes }
                        <tr id="id_cl-{$$cl[solicit_cliente]}">
                            <td>
                            <input type="text" class="campo" value="{$$cl[usuario]}" readonly="true" />  </td>
                            <td align="center"><input type="text" class="campo" readonly="true" value="{$$cl[pais]}" /></td>
                            <td align="center"><input type="text" class="campo" value="{$$cl[provincia]}" readonly="true" /></td>
                            <td align="center">
                                <a href="#" >
                                    <img id="id_cl-{$$cl[solicit_cliente]}" class="del_client" src="img/iconos/delete.gif" alt="quitar" border="0" />
                                </a>
                            </td>
                        </tr>
                        {/foreach}
                        <tr>
                            <td height="40" colspan="4" bgcolor="#D2E1F2">
                                <p>
                                    <select name="client" class="client">
                                        {foreach item=cl from=$clientes_show}
                                            <option value="{$$cl[id_suc]}"> {$$cl[cliente]} </option>
                                        {/foreach}    
                                    </select>
                                    <button class="add_client" id="add_client" type="button"> Agregar Cliente</button>
                                </p>
                            </td>
                        </tr>
                    </table>

                    <br /><br /><br /><br />
                    <p>
                        Fecha de inicio:
                        <span class="azul">
                            <input id="datepicker_start" class="campo start_date" name="start_date" type="text" />
                        </span>
                    </p>
                    <p>
                        Fecha fin:
                        <span class="azul">
                            <input id="datepicker_end" class="campo end_date" name="start_date" type="text" />
                        </span>
                    </p>
                    <p>
                        Monto: <span class="monto azul">{$suma_de_montos[0][MontoTot]}</span>
                    </p>
                    <p>
                        Observaciones:
                        <span class="azul">Los gastos de hotel corren por cuenta del cliente.</span>
                    </p>
                    <hr />
                    <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
                        <tr>
                            <td width="145" bgcolor="#4685CA"><p class="blanco">Referencia </p></td>
                            <td width="358" align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                            <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Monto</p></td>
                            <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
                        </tr>
                        {foreach item=gast from=$clientes_gastos }
                        <tr id="id_gast-{$$gast[id]}">
                            <td>
                                <input name="ref" type="text" id="id_gast-{$$gast[id_ref]}" class="campo"
                                            value="{$$gast[referencia]}" readonly="true" />
                            </td>
                            <td align="center">
                                <input name="detalle" type="text" class="campo"
                                            value="{$$gast[detalle]}" readonly="true" />
                            </td>
                            <td align="center">
                                <input name="monto" type="text" class="campo"
                                            value="{$$gast[monto]}" readonly="true"/>
                            </td>
                            <td align="center">
                                <a href="#">
                                    <img id="id_gast-{$$gast[id]}" class="del_gasto"
                                                src="img/iconos/delete.gif" alt="quitar" border="0" />
                                </a>
                                <a href="#">
                                    <img id="id_gast-{$$gast[id]}" class="edit_gasto"
                                                src="img/iconos/edit.gif" alt="editar" border="0" />
                                </a>
                            </td>
                        </tr>
                        {/foreach}    
                        <tr>
                            <td height="40" colspan="4" bgcolor="#D2E1F2">
                                <select name="referencias" class="referencias">
                                    {foreach item=ref from=$referencias}
                                        <option value="{$$ref[id]}"> {$$ref[ref]} </option>
                                    {/foreach}    
                                </select>
                                <input name="detalle" class="detalle" type="text" />
                                <input name="monto" class="monto" type="text" />
                                <button class="add_ref" id="add_ref" type="button">OK</button>
                            </td>
                        </tr>
                        <tr>
                            <td height="40" colspan="4">
                                <div id="campodoble" style="padding:0; width:622px; " >
                                    <label>Observaciones</label>
                                    <br />
                                    <textarea name="textarea" id="textarea" cols="45" rows="5"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td height="40" colspan="4" align="right" bgcolor="#86AEDB">
                                <a href="formas_de_pago.html" class="eliminar bold uppercase">enviar</a>
                            </td>
                {$recepcion_control}
                        </tr>
                    </table>
                </div>
                </div> <!-- cierro div class form1 id del proceso -->
                {/html_form}
                <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
                <br style="clear:both;" />
            </div>
            <!-- {/html_form} -->
            <div id="foot">

            </div>
        </div>
    </section>
</div>
<!-- </body> -->
</html>

