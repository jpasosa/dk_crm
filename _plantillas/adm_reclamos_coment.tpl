<link href="/css/adm_reclamos.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;">
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Reclamos</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <hr />
        <p>Sector:<span class="azul">{$area_inicio}</span></p>
        <p>Empleado:<span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada">
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="cliente">
                        <label> Cliente: </label>
                        <input readonly="readonly" name="cliente" class="cliente" type="text" value="{$ven_cliente}" />
                    </div>
                    <div class="cliente">
                        <label> Contacto: </label>
                        <input readonly="readonly" name="contacto" class="cliente" type="text" value="{$contacto}" />
                    </div>
                </div>
                <div class="der">
                    <div class="proveedor">
                        <label> Proveedor: </label>
                        <input readonly="readonly" name="proveedor" class="proveedor" type="text" value="{$proveedor}" /> 
                    </div>
                </div>
                <label class="block primerElement">Asunto : </label>
                <input readonly="yes" class="marginCero" id="asunto"type="text" value="{$tabla[0]['asunto']}"/>
                <label class="block">Reclamo : </label>
                <textarea readonly="yes" class="marginCero">{$tabla[0]['reclamo']}</textarea>
                <div class="archivos">
                    {foreach item=n from=$files}
                        <div class="file">
                            <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_reclamos/{$$n[nombre]}">
                                <span>Archivo: {$$n[nombre]}</span>
                            </a>
                        </div>
                    {/foreach}
                </div>
            </div>
        </form>
        
        <form class="box-coment" name="box_coment" action="/adm_reclamos_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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

