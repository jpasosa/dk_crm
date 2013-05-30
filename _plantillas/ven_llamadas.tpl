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
        <form class="box-entrada" name="add_hotel" action="/ger_planificacion_gastos.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label> Campaña: </label>
                        <input name="campania" type="text" value="{$campaña}"  />
                    </div>
                    <div class="vendedor">
                        <label> Vendedor: </label>
                        <input name="vendedor" type="text" value="{$vendedor}"  />
                    </div>
                    <div class="cliente">
                        <label> Cliente: </label>
                        <input name="cliente" type="text" value="{$cliente}"  />
                    </div>
                </div>
                <div class="der">
                    <div class="sucursal">
                        <label> Sucursal: </label>
                        <input name="sucursal" type="text" value="{$sucursal}"  />
                    </div>
                    <div class="contacto">
                        <label> Contacto: </label>
                        <input name="contacto" type="text" value="{$contacto}"  />
                    </div>
                    <div class="tipoLlamada">
                        <label> Tipo de Llamada: </label>
                        <select name="tipoLlamada">
                            <option value="E">Entrante</option>
                            <option value="S">Saliente</option>   
                        </select>
                    </div>
                    <div class="prioridad">
                        <label> Prioridad: </label>
                        <select name="prioridad">
                            <option value="MB">Muy Baja</option>
                            <option value="B">Baja</option>
                            <option value="M">Media</option>
                            <option value="A">Alta</option>
                            <option value="MA">Muy Alta</option>
                        </select>
                    </div>
                </div>
                <div class="temas marginTop20">
                    <div class="telefono">
                        <label> Telefono: </label>
                        <input name="telefono" type="text" value="{$telefono}"  />
                    </div>
                    <div class="observaciones">
                        <label class="block"> Temas a Tocar: </label>
                        <textarea id="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                    </div>
                </div>  
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                <input type="submit" id="agregar" value="Agregar"/>
            </div>    
        </form>
        <form class="box-entrada" name="add_hotel" action="/ger_planificacion_gastos.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="temas observaciones">
                    <label> Temas a Tocados: </label>
                    <textarea></textarea>
                </div>
                <div class="clear">
                    <div class="prioridad">
                        <label> Fecha: </label>
                        <input name="fecha" type="text" value="{$fecha}"  />
                    </div>
                    <div class="prioridad">
                        <label> Hora: </label>
                        <input name="hora" type="text" value="{$hora}"  />
                    </div>
                </div>
                <div class="observaciones">
                    <label class="block"> Observaciones: </label>
                    <textarea id="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />                   
            </div>    
        </form>


        <form class="box-entrada" name="add_hotel" action="/form_example.html" method="post" enctype="multipart/form-data" >
            <div class="enviar_proceso">
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="enviar" class="enviar" type="submit" value="Guardar" />
            </div>
        </form>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>
