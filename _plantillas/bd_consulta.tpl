<link href="/css/estilos.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><p class="texto_rojo_negrita">BDConsulta()<br /></p>

    {foreach key=key item=valores from=$consulta}
    	{$$key} : {$$valores[id]}, {$$valores[orden]}, {$$valores[texto]}<br />
    {/foreach}
    
    <br /><br />
    
    {foreach key=key item=valores from=$consulta_sv}
    	{$$key} : {$$valores[id]}, {$$valores[orden]}, {$$valores[titulo]}<br />
	{foreachelse}
        No se obtuvieron valores de la tabla.
    {/foreach}

    <br /><br /><br />

	{html_checkboxes name="id" options=$opciones selected=$seleccionado style="input2" separator="<br />"}

    <br /><br />

	{html_checkboxes name="id" options=$opciones selected=$seleccionado style="input2" separator="<br />"}

    <br /><br />

	{html_radios name="id" options=$opciones selected=$seleccionado_uno style="input3" separator="<br />"}

    </td>
  </tr>
</table>
