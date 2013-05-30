<link href="/css/estilos.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><span class="texto_rojo_negrita">ArchivoObtenerDatos()</span>
    <br /><br />
    {foreach key=key item=valores from=$datos}
    	{$$key} : {$$valores[id]} : {$$valores[Responsable]|upper} , {$$valores[Usuario]} , {$$valores[Mail]|lower} , {$$valores[Telefono]|default:"(sin teléfono)"}<br />
    {/foreach}
    </td>
  </tr>
</table>
