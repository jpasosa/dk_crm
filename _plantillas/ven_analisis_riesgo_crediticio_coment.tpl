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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul"> {$nombre_inicio}</span></p>
        <p class="txt10 uppercase">Area:<span class="azul"> {$area_inicio}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_analisis_riesgo_crediticio.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Cliente:</label>
                        <select name="ven_cliente_contacto" class="cliente">
                            <option value="{$tabla[0]['id_ven_cliente_contacto']}">
                                {$tabla[0]['apellido']} / {$tabla[0]['empresa']} / {$tabla[0]['nombre_sucursal']}
                            </option>
                        </select>
                    </div>
                    <div class="izq clear">
                        <div class="campania">
                            <label>Asunto:</label>
                            <input name="asunto" type="text" value="{$tabla[0]['asunto']}"  readonly="readonly" alt="Asunto" />
                        </div>
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Detalle: </label>
                    <textarea name="detalle" readonly="readonly">{$tabla[0]['detalle']}</textarea>
                </div>

                <div class="izq clear"><p class="azul bold">ARCHIVOS</p></div>

                <div class="archivo">
                    <label class="block"> Pacto Social </label>
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
                </div>
                <div class="archivos clear">
                    <div class="file marginLat10">
                        <a class="file_name" href='/upload_archivos/ven_analisis_riesgo_crediticio/{$tabla[0]["archivo_contrato_credito"]}' target="_blank">
                            <span>{$tabla[0]["archivo_contrato_credito"]}</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <hr />
        <h2 class="azul bold">
            <span class="txt22 normal">Comentarios</span>
        </h2>
        <hr />
        <form class="box-coment" name="box_coment" action="/ven_analisis_riesgo_crediticio_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
