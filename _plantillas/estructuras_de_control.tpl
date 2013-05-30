<link href="/css/estilos.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><p class="texto_rojo_negrita">Estructuras de control<br /></p>


{$contactos[1]["telefono"]}<br /><br /><br />

    {* todos los tributos de las etiquetas son obligatorios *}

	{* estructura foreach *}
    
    {foreach item=nombre from=$nombres}
    	{$$nombre[1]}, {$$nombre[0]}<br />
    {/foreach}

    <br /><br />
    
    {foreach item=asoc from=$asoc}
        {$$asoc}<br />
    {/foreach}

    <br /><br />

    {* estructura foreach controlando si no se obtuvieron valores en el array *}
    
    {* el foreachelse se usa especialmente para las consultas a base de datos que no entrega valores *}
    
    {foreach item=valor from=$cosas}
    	El valor ingresado el foreach ES un array.
	{foreachelse}
    	El valor ingresado el foreach NO ES un array.
    {/foreach}

    <br /><br />

    <strong>Estructura de un foreach con KEY</strong> <br />
    {* estructura foreach con key *}

    {foreach key=key item=nombre from=$nombres}
    	{$$key} : {$$nombre[1]}, {$$nombre[0]}<br />
    {/foreach}

    <br /><br />

    {foreach item=contacto from=$contactos}
      {foreach key=key item=item from=$$contacto}
        {$$key}: {$$item}<br />
      {/foreach}
    {/foreach}

    <br /><br />

    {if $contactos[0]["telefono"] == "1"}
        La variable "$contactos[0][telefono]" es igual a 1.
    {else}
        La variable "$contactos[0][telefono]" es diferente a 1.
    {/if}    

    <br /><br />

    {if $nombre === false}
        La variable nombre es 'false'.
    {elseif $nombre == "Marcelo"}
        La variable nombre es igual a "Marcelo".
    {else}
        La variable "$nombre" no es 'false' y no es "Marcelo".
    {/if}    

    <br /><br />

    {if $nombre == $nada}
        La variable nombre es igual a la variable nada.
    {elseif $nombre != $contactos[0]['telefono']}
        La variable "$nombre" no es igual a la variable "$contactos[0][telefono]".
    {/if}

    </td>
  </tr>
</table>
