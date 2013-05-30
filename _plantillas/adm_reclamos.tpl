<link href="css/adm_reclamos.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' } <div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;">
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Reclamos</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <hr />
        <p>Sector: <span class="azul">{$area}</span></p>
        <p>Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" name="add_observaciones" action="/adm_reclamos.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="cliente">
                        <label> Cliente: </label>
                        <select name="ven_cliente" class="cliente">
                            <option value="0">Sin Cliente</option>
                            {foreach item=vc from=$ven_cliente}
                                <option value="{$$vc[id_ven_cliente]}" {if $$vc['id_ven_cliente'] == $id_ven_cliente } selected {/if}> {$$vc[empresa]} </option>
                            {/foreach}    
                        </select>
                    </div>
                    <div class="cliente">
                        <label> Contacto: </label>
                        <select name="ven_cliente_contacto">
                            <option value="0">Sin Contacto</option>
                            {foreach item=vcc from=$ven_cliente_contacto}
                                <option value="{$$vcc[id_ven_cliente_contacto]}" {if $$vcc['id_ven_cliente_contacto'] == $tabla[0]['id_ven_cliente_contacto'] } selected {/if}>
                                    {$$vcc[apellido]}, {$$vcc[nombre]}  |  {$$vcc[nombre_sucursal]}
                                </option>
                            {/foreach}    
                        </select>
                    </div>
                </div>
                <div class="der">
                    <div class="proveedor">
                        <label> Proveedor: </label>
                        <select name="proveedor">
                            <option value="0">Sin Proveedor</option>
                            {foreach item=pr from=$proveedores}
                                <option value="{$$pr[id_crp_proveedores]}" {if $$pr['id_crp_proveedores'] == $tabla[0]['id_crp_proveedores'] } selected {/if}> {$$pr[nombre]} </option>
                            {/foreach}    
                        </select>
                    </div>
                    <!-- <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" /> -->
                    <!-- <input name="id_tabla" type="hidden" value="{$id_tabla}" /> -->
                </div>
                <label class="block primerElement">Asunto : </label>
                <input name="asunto" class="marginCero" id="asunto" type="text" value="{$tabla[0]['asunto']}"/>
                <label class="block">Reclamo : </label>
                <textarea name="reclamo" class="marginCero">{$tabla[0]['reclamo']}</textarea>
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline"name="archivo" value="quepasavieja" />
                    <input name="subir_archivo" type="submit" class="inline" name="subir_archivo" value="Subir Archivo" />
                </div>
                {if $files['error'] == false }
                    <div class="archivos">
                        {foreach item=n from=$files}
                            <div class="file">
                                <a class="file_name" id="file_name-{$$n[id]}" target="_blank" href="/upload_archivos/adm_reclamos/{$$n[nombre]}">
                                    <span>Archivo: ({$$n[nombre]})</span>
                                </a>
                                <a class="del_file" id="file-{$$n[id]}" href="#" style="float:left;">
                                    <img border="0" alt="quitar" src="/img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                                </a>
                            </div>
                        {/foreach}
                    </div>
                {/if}
                <input name="agregar" type="submit" id="enviar" class="enviar" value="Agregar" />      
            </div>
            <input type="hidden" name="id_ven_cliente" value="{$id_ven_cliente}" />
            <input type="hidden" name="first_time" value="{$first_time}" />
            <input name="id_tabla" type="hidden" value="{$id_tabla}" />
            <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
        </form>
        <form class="box-entrada" action="/adm_reclamos.html" method="post" enctype="multipart/form-data" >
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

