<link href="/css/ven_solicitud_viaticos_viajes.css" rel="stylesheet" type="text/css" />

<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }
    <div class="disp_error"> {$flash_error} </div>{/if}{if $flash_notice != '' }
    <div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <h1 class="azul bold"><span class="txt22 normal">Rendición de viáticos viajes</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p>Empleado:<span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada" name="add_hotel" action="#" method="post" enctype="" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="fecha_inicio">
                    <label> Fecha Inicio: </label>
                        {if $tabla[0]['fecha_inicio'] == '' }
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value=''  readonly="true" alt="Fecha Inicio" />
                        {else}
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" readonly="true" value='{$tabla[0]["fecha_inicio"]|date_format:"d/m/Y"}'  alt="Fecha Inicio" />
                        {/if}
                </div>
                <div class="fecha_fin">
                    <label> Fecha Fin: </label>
                    {if $tabla[0]['fecha_fin'] == '' }
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" value=''  readonly="true" alt="Fecha fin" />
                    {else}
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" readonly="true" value='{$tabla[0]["fecha_fin"]|date_format:"d/m/Y"}'  alt="Fecha fin" />
                    {/if}
                </div>
                <div class="observaciones">
                        <label> Observaciones: </label>
                        <textarea name="observaciones" readonly="true">{$tabla[0]['observaciones']}</textarea>
                </div>
            </div>
        </form>
        <br />
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            {if $tabla_sec_clientes['error'] != true }
                    <tr>
                        <td width="350" bgcolor="#4685CA"><p class="blanco">Cliente </p></td>
                        <td width="122" align="left" bgcolor="#4685CA"><p class="blanco">País</p></td>
                        <td width="123" align="center" bgcolor="#4685CA"><p class="blanco">Ciudad</p></td>
                    </tr>
                    {foreach item=cl from=$tabla_sec_clientes }
                        <tr id="id_cl-{$$cl[solicit_cliente]}">
                            <td><span>{$$cl[empresa]} , {$$cl[usuario]} </span></td>
                            <td><span class="pais">{$$cl[pais]}</span></td>
                            <td> <span>{$$cl[provincia]}</span></td>
                        </tr>
                    {/foreach}
            {else}
                    No existen Clientes cargados en la Base de Datos.
            {/if}
        </table>
        <br />        
        
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            {if $tabla_sec_gastos['error'] != true }
                    <p>Monto: <span class="monto_total azul">{$monto_total}</span></p>
                    <tr>
                        <td width="145" bgcolor="#4685CA"><p class="blanco">Referencia </p></td>
                        <td width="358" align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                        <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Monto</p></td>
                    </tr>
                    {foreach item=gast from=$tabla_sec_gastos }
                        <tr id="id_gast-{$$gast[id]}">
                            <td><span id="ref-{$$gast[id_ref]}" class="referencia">{$$gast[referencia]}</span></td>
                            <td><span class="detalle">{$$gast[detalle]}</span></td>
                            <td><span class="monto">{$$gast[monto]|number_format:2:",":""}</span></td>
                        </tr>
                    {/foreach}    
            {else}
                    No existen Gastos cargados en la Base de Datos.
            {/if}  
        </table>

        <form class="box-coment" name="box_coment" action="/form_example_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
            <div class="title"> Comentarios: </div>
            {if $all_comments['error'] != true }
                {foreach item=com from=$all_comments }
                    <div class="coment_ant">
                        <div class="fecha"> {$$com[fecha_alta]} </div>
                        <div class="area"> {$$com[area]} </div>
                        <div class="estado"> {$$com[estado]} </div>
                        <div class="comentario"> {$$com[comentario]} </div>
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
                    <textarea name="comentario" rows="2" redonly="true"></textarea>
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
