<link href="/css/ave_campania.css" rel="stylesheet" type="text/css" />

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Armado de Campaña</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p>Empleado:<span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Campaña:</label>
                        <input readonly="readonly" name="campania" type="text" value="{$tabla[0][campania]}" alt="Campaña" />
                    </div>
                    <div class="campania">
                        <label>Motivo:</label>
                        <input readonly="readonly"  class="ultimoElement" name="motivo" type="text" value="{$tabla[0][motivo]}"  alt="Motivo" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Fecha Inicio:</label>
                        {if $tabla[0][fecha_inicio] == '' }
                            <input readonly="readonly" class="fecha_inicio" value="" />
                        {else}
                            <input readonly="readonly"  class="fecha_inicio" value='{$tabla[0][fecha_inicio]|date_format:"d/m/Y"}' />
                        {/if}
                    </div>
                    <div class="campania">
                        <label>Hora:</label>
                        <input readonly="readonly"  class="ultimoElement" name="hora" type="text" value="{$tabla[0][hora]}"  alt="Hora" />
                    </div>                  
                </div>
                <div class="izq clear"><p class="azul bold">MAILING</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label>Fecha de Inicio:</label>
                        {if $tabla[0][mlg_fecha_inicio] == '' }
                            <input readonly="readonly" class="fecha_inicio" value="" />
                        {else}
                            <input readonly="readonly"  class="fecha_inicio" value='{$tabla[0][mlg_fecha_inicio]|date_format:"d/m/Y"}' />
                        {/if}
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label>Asunto:</label>
                        <input readonly="readonly"  name="asunto" type="text" value="{$tabla[0][mlg_asunto]}"  alt="Asunto" />
                    </div>                    
                </div>
                <div class="observacionesChico clear">
                    <label> Texto: </label>
                    <textarea readonly="readonly"  name="texto">{$tabla[0][mlg_texto]}</textarea>
                </div>
                <div class="archivos clear">
                    <div class="file marginLat10">
                        <a class="file_name" href="/upload_archivos/ave_campania/{$tabla[0][mlg_plantilla]}" target="_blank">
                            <span>Mail: {$tabla[0][mlg_plantilla]}</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <p class="azul bold">LLAMADAS A CLIENTES</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td bgcolor="#4685CA"><p class="blanco">Cliente </p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Contacto</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Horario</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=clientes from=$tabla_sec }
                    <tr>
                        <td><span>{$$clientes[empresa]}, {$$clientes[nombre_sucursal]}</span></td>
                        <td><span>{$$clientes[apellido]}, {$$clientes[nombre]}</span></td>
                        <td align="center"><span>{$$clientes[hora]}</span></td>
                    </tr>
                {/foreach}
            {/if}
        </table>

        <form class="box-coment" name="box_coment" action="/ave_campania_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
