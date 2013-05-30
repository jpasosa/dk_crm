<!DOCTYPE html>
<html>
<head>
{$#kk_encabezados}
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DreamKyds CRM</title>
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
    
    <link href="/css/estilos.css" rel="stylesheet" type="text/css" /><!-- Estilos -->
    <link href="/css/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
    <link href="/css/formCommon.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="_php/favicon.ico" > <!-- FAVICON -->

    <script src="/js/AC_RunActiveContent.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/jquery_172.js"></script>


    
    <script type="text/javascript" src="/js/easySlider1.7.js"></script><!-- SLIDER -->
    <script type="text/javascript" src="/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script><!-- FANCY BOX -->    
    <script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="/js/formCommon/functions.js"></script>
    <script type="text/javascript" src="/js/formCommon/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/formCommon/jquery.ba-dotimeout.min.js"></script> <!-- TimeOut -->
    <!-- PNG FIX -->
    <script type="text/javascript" src="/js/pngfix.js"></script>
    <!--[if IE 6]>
            <script src="js/pngfix.js"></script>
            <script>
                DD_belatedPNG.fix('.png_bg, img');
            </script>
            
    <![endif]-->

    <!-- FUNCION PARA IR ARRIBA -->
    <script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
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
        {template tpl="header"}
        <div id="contenido" style="padding-top:0px;">
            {template section}
        </div>
        {template tpl="footer"}
    </div>
</body>

</html>

















