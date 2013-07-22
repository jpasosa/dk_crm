<link href="/css/ven_llamadas.css" rel="stylesheet" type="text/css" />

<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Formulario de Llamadas</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <form class="box-entrada" name="add_hotel" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label> Campaña: </label>
                        <input readonly="readonly" title="{$tabla[0]['campania']}" name="campania" type="text" value="{$tabla[0]['campania']}"  />
                    </div>
                    <div class="cliente">
                        <label> Cliente: </label>
                        <input readonly="readonly" name="cliente" type="text" value="{$tabla_contacto[0]['empresa']}"  />
                    </div>
                    <div class="vendedor" style="display: none;"> <!-- no existe un campo vendedor en tabla principal. Por ahora no muesto esto -->
                        <label> Vendedor: </label>
                        <input readonly="readonly" name="vendedor" type="text" value="{$vendedor}"  />
                    </div>
                    <div class="campania">
                        <label> Fecha: </label>
                        <input id="fecha" readonly="readonly" name='fecha' type='text' value='{$tabla[0]["fecha"]|date_format:"d/m/Y"}'  />
                    </div>
                </div>
                <div class="der">
                    <div class="sucursal">
                        <label> Sucursal: </label>
                        <input readonly="readonly" name="sucursal" type="text" value="{$tabla_contacto[0]['nombre_sucursal']}"  />
                    </div>
                    <div class="contacto">
                        <label> Contacto: </label>
                        <input readonly="readonly" name="contacto" type="text" value="{$tabla_contacto[0]['apellido']}, {$tabla_contacto[0]['nombre']}"  />
                    </div>
                    <div class="tipoLlamada">
                        <label> Tipo de Llamada: </label>
                        <select name="tipo_llamada" disabled="disabled">
                            <option value="S" {if $tabla[0][tipo_llamada] == 'S'} selected {/if}>Saliente</option>
                            <option value="E" {if $tabla[0][tipo_llamada] == 'E'} selected {/if}>Entrante</option>
                        </select>
                    </div>
                    <div class="prioridad">
                        <label> Prioridad: </label>
                        <select name="prioridad" disabled="disabled">
                            <option value="MB" {if $tabla[0][prioridad] == 'MB'} selected {/if}>Muy Baja</option>
                            <option value="B" {if $tabla[0][prioridad] == 'B'} selected {/if}>Baja</option>
                            <option value="M" {if $tabla[0][prioridad] == 'M'} selected {/if}>Media</option>
                            <option value="A" {if $tabla[0][prioridad] == 'A'} selected {/if}>Alta</option>
                            <option value="MA" {if $tabla[0][prioridad] == 'MA'} selected {/if}>Muy Alta</option>
                        </select>
                    </div>
                    <div class="campania">
                        <label> Hora: </label>
                        <input name="hora" type="text" value="{$tabla[0]['hora']}"  />
                    </div>
                </div>
                <div class="observaciones">
                        <label class="block"> Observaciones: </label>
                        <textarea id="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
            </div>
        </form>


        <!-- LISTADO DE TEMAS -->
        <p class="azul bold">TEMAS A TRATAR o YA TRATADOS</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="500" bgcolor="#4685CA"><p class="blanco">Tema </p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Tocado</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=tema from=$tabla_sec }
                <tr id="id_tema-{$$tema[id_ven_llamadas_temas]}">
                    <td><span class="tema">{$$tema[tema]}</span></td>
                    <td>
                        <span id="{$$tema[tema_tocado]}" class="tema_tocado">{if $$tema['tema_tocado'] == 1}SI{else}NO{/if}</span>
                    </td>
                </tr>
                {/foreach}
            {/if}
        </table>

        <form class="box-coment" name="box_coment" action="/ven_llamadas_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
