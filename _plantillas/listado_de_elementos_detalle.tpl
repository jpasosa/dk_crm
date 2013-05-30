<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><p class="texto_rojo_negrita">Listado de elementos detalles</p>
      <br />
      El valor del id del elemento se puede obtener fácilmente utilizando la clase <strong>VariableGet::id()</strong> sin ningún parámetro.
      <br />
      <br />
      <p><strong>Orden:</strong> {$consulta_detalle['orden']}
      <br />
      <br />
      <strong>Título:</strong> {$consulta_detalle['titulo']}
      <br />
      <br />
      <strong>Texto:</strong> {$consulta_detalle['texto']}
      <br />
      <br />
      <strong>Fecha de alta:</strong> {$consulta_detalle['fecha_alta']|date_format:"d/m/Y h:i:s"}
      <br />
      <br />
      <strong>Link:</strong> <a href="http://{$consulta_detalle['link']}" target="_blank">{$consulta_detalle['link']}</a>
      <br />
      <br />
      </p>
      <br />
      <br />
      <a href="javascript:history.go(-1);">Volver</a>
      </td>
  </tr>
</table>
