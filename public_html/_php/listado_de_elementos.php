<?php

$tpl = new PlantillaReemplazos();
$tpl->asignarGlobal('sitio_nombre','Manual de programación: ejemplo de titulo forzado (LISTADO DE ELEMENTOS)');

$paginado_cant_elementos = BDConsulta::consulta('cantidad_elementos', '', 'n');
$paginado_cant_por_pagina = 2;

$paginado = new ArmadoPaginado;
$paginado->cantidadTotal( $paginado_cant_elementos[0]['cantidad'] );
$paginado->cantidadPorPagina( $paginado_cant_por_pagina );
$paginado->textoEstilo( 'link_paginas' );
$paginado->textoEstiloActual( 'texto_azul' );

$tpl->asignar('elementos_tabla', BDConsulta::consulta('consulta', array( $paginado->limiteInicialConsulta(), $paginado_cant_por_pagina ), 'n', 5) ); // se esta guardando por 5 segundos la consulta en cache
$tpl->asignar('paginado', $paginado->obtenerPaginado());
$tpl->obtenerPlantilla();
