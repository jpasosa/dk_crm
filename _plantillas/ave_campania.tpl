<link href="/css/ave_campania.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script type="text/javascript" src="/js/ave_campania/abm_search.js"></script>
<script> $(function() {$( "#fecha_inicio" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script> $(function() {$( "#mlg_fecha_inicio" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>



<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Armado de Campaña</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p>Sector: <span class="azul">{$area}</span></p>
        <p>Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ave_campania.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Campaña:</label>
                        {if $tabla[0]['campania'] == '' }
                            <input readonly="readonly" name="campania" type="text" value="{$campania}"  alt="Campaña" />
                        {else}
                            <input readonly="readonly" name="campania" type="text" value="{$tabla[0]['campania']}"  alt="Campaña" />
                        {/if}
                    </div>
                    <div class="campania">
                        <label>Motivo:</label>
                        <input class="ultimoElement" name="motivo" type="text" value="{$tabla[0]['motivo']}"  alt="Motivo" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Fecha Inicio:</label>
                        {if $tabla[0]['fecha_inicio'] == '' }
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value=''  alt="Fecha Inicio" />
                        {else}
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value='{$tabla[0]["fecha_inicio"]|date_format:"d/m/Y"}'  alt="Fecha" />
                        {/if}
                    </div>
                    <div class="campania">
                        <label>Hora:</label>
                        <input class="ultimoElement" name="hora" type="text" value="{$tabla[0]['hora']}"  alt="Hora" />
                    </div>                  
                </div>
                <div class="izq clear"><p class="azul bold">MAILING</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label>Asunto:</label>
                        <input name="mlg_asunto" type="text" value="{$tabla[0]['mlg_asunto']}"  alt="Asunto" />
                    </div>    
                </div>
                <div class="der">
                     <div class="campania">
                        <label>Fecha de Inicio:</label>
                        {if $tabla[0]['mlg_fecha_inicio'] == '' }
                            <input id="mlg_fecha_inicio" name="mlg_fecha_inicio" class="mlg_fecha_inicio" type="text" value=''  alt="Fecha Inicio" />
                        {else}
                            <input id="mlg_fecha_inicio" name="mlg_fecha_inicio" class="mlg_fecha_inicio" type="text" value='{$tabla[0]["mlg_fecha_inicio"]|date_format:"d/m/Y"}'  alt="Mailing Fecha Inicio" />
                        {/if}
                    </div>               
                </div>
                <div class="observacionesChico clear">
                    <label> Texto: </label>
                    <textarea name="mlg_texto">{$tabla[0]['mlg_texto']}</textarea>
                </div>
                <div class="archivo">
                    <label class="block"> Plantilla Mail : </label>
                    <input type="file" class="inline" name="archivo" value="" />
                    <input type="submit" class="inline" name="subir_mail"value="Subir Mail" />
                </div>
                <div class="archivos clear">
                    {if $tabla[0]['mlg_plantilla'] != '' }
                        <div class="file marginLat10">
                            <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                            <span>{$tabla[0]["mlg_plantilla"]}</span>
                            </a>
                            <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                            <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                            </a>
                        </div>
                    {/if}
                </div>        
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>

        <!-- LISTADO DE CLIENTES -->
        <p class="azul bold">LLAMADAS A CLIENTES</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td bgcolor="#4685CA"><p class="blanco">Cliente </p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Contacto</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Horario</p></td>
                <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
            </tr>
            {foreach item=clientes from=$tabla_sec }
            <tr id="id_cliente-{$$clientes[id_ave_campania_clientes]}">
                <td><span id="{$$clientes[id_ven_cliente_sucursales]}" class="cliente">{$$clientes[empresa]} , {$$clientes[nombre_sucursal]}</span></td>
                <td><span id="{$$clientes[id_ven_cliente_contacto]}" class="contacto">{$$clientes[apellido]}, {$$clientes[nombre]}</span></td>
                <td align="center"><span class="hora">{$$clientes[hora]}</span></td>
                <td align="center">
                    <a href="#"><img id="id_cliente-{$$clientes[id_ave_campania_clientes]}" class="del_cliente" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                    <a href="#"><img id="id_cliente-{$$clientes[id_ave_campania_clientes]}" class="edit_cliente" src="img/iconos/edit.gif" alt="editar" border="0" /></a>
                </td>
            </tr>
            {/foreach}
             
        </table>
        
        <!-- BOX DE ENTRADA DE CLIENTES -->
        <form class="box-entrada" name="add_hotel" action="/ave_campania.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Cliente:</label>
                        <select name="ven_cliente_sucursales" class="cliente">
                            {foreach item=vcs from=$ven_cliente_sucursales}
                                <option value="{$$vcs[id_ven_cliente_sucursales]}" {if $$vcs['id_ven_cliente'] == $tabla[0]['id_ven_cliente'] } selected {/if}> {$$vcs[empresa]} / {$$vcs[nombre_sucursal]}</option>
                            {/foreach}    
                        </select>
                    </div>   
                    <div class="campania">
                        <label>Contacto:</label>
                        <select name="ven_cliente_contacto" class="ultimoElement contacto" >
                            {foreach item=vcc from=$ven_cliente_contacto}
                                <option value="{$$vcc[id_ven_cliente_contacto]}" {if $$vcc['id_ven_cliente_contacto'] == $tabla[0]['id_ven_cliente_contacto'] } selected {/if}> {$$vcc[apellido]},  {$$vcc[nombre]}</option>
                            {/foreach}    
                        </select>
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Horario:</label>
                        <input name="horario" class="horario" type="text" value="" alt="Horario" />
                    </div>                                   
                </div>       
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_cliente" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/ave_campania.html" method="post" enctype="multipart/form-data" >
            <div class="enviar_proceso">
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
            </div>
        </form>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>
