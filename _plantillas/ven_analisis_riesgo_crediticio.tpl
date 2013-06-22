<link href="/css/ven_analisis_riesgo_crediticio.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/ven_analisis_riesgo_crediticio/abm_search.js"></script>



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
        <h1 class="azul bold"><span class="txt22 normal">Análisis de Riesgo Crediticio</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p>Sector: <span class="azul">{$area}</span></p>
        <p>Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_analisis_riesgo_crediticio.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Cliente:</label>
                        <select name="ven_cliente_contacto" class="cliente">
                            {foreach item=vcs from=$ven_cliente_contacto}
                                <option value="{$$vcs[id_ven_cliente_contacto]}" {if $$vcs['id_ven_cliente_contacto'] == $tabla[0]['id_ven_cliente_contacto'] } selected {/if}>
                                    {$$vcs[apellido]} / {$$vcs[empresa]} / {$$vcs[nombre_sucursal]}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="izq clear">
                        <div class="campania">
                            <label>Asunto:</label>
                            <input name="asunto" type="text" value="{$tabla[0]['asunto']}"  alt="Asunto" />
                        </div>
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Detalle: </label>
                    <textarea name="detalle">{$tabla[0]['detalle']}</textarea>
                </div>

                <div class="izq clear"><p class="azul bold">ARCHIVOS</p></div>

                <div class="archivo">
                    <label class="block"> Pacto Social </label>
                    <input type="file" class="inline" name="archivo_pacto" value="" />
                    <input type="submit" class="inline" name="pacto" value="Subir" />
                </div>
                <div class="archivos clear">
                    <div class="file marginLat10">
                        <a class="file_name" href="/upload_archivos/ven_analisis_riesgo_crediticio/{$tabla[0]['archivo_pacto_social']}" target="_blank">
                            <span>{$tabla[0]["archivo_pacto_social"]}</span>
                        </a>
                    </div>
                </div>

                <div class="archivo">
                    <label class="block"> certificado registro público </label>
                    <input type="file" class="inline" name="archivo_publico" value="" />
                    <input type="submit" class="inline" name="cert_publico" value="Subir" />
                </div>
                <div class="archivos clear">
                        <div class="file marginLat10">
                            <a class="file_name" href="/upload_archivos/ven_analisis_riesgo_crediticio/{$tabla[0]['archivo_certificado_registro_p']}" target="_blank">
                                <span>{$tabla[0]['archivo_certificado_registro_p']}</span>
                            </a>
                        </div>
                </div>

                <div class="archivo">
                    <label class="block"> certificado de incumbencia </label>
                    <input type="file" class="inline" name="archivo_incumb" value="" />
                    <input type="submit" class="inline" name="cert_incumb" value="Subir" />
                </div>
                <div class="archivos clear">
                    <div class="file marginLat10">
                        <a class="file_name" href="/upload_archivos/ven_analisis_riesgo_crediticio/{$tabla[0]['archivo_certificado_incumb']}" target="_blank">
                            <span>{$tabla[0]['archivo_certificado_incumb']}</span>
                        </a>
                    </div>
                </div>

                <div class="archivo">
                    <label class="block"> referencias bancarias </label>
                    <input type="file" class="inline" name="archivo_bancarias" value="" />
                    <input type="submit" class="inline" name="bancarias" value="Subir" />
                </div>
                <div class="archivos clear">
                    <div class="file marginLat10">
                        <a class="file_name" href="/upload_archivos/ven_analisis_riesgo_crediticio/{$tabla[0]['archivo_referencias_bancarias']}" target="_blank">
                            <span>{$tabla[0]['archivo_referencias_bancarias']}</span>
                        </a>
                    </div>
                </div>

                <div class="archivo">
                    <label class="block"> referencias comerciales </label>
                    <input type="file" class="inline" name="archivo_comerciales" value="" />
                    <input type="submit" class="inline" name="comerciales" value="Subir" />
                </div>
                <div class="archivos clear">
                    <div class="file marginLat10">
                        <a class="file_name" href="/upload_archivos/ven_analisis_riesgo_crediticio/{$tabla[0]['archivo_referencias_com']}" target="_blank">
                            <span>{$tabla[0]['archivo_referencias_com']}</span>
                        </a>
                    </div>
                </div>

                <div class="archivo">
                    <label class="block"> autorizaciones </label>
                    <input type="file" class="inline" name="archivo_autorizaciones" value="" />
                    <input type="submit" class="inline" name="autorizaciones" value="Subir" />
                </div>
                <div class="archivos clear">
                    <div class="file marginLat10">
                        <a class="file_name" href="/upload_archivos/ven_analisis_riesgo_crediticio/{$tabla[0]['archivo_autorizaciones']}" target="_blank">
                            <span>{$tabla[0]['archivo_autorizaciones']}</span>
                        </a>
                    </div>
                </div>

                <div class="archivo">
                    <label class="block"> contrato de crédito </label>
                    <input type="file" class="inline" name="archivo_credito" value="" />
                    <input type="submit" class="inline" name="credito" value="Subir" />
                </div>
                <div class="archivos clear">
                    <div class="file marginLat10">
                        <a class="file_name" href='/upload_archivos/ven_analisis_riesgo_crediticio/{$tabla[0]["archivo_contrato_credito"]}' target="_blank">
                            <span>{$tabla[0]["archivo_contrato_credito"]}</span>
                        </a>
                    </div>
                </div>


                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>

        <form class="box-entrada" name="add_hotel" action="/ven_analisis_riesgo_crediticio.html" method="post" enctype="multipart/form-data" >
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
