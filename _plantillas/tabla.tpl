<link href="/css/estilos.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto">
    
      <span class="texto_rojo_negrita">Clase Tabla()</span>
      
      <br /><br />
      
      <span class="texto_negrita">Limite inicial</span><br />
      <br />
      
      {html_table tpl="tabla_tpl_1" loop=$tabla1 cols="5" rows="5" show_all="yes"}
      
      <br /><br />
      <br />
      
      <span class="texto_negrita">Tabla compleja</span><br /><br />
      
      {html_table tpl="tabla_tpl_2" loop=$tabla2 cols="5" rows="5" show_all="yes"}
      
      </td>
  </tr>
</table>
