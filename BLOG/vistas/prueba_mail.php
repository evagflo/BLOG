<?php
include_once 'app/Conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/escritorEntradas.inc.php';

$titulo='Recuperant contrasenya...';
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';

$destinatario= $email;//"evagonzalezflo@gmail.com"; //email usuario
$asunto ="Sol·licitud de recuperació de contrasenyapel 'Blog de l'Eva'";
$header= "Content-type:text/html";

$mensaje0= "Hola ". $nombre_usuario.",\n";
$mensaje1="Per recuperar la contrasenya fes click al següent link:\n";

$link="http://localhost:8888/BLOG/recuperacion-clave/". $url_secreta . "\n\n"; 

$link1 = "<a href='";
$link2 = "'> Inicia sessió </a>";

$mensaje2 = $link1.$link.$link2;
echo $mensaje2;

$mensaje3="Si no has demanat recuperar la contrasenya no facis cas d'aques misstage. Gràcies.\n\n";
$mensaje4="Eva Gonzalez Flo.\n";
        
$mensaje= $mensaje0.$mensaje1.$mensaje2.$mensaje3.$mensaje4;

$exito = mail($destinatario,$asunto,$mensaje);

if($exito)
{
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
                        <div class="panel-body text-center">
                            <h3>Recuperació correcte!</h3>
                            <p>Revisa el teu email per a recueprar la contrasenya</p>
                        </div>
                    </div>
                </div>
                <div class=" col-md-3">  
                </div>
       
        
    </div>
</div> 
    <?php
}
else
{
    ?>
    <h1>Recuperació de la contrasenya</h1>
        <h3>Recuperació fallida!</h3>
        <p>L'email que has introduit no és vàlid</p>
    <?php
}
?>

