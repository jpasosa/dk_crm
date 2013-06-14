<link href="/css/ven_visitas_de_clientes.css" rel="stylesheet" type="text/css" />

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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul"> {$nombre_inicio}</span></p>
        <p class="txt10 uppercase">Area:<span class="azul"> {$area_inicio}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_visitas_de_clientes.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="campania cliente">
                            <label> Cliente: </label>
                            <select name="cliente" disabled="disabled">
                                <option> {$tabla[0]["empresa"]}</option>
                            </select>
                        </div>
                        <div class="campania">
                            <label> Dirección: </label>
                            <input name="direccion" type="text" readonly="readonly" value="{$tabla[0]['direccion']}"  />
                        </div>
                        <div class="campania">
                            <label> Hora: </label>
                            <input name="hora" type="text" readonly="readonly" value="{$tabla[0]['hora']}"  />
                        </div>

                    </div>
                    <div class="der">
                        <div class="campania">
                            <label> País / Ciudad: </label> 
                            <select name="provincia" disabled="disabled">
                                {if $tabla[0]['id_sis_provincia'] == 0 }                    
                                    <option > en nuestras oficinas </option>
                                {else}
                                    <option> {$tabla[0]["provincia"]}  </option>
                                {/if}
                            </select>
                        </div>
                        <div class="campania">
                            <label> Fecha: </label>
                                <input id="fecha" name="fecha" class="fecha" readonly="readonly" type="text" value='{$tabla[0]["fecha"]|date_format:"d/m/Y"}'  alt="Fecha" />
                        </div>
                    </div>
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                </div>    
        </form>
        <!-- LISTADO DE SUCURSALES -->
        <p class="azul bold">SUCURSALES</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="188" bgcolor="#4685CA"><p class="blanco">Nombre </p></td>
                <td width="310" align="left" bgcolor="#4685CA"><p class="blanco">Dirección</p></td>
                <td width="149" align="left" bgcolor="#4685CA"><p class="blanco">Teléfono</p></td>
            </tr>
            {if $tabla_sec_sucursales['error'] == false }
                {foreach item=ts from=$tabla_sec_sucursales }
                    <tr id="id_suc-{$$ts[id_ven_visitas_de_clientes_sucursales]}">
                        <td><span id="{$$ts[id_ven_cliente_sucursales]}" class="nombre_sucursal">{$$ts[nombre_sucursal]}</span></td>
                        <td><span class="direccion">{$$ts[direccion]}</span></td>
                        <td> <span class="telefono">{$$ts[telefono]}</span></td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <!-- LISTADO DE CONTACTOS -->
        <p class="azul bold">CONTACTOS</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Nombre</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Apellido</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Sucursal</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Sector</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Puesto</p></td>
            </tr>
            {if $tabla_sec_contactos['error'] == false }
                {foreach item=ts from=$tabla_sec_contactos }
                    <tr id="id_contacto-{$$ts[id_ven_visitas_de_clientes_contactos]}">
                        <td>
                            <span id="{$$ts[id_ven_cliente_contacto]}" class="nombre" title="{$$ts[mail]} | {$$ts[telefono_contacto]} | {$$ts[celular]}">{$$ts[nombre]}</span>
                        </td>
                        <td><span class="apellido">{$$ts[apellido]}</span></td>
                        <td> <span id="{$$ts[id_ven_visitas_de_clientes_sucursales]}" class="nombre_sucursal">{$$ts[nombre_sucursal]}</span></td>
                        <td> <span class="sector">{$$ts[sector]}</span></td>
                        <td> <span class="puesto">{$$ts[puesto]}</span></td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <form class="box-coment" name="box_coment" action="/ven_visitas_de_clientes_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
            <div class="title"> Comentarios: </div>
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
