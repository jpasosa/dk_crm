<link href="/css/ven_pedido_precio_credito.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;">
        <div id="hilo"> Bienvenido:   {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Pedido de precio / Crédito especial</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <hr />
        <p>Cliente: <span class="azul">analizar esto</span></p>
        <p>Empleado:<span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada">
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <label class="block primerElement">Pedido : </label>
                <textarea class="marginCero" readonly="readonly">{$tabla[0]['pedido']}</textarea>                
                <div class="archivos">
                    {foreach item=n from=$files}
                        <div class="file">
                            <a class="file_name" id="file_name-{$$n[id]}" target="_blank" href="/upload_archivos/ven_pedido_precio_credito/{$$n[nombre]}">
                                <span>Archivo: {$$n[nombre]}</span>
                            </a>
                        </div>
                    {/foreach}
                </div>
            </div>
        </form>
        <h2 class="azul bold">
            <span class="txt22 normal">Comentarios</span>
        </h2>
        <hr />
        <form class="box-coment" name="box_coment" action="/ven_pedido_precio_credito_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
            {if $all_comments['error'] != true }
                {foreach item=com from=$all_comments }
                    <div class="coment_ant">
                        <div class="datoComent"> {$$com[fecha_alta]} </div>
                        <div class="datoComent"> {$$com[area]} </div>
                        <div class="datoComent"> {$$com[estado]} </div>
                        <div class="coment"> {$$com[comentario]} </div>
                    </div>
                {/foreach}
            {else}
                No existen comentarios
            {/if}
            <div class="coment_actual">
                <div class="comentario">
                    <div class="fecha"> {$date} </div>
                    <div class="area"> {$area[0]['area']} </div>
                    <label> Comentario: </label>
                    <textarea name="comentario" rows="2"></textarea>
                </div>
                <div class="aceptar">
                    <input name="aprobar" class="aprobar" type="submit" value="Aprobar" />
                    {if $first_process != true}
                        {if $repeat_process != true}
                            <input name="solicitar_correccion" class="solicitar_correccion" type="submit" value="Solicitar Corrección" />
                        {/if}
                    {/if}
                    {if $first_process != true }
                        <input name="desaprobar" class="desaprobar" type="submit" value="Desaprobar" />
                    {/if}       
                </div>
            </div>
        </form>      
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>

