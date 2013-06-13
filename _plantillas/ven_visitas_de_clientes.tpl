<link href="/css/ven_visitas_de_clientes.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/ven_visitas_de_clientes/abm.js"></script>
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script> $(function() {$( "#fecha" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>


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
        <h1 class="azul bold"><span class="txt22 normal">Visitas de Clientes</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul"> {$nombre_empleado}</span></p>
        <p class="txt10 uppercase">Area:<span class="azul"> {$area}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_visitas_de_clientes.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="campania cliente">
                            <label> Cliente: </label>
                            <select name="cliente">
                                {foreach item=cl from=$clientes}
                                    <option value="{$$cl[id_ven_cliente]}" {if $$cl['id_ven_cliente'] == $tabla[0]['id_ven_cliente'] } selected {/if}> {$$cl[empresa]}</option>
                                {/foreach}    
                            </select>
                        </div>
                        <!-- <p class="azul bold clear">LUGAR DE LA REUNION</p> -->
                        
                        <div class="campania">
                            <label> Dirección: </label>
                            <input name="direccion" type="text" value="{$tabla[0]['direccion']}"  />
                        </div>
                        <div class="campania">
                            <label> Hora: </label>
                            <input name="hora" type="text" value="{$tabla[0]['hora']}"  />
                        </div>

                    </div>
                    <div class="der">
                        <div class="campania">
                            <label> País / Ciudad: </label> 
                            <select name="provincia">
                                <option> en nuestras oficinas </option>
                                {foreach item=pais from=$paises}
                                    <option value="{$$pais[id_sis_provincia]}" {if $$pais['id_sis_provincia'] == $tabla[0]['id_sis_provincia'] } selected {/if}> {$$pais[pais]} | {$$pais[provincia]}  </option>
                                {/foreach}    
                            </select>
                        </div>
                        <div class="campania">
                            <label> Fecha: </label>
                            {if $tabla[0]['fecha'] == '' }
                                <input id="fecha" name="fecha" class="fecha" type="text" value=''  alt="Fecha Inicio" />
                            {else}
                                <input id="fecha" name="fecha" class="fecha" type="text" value='{$tabla[0]["fecha"]|date_format:"d/m/Y"}'  alt="Fecha" />
                            {/if}
                        </div>
                    </div>
                    
                    <input name="first_time" type="hidden" value="{$first_time}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                    <input type="submit" name="agregar" class="agregar" value="Agregar"/>
                </div>    
        </form>


        <!-- LISTADO DE SUCURSALES -->
        <p class="azul bold">SUCURSALES</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="188" bgcolor="#4685CA"><p class="blanco">Nombre </p></td>
                <td width="310" align="left" bgcolor="#4685CA"><p class="blanco">Dirección</p></td>
                <td width="149" align="left" bgcolor="#4685CA"><p class="blanco">Teléfono</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $sucursales['error'] == false }
                {foreach item=ts from=$sucursales }
                    <tr id="id_suc-{$$ts[id_ven_visitas_de_clientes_sucursales]}">
                        <td><span class="nombre_sucursal">{$$ts[nombre_sucursal]}</span></td>
                        <td><span class="direccion">{$$ts[direccion]}</span></td>
                        <td> <span class="telefono">{$$ts[telefono]}</span></td>
                        <td>
                            <a href="#">
                                <img id="id_suc-{$$ts[id_ven_visitas_de_clientes_sucursales]}" class="del_suc" src="/img/iconos/delete.gif" alt="quitar" border="0" />
                            </a> 
                            <a href="#">
                                <img id="id_suc-{$$ts[id_ven_visitas_de_clientes_sucursales]}" class="edit_suc" src="/img/iconos/edit.gif" alt="editar" border="0" />
                            </a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <!-- INGRESO DE SUCURSALES -->
        <form class="box-entrada" name="add_hotel" action="/ven_visitas_de_clientes.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label> Sucursal:  </label>
                        <select name="sucursal" class="sucursal">
                            {foreach item=suc from=$get_sucursales}
                                <option value="{$$suc[id_ven_cliente_sucursales]}"> {$$suc[nombre_sucursal]} </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="der"></div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                <input type="submit" name="agregar_suc" class="agregar" value="Agregar"/>
            </div>    
        </form>


        <!-- LISTADO DE CONTACTOS -->
        <p class="azul bold">CONTACTOS</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Nombre</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Apellido</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Sucursal</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Sector</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Puesto</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            <!-- {if $tabla_sec['error'] == false } -->
                {foreach item=ts from=$tabla_contactos }
                    <tr id="id_contacto-{$$ts[id_ven_visitas_de_clientes_contacto]}">
                        <td> <span class="nombre" title="{$$ts[mail]} | {$$ts[telefono_contacto]} | {$$ts[celular]}">{$$ts[nombre]}</span></td>
                        <td><span class="apellido">{$$ts[apellido]}</span></td>
                        <td> <span id="{$$ts[id_ven_visitas_de_clientes_sucursales]}" class="nombre_sucursal">{$$ts[nombre_sucursal]}</span></td>
                        <td> <span class="sector">{$$ts[sector]}</span></td>
                        <td> <span class="puesto">{$$ts[puesto]}</span></td>
                        <td>
                        <a href="#">
                            <img id="id_contacto-{$$ts[id_ven_visitas_de_clientes_contacto]}" class="del_contacto" src="img/iconos/delete.gif" alt="quitar" border="0" />
                        </a> 
                        <a href="#">
                            <img id="id_contacto-{$$ts[id_ven_visitas_de_clientes_contacto]}" class="edit_contacto" src="img/iconos/edit.gif" alt="editar" border="0" />
                        </a>
                    </td>
                    </tr>
                {/foreach}
            <!-- {/if} -->
        </table>
        <!-- INGRESO DE CONTACTOS -->
        <form class="box-entrada" name="add_hotel" action="/ven_visitas_de_clientes.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label> Contacto:  </label>
                        <select name="sucursal" class="sucursal">
                            {foreach item=suc from=$select_suc}
                                <option value="{$$suc[id]}"> {$$suc[nombre]} </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="der"></div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                <input type="submit" name="agregar_contacto" class="agregar" value="Agregar" />
            </div>    
        </form>
        <form class="box-entrada" name="add_hotel" action="/ven_visitas_de_clientes.html" method="post" enctype="multipart/form-data" >
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
