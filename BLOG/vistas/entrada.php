<?php //
include_once 'app/Conexion.inc.php';

include_once 'app/Usuari.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/repositorioComentario.inc.php';


//$titulo='Blog Eva';
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';

?>


<div class=" container contenido-articulo">
    <div class="row">
        <div class="col-md-12">
            <h1> 
                <?php 
                    echo $entrada -> obtener_titulo_entrada(); 
                ?>
            </h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <p>
                Per
                <a href ="#">
                     <i class="bi-person-fill"></i> <?php echo $autor -> obtener_nombre(); ?>
                </a> 
                el
                <?php echo $entrada -> obtener_fecha_entrada();?>
            </p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <article class="text-justify">
                <?php echo nl2br($entrada -> obtener_texto_entrada()) ;?>
            </article>
        </div>
    </div>
    <?php
     include_once 'plantillas/entradas_al_azar.inc.php';
    ?>
    <br>
    <?php
        if (count($comentarios) > 0)
        {
            include_once 'plantillas/comentarios_entrada.inc.php';
        }
        else
        {
            echo '<p> Encara no hi ha cap comentari! </p>';
        }
    ?>
    
</div>

<?php
    include_once 'plantillas/documento-cierre.inc.php';
?>
