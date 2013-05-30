<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><p class="texto_rojo_negrita">Listado de elementos</p>
      <br />
      Cuando se arma un link a un elemento de una tabla, se debe enviar como último elemento del link, el nombre / título y concatenado al final el id del mismo.
      <br />
      <br />
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50" height="20" align="center" class="tabla_titulos">Orden</td>
          <td class="tabla_titulos">Título</td>
          <td class="tabla_titulos">Texto</td>
          <td class="tabla_titulos">Fecha de alta</td>
          <td class="tabla_titulos">Link</td>
        </tr>
        {foreach item=elementos from=$elementos_tabla}
        <tr>
          <td height="60" align="center">{$$elementos['orden']}</td>
          <td><a href="{#link/Listado de elementos detalle/$$elementos['titulo']:$$elementos['id']}">{$$elementos['titulo']}</a></td>
          <td>{$$elementos['texto']}</td>
          <td>{$$elementos['fecha_alta']|date_format:"d/m/Y h:i:s"}</td>
          <td><a href="http://{$$elementos['link']}" target="_blank">{$$elementos['link']}</a></td>
        </tr>
        <tr>
          <td colspan="5" height="1" bgcolor="#999999"></td>
        </tr>
        {foreachelse}
        <tr>
          <td colspan="5" align="center">Sin datos</td>
        </tr>
        {/foreach}
      </table>
      <br />
      <br />
      <span class="texto_negrita">Paginado:</span> {$paginado} </td>
  </tr>
</table>
