<?php

/**/
include '../controller/muestra_pagina.php';

$muestra_grupo = new mostrar();

//---------------------------------------------------------
$pagina    = 'cont_acompanamiento.php';
$scripts   = array('test_validaPV3.js','cont_acompanamiento_marco.js');
$id_modulo = 17;
//---------------------------------------------------------

$muestra_grupo->mostrar_pagina_scripts($pagina, $scripts, $id_modulo);
