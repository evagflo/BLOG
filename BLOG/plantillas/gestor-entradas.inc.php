<div class="row parte-gestor-entradas">
    <div clas="col-md-12">
        <h2>Gestió d'entrades</h2>
        <br>
        <a href="<?php echo RUTA_NUEVA_ENTRADA ?>" class="btn btn-lg btn-primary" id='boton-nueva-entrada' role="button">Crear nova entrada</a>
        <br>
        <br>
    </div>
</div>

<div class="row parte-gestor-entradas" >
    <div clas="col-md-12">
        <?php 
            if (count ($array_entradas) > 0)
            {
        ?>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th> Fecha </th>  
                    <th> Títol </th>  
                    <th> Estat </th>  
                    <th> Comentaris </th> 
                    <th>  </th>  
                    <th>  </th>  
                </tr>
            </thead>
            <tbody>
            <?php
                for ($i=0;$i< count($array_entradas);$i++)
                {
                    $entrada_actual= $array_entradas[$i][0];
                    $Comentarios_entrada_actual= $array_entradas[$i][1];
                ?>
                <tr>
                    <td> <?php echo $entrada_actual -> obtener_fecha_entrada();?> </td>  
                    <td> <?php echo $entrada_actual -> obtener_titulo_entrada();?> </td>  
                    <td> <?php echo $entrada_actual -> esta_activa_entrada();?> </td>  
                    <td> <?php echo $Comentarios_entrada_actual; ?> </td>  
                    <td> 
                         <form method="post" action="<?php echo RUTA_EDITAR_ENTRADA;?>">
                            <input type="hidden" name="id_editar" value="<?php echo $entrada_actual -> obtener_entrada_id();?>">
                            <button type="submit" class=" btn btn-default btn-xs" name="editar_entrada"> Editar </button>
                        </form>
                       
                    </td>
                    <td> 
                        <form method="post" action="<?php echo RUTA_BORRAR_ENTRADA;?>">
                            <input type="hidden" name="id_borrar" value="<?php echo $entrada_actual -> obtener_entrada_id();?>">
                            <button type="submit" class=" btn btn-default btn-xs" name="borrar_entrada"> Esborrar </button>
                        </form>
                        
                    </td>
                </tr>
                
                <?php
                }
            ?>
   
            </tbody>
        </table> 
        <?php       
            }
            else
            {
        ?>
        <h3 class="text-center"> ENCARA NO HAS ESCRIT CAP ENTRADA </h3>
        <br>
        <br>
            
        <?php
                
            }
        ?>
  
    </div>
</div> 


     