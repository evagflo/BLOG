<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/redireccion.inc.php';
include_once 'app/config.inc.php';

ControlSesion::cerrar_sesion();
redireccion::redirigir(SERVIDOR);

