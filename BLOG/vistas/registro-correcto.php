<?php

include_once 'app/Conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Usuari.inc.php';
include_once 'app/redireccion.inc.php';

$title= 'Registre correcte!';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';







?>

<div class=" container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="bi-check-circle"></i> Registre correcte
                </div>
                <div class="panel-body text-center">
                    <p> Gràcies per registrar-te <b> <?php echo $nombre ?> </b> !</p>
                    <br>
                    <p> <a href="<?php echo RUTA_LOGIN ?>"> Inicia sessió </a>  per utilitzar el teu conte</p>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?php

    include_once 'plantillas/documento-cierre.inc.php';
?>
