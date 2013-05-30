<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sitio Ejemplo | index</title>
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
<meta name="title" CONTENT="Sitio Ejemplo | index" />
<meta name="description" CONTENT="Manual de Programacion" />
<meta name="Keywords" CONTENT="Manual de Programacion" />
<meta name="Language" CONTENT="Spanish" />
<meta name="Revisit" CONTENT="30 days" />
<meta name="author" CONTENT="www.kirke.ws" />
<meta name="robots" CONTENT="all" />
<meta name="rating" content="General" />
<link rel="stylesheet" type="text/css" href="/css/estilos.css" />
<script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="/js/nav_seccion.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    nav_seccion("index");
});
</script>       
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta name="title" CONTENT="" />
    <meta name="description" CONTENT="" />
    <meta name="Keywords" CONTENT="" />
    <meta name="Language" CONTENT="Spanish" />
    <meta name="Revisit" CONTENT="30 days" />
    <meta name="author" CONTENT="www.kirke.ws" />
    <meta name="robots" CONTENT="all" />
    <meta name="rating" content="General" />
    <!-- Estilos -->
    <link href="_css/estilos.css" rel="stylesheet" type="text/css" />
    <link href="_css/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
    <!-- FAVICON -->
    <link rel="shortcut icon" href="_php/favicon.ico" >
    <!-- Javascript -->
    <script src="_javascript/AC_RunActiveContent.js" type="text/javascript"></script>
    <script type="text/javascript" src="_javascript/jquery_172.js"></script>
    <!-- SLIDER -->
    <script type="text/javascript" src="_javascript/easySlider1.7.js"></script>
    <!-- FANCY BOX -->    <script type="text/javascript" src="_javascript/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="_javascript/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <!-- PNG FIX -->
    <script type="text/javascript" src="_javascript/pngfix.js"></script>
    <!--[if IE 6]>
            <script src="_javascript/pngfix.js"></script>
            <script>
                DD_belatedPNG.fix('.png_bg, img');
            </script>
            
    <![endif]-->
    <!-- FUNCION PARA IR ARRIBA -->
    <script type="text/javascript" src="_javascript/jquery.easing.1.3.js"></script>
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
        $(document).ready(function() { /* FANCYBOX PARA LOS POPUPS. */
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
</head>

<body id="Cuenta">
    <div id="wrapper" >
        <section>
    <div id="head">
        <div id="logo" class="png_bg"><a href="index.html"></a></div>
    </div>
</section>
<section>
    <div id="mainMenu" style="height:30px;">
        <div id="bandaColor" class="azul"></div>
    </div>
</section>          <div id="izquierda" style="width:247px;">
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
        <li><a href="#">► Informes</a>
            <ul>
                <li><a href="#" class="sub">» Agenda</a></li>
            </ul>
        </li>
    </ul>
</div>        <section>
    <div id="contenido" style="padding-top:0px;">
        <div style="width:994px; height:23px; background:url(_imagenes/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
        <div id="fondoCatalogo" style="background:url(_imagenes/fondos/bg_cuenta.jpg) center top repeat-y;">
            
            <div id="derecha" class="catalogo" style="background:url(_imagenes/fondos/bg_cuenta.jpg) right top repeat-y;" >
            <div id="hilo"> Bienvenido: Cliente Gabriel Pujol</div>
            <hr />
            <h1 class="azul bold">Administrador</h1>
            <hr />
            <p class="verde txt18">Tareas Pendientes</p>
            <hr class="punteado" style="margin:16px 0 19px 0;" />
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
                <tr>
                    <td width="367" bgcolor="#009966"><p class="blanco">Tarea</p></td>
                    <td width="66" align="center" bgcolor="#009966"><p class="blanco">Inicio</p></td>
                    <td width="66" align="center" bgcolor="#009966"><p class="blanco">Vence</p></td>
                    <td width="69" align="center" bgcolor="#009966"><p class="blanco">Restan</p></td>
                </tr>
                <tr>
                    <td>Pedido de compras</td>
                    <td align="center" class="txt11">20/10/2012</td>
                    <td align="center" class="txt11">25/10/2012</td>
                    <td align="center" class="txt11">2 días</td>
                </tr>
                <tr>
                    <td>Propuestas de mejoras</td>
                    <td align="center" class="txt11">21/12/2012</td>
                    <td align="center" class="txt11">26/10/2012</td>
                    <td align="center" class="txt11">1 día</td>
                </tr>
                <tr>
                    <td>Propuestas de mejoras</td>
                    <td align="center" class="txt11">21/12/2012</td>
                    <td align="center" class="txt11">26/10/2012</td>
                    <td align="center" class="txt11">1 mes</td>
                </tr>
                <tr>
                    <td>Propuestas de mejoras</td>
                    <td align="center" class="txt11">21/12/2012</td>
                    <td align="center" class="txt11">26/10/2012</td>
                    <td align="center" class="txt11">4 meses</td>
                </tr>
            </table>
            <hr class="punteado" style="margin:16px 0 19px 0;" />
            <p class="rojo txt18">Alarmas</p>
            <hr class="punteado" style="margin:16px 0 19px 0;" />
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
                <tr>
                    <td width="367" bgcolor="#CC0000"><p class="blanco">Tarea</p></td>
                    <td width="66" align="center" bgcolor="#CC0000"><p class="blanco">Inicio</p></td>
                    <td width="66" align="center" bgcolor="#CC0000"><p class="blanco">Vence</p></td>
                    <td width="69" align="center" bgcolor="#CC0000"><p class="blanco">Restan</p></td>
                </tr>
                <tr>
                    <td>Pedido de compras</td>
                    <td align="center" class="txt11">20/10/2012</td>
                    <td align="center" class="txt11">25/10/2012</td>
                    <td align="center" class="txt11">2 días</td>
                </tr>
                <tr>
                    <td>Propuestas de mejoras</td>
                    <td align="center" class="txt11">21/12/2012</td>
                    <td align="center" class="txt11">26/10/2012</td>
                    <td align="center" class="txt11">1 día</td>
                </tr>
                <tr>
                    <td>Propuestas de mejoras</td>
                    <td align="center" class="txt11">21/12/2012</td>
                    <td align="center" class="txt11">26/10/2012</td>
                    <td align="center" class="txt11">1 mes</td>
                </tr>
                <tr>
                    <td>Propuestas de mejoras</td>
                    <td align="center" class="txt11">21/12/2012</td>
                    <td align="center" class="txt11">26/10/2012</td>
                    <td align="center" class="txt11">4 meses</td>
                </tr>
            </table>
        </div>
        <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
        <br style="clear:both;" />
    </div>
  </div>
</section>

            <div id="foot">
        <a href="#head" class="btn_arriba png_bg" style="position:absolute; left: 935px; top: 19px;" rel="top">ir arriba</a>
        <a href="http://www.kirke.ws" class="btn_kirke png_bg" style="position:absolute; left: 880px; top: 350px;" target="_blank"></a>
        <p class="txt12 blanco" style="position:absolute; left: 15px; top: 22px;">
            Copyright 2012 - Dreamkyds.com   | <a href="#" class="blanco">Términos y Condiciones</a>
        </p>
        <ul style="position:absolute; left: 35px; top: 81px;">
            <li><a href="index.html" class="celeste2 bold underline">Home</a></li>
            <li><a href="la_empresa.html" class="celeste2 bold underline">La Empresa</a></li>
            <li><a href="contacto.html" class="celeste2 bold underline">Contacto</a></li>
        </ul>
        <ul style="position:absolute; left:35px; top:159px;">
            <li><a href="mi_cuenta.html" class="blanco bold underline">Mi Cuenta</a></li>
            <li><a href="carrito.html" class="blanco bold underline">Carrito</a></li>
            <li><a href="formas_de_pago.html" class="blanco bold underline">Formas de Pago</a></li>
            <li><a href="gastos_de_envio.html" class="blanco bold underline">Gastos de Envio</a></li>
        </ul>
        <ul style="position:absolute; left:35px; top:253px;">
            <li><a href="registro.html" class="blanco  underline">Registro</a></li>
            <li><a href="#" class="blanco  underline">Recuperar Contraseña</a></li>
        </ul>
        <ul style="position:absolute; left:170px; top:81px;">
            <li><a href="#" class="celeste3 bold  underline">GRACHI&reg;</a></li>
            <li><a href="#" class="celeste3 bold underline">ANGRY BIRDS&reg;</a></li>
        </ul>
    </div>
    </div>
</body>

</html>

















