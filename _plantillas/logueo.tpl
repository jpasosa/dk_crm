<link href="css/logueo.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="ger_planificacion_gastos" id="proc-{$id_proces}"> <!-- lo uso para ver el id del proceso -->
        <div class="flash_error"></div> <!-- estos van a saltar por AJAX -->
        <div class="flash_notice"></div>
        {if $flash_error != '' }
            <div class="disp_error"> {$flash_error} </div> <!-- estos vienen del controlador -->                    
        {/if}
        {if $flash_notice != '' }
            <div class="disp_notice"> {$flash_notice} </div> <!-- estos vienen del controlador -->                    
        {/if}
        {template tpl="menu_izq_vacio"}
        <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
            <hr />
            <h1 class="azul bold"><span class="txt22 normal">Usuarios Habilitados</span> | Logueo al Sistema</h1>
            <hr />
            <form class="box-entrada" name="add_observaciones" action="/logueo.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                    <div class="user">
                        <label> Usuario: </label>
                        <input name="user" type="text" value="{$user}" />
                    </div>
                    <div class="pass">
                        <label> Contraseña: </label>
                        <input name="pass" type="password" value="" />
                    </div>
                    <div class="login">
                        <input name="login" type="submit" value="Ingresar al Sistema" />
                    </div>
                </div>
            </form>
            <hr />
        </div>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>

