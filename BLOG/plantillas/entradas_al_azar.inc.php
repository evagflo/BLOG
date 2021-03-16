<?php
include_once 'app/escritorEntradas.inc.php';
include_once 'app/Entrada.inc.php';
?>

<div class ="row">
    <div class=" col-md-12">
        <hr>
        <h3>Altres entrades interessants...</h3>
        <br>
    </div>
    <?php
    
    for ($i=0; $i < count($entradas_al_azar); $i++)
    {
        
        $entrada_actual = $entradas_al_azar[$i];
        
     
        
    
    ?>
    <div class ="col-md-4">
        <div class="panel panel-default">
            <div class=" panel panel-heading">
                <?php echo  $entrada_actual -> obtener_titulo_entrada(); ;?>
            </div>
            <div class="panel panel-body text-justify">
                <p>
                    <?php  echo escritorEntradas::resumir_texto(nl2br($entrada_actual -> obtener_texto_entrada()));?> 
                    <!--escritor_Entradas::resumir_texto(nl2br($entrada_actual));-->
                </p>
                
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    
<!--    <div class="col-md-12">
        <hr>
    </div>-->
</div>
