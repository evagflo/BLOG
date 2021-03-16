<?php
$titulo = 'Recuperar Contrassenya';
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div clarr="row">
        <div class=" col-md-3">  
        </div>
        <div class=" col-md-6">  
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h2>Recuperar contrasenya</h2>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo RUTA_GENERAR_URL_SECRETA; ?>">
                        <h4 class='text-center'> Introdueix el teu correu electrònic </h4>
                        <br>
                        <p>
                         Escriu la direcció de correu electrònic amb la que et vas registrar per rebras un email per recuperar la contrasenya. 
                        </p>
                        <br>
                        <label for='usuari' class='sr-only'> Correu electrònic </label>
                        <input type ="email" name="email" id="email" class="form-control" placeholder="Correu electrònic" required autofocus> 
                        <br>

                        <button type='submit' name='enviar-email' class=' btn btn-primary btn-block'> 
                            Enviar</button>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>


