<?php


include_once 'app/Conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/escritorEntradas.inc.php';

//$titulo='Blog Eva';
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';
?>

<!-- COS -->  
<div class="container">
    <div class="jumbotron">
        <h1>Blog de l'Eva Gonzalez Flo </h1>
        <p>Aquest blog està dedicat a l'aprenentage de pàgines web</p>
    </div>
</div> 

<!-- REJILLA -->  
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"  >
                            <h4> 
                                <i class="bi-search"></i> BUSCAR 
                            </h4> 
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>"> 
                                <div class="form-group">
                                    <input type="search" name="termino-buscar" class="form-control" placeholder="Què busques?">
                                </div>
                                <button type="sumbit" name="busca" class="form-control btn btn-primary">
                                    Buscar
                                </button>
                            </form>
                        </div>
                    </div>
                </div> 
            </div> 
            <div class='row'>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4> 
                                <i class="bi-filter"></i> Filtre
                            </h4>
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4> 
                                <i class="bi-calendar"></i> Arxiu
                            </h4>
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <?php
            
            escritorEntradas::escribir_entradas();
            ?>
        </div>  
    </div>
</div>



<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
