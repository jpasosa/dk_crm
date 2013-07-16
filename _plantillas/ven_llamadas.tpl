<link href="/css/ven_llamadas.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script type="text/javascript" src="/js/ven_llamadas/abm.js"></script>
<script> $(function() {$( "#fecha" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>


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
        <h1 class="azul bold"><span class="txt22 normal">Formulario de Llamadas</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p>Sector: <span class="azul">{$area}</span></p>
        <p>Empleado:<span class="azul">{$nombre_empleado}</span></p>

        <form class="box-entrada" name="add_hotel" action="/ven_llamadas/{$id_ave_campania_clientes}.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label> Campaña: </label>
                        <input readonly="readonly" title="{$tabla_ave_campania[0]['campania']}" name="campania" type="text" value="{$tabla_ave_campania[0]['campania']}"  />
                    </div>
                    <div class="cliente">
                        <label> Cliente: </label>
                        <input readonly="readonly" name="cliente" type="text" value="{$ave_campania_clientes[0]['empresa']}"  />
                    </div>
                    <div class="vendedor" style="display: none;"> <!-- no existe un campo vendedor en tabla principal. Por ahora no muesto esto -->
                        <label> Vendedor: </label>
                        <input readonly="readonly" name="vendedor" type="text" value="{$vendedor}"  />
                    </div>
                    <div class="campania">
                            <label> Fecha: </label>
                            {if $first_time == 'true'}
                                <input id="fecha" name='fecha' type='text' value='{$tabla_ave_campania[0]["fecha_inicio"]|date_format:"d/m/Y"}'  />
                            {else}
                                <input id="fecha" name='fecha' type='text' value='{$tabla[0]["fecha"]|date_format:"d/m/Y"}'  />
                            {/if}
                    </div>
                </div>
                <div class="der">
                    <div class="sucursal">
                        <label> Sucursal: </label>
                        <input readponly="readonly" name="sucursal" type="text" value="{$ave_campania_clientes[0]['nombre_sucursal']}"  />
                    </div>
                    <div class="contacto">
                        <label> Contacto: </label>
                        <input readponly="readonly" name="contacto" type="text" value="{$ave_campania_clientes[0]['apellido']}, {$ave_campania_clientes[0]['nombre']}"  />
                    </div>
                    <div class="tipoLlamada">
                        <label> Tipo de Llamada: </label>
                        <select name="tipo_llamada">
                            <option value="S" {if $tabla[0][tipo_llamada] == 'S'} selected {/if}>Saliente</option>
                            <option value="E" {if $tabla[0][tipo_llamada] == 'E'} selected {/if}>Entrante</option>
                        </select>
                    </div>
                    <div class="prioridad">
                        <label> Prioridad: </label>
                        <select name="prioridad">
                            <option value="MB" {if $tabla[0][prioridad] == 'MB'} selected {/if}>Muy Baja</option>
                            <option value="B" {if $tabla[0][prioridad] == 'B'} selected {/if}>Baja</option>
                            <option value="M" {if $tabla[0][prioridad] == 'M'} selected {/if}>Media</option>
                            <option value="A" {if $tabla[0][prioridad] == 'A'} selected {/if}>Alta</option>
                            <option value="MA" {if $tabla[0][prioridad] == 'MA'} selected {/if}>Muy Alta</option>
                        </select>
                    </div>
                    <div class="campania">
                            <label> Hora: </label>
                            {if $first_time == 'true'}
                                <input name="hora" type="text" value="{$ave_campania_clientes[0]['hora']}"  />
                            {else}
                                <input name="hora" type="text" value="{$tabla[0]['hora']}"  />
                            {/if}
                    </div>
                </div>
                <div class="observaciones">
                        <label class="block"> Observaciones: </label>
                        <textarea id="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_ave_campania" type="hidden" value="{$id_ave_campania}" />
                <input name="id_ven_cliente_contacto" type="hidden" value="{$id_ven_cliente_contacto}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input type="submit" id="agregar" name="agregar" value="Agregar"/>
            </div>
        </form>

        <!-- LISTADO DE TEMAS -->
        <p class="azul bold">TEMAS A TRATAR o YA TRATADOS</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="500" bgcolor="#4685CA"><p class="blanco">Tema </p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Tocado</p></td>
                <td width="50" align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=tema from=$tabla_sec }
                <tr id="id_tema-{$$tema[id_ven_llamadas_temas]}">
                    <td><span class="tema">{$$tema[tema]}</span></td>
                    <td>
                        <span id="{$$tema[tema_tocado]}" class="tema_tocado">{if $$tema['tema_tocado'] == 1}SI{else}NO{/if}</span>
                    </td>
                    <td align="center">
                        <a href="#"><img id="id_tema-{$$tema[id_ven_llamadas_temas]}" class="del_tema" src="/img/iconos/delete.gif" alt="quitar" border="0" /></a>
                        <a href="#"><img id="id_tema-{$$tema[id_ven_llamadas_temas]}" class="edit_tema" src="/img/iconos/edit.gif" alt="editar" border="0" /></a>
                    </td>
                </tr>
                {/foreach}
            {/if}
        </table>

        <!-- BOX DE ENTRADA DE TEMAS TOCADOS O A TOCAR -->
        <form class="box-entrada" name="add_hotel" action="/ven_llamadas/{$id_ave_campania_clientes}.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="temas observaciones">
                    <label> Tema: </label>
                    <textarea class="tema" name="tema"></textarea>
                </div>
                <div class="clear">
                    <div class="tipoLlamada">
                        <label> Tema Tocado: </label>
                        <select class="tema_tocado" name="tema_tocado">
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input class="agregar_tema" type="submit" name="agregar_tema" value="Agregar"/>
            </div>
        </form>


        <form class="box-entrada" name="add_hotel" action="/form_example.html" method="post" enctype="multipart/form-data" >
            <div class="enviar_proceso">
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
            </div>
        </form>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>
