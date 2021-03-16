<input type="hidden" id ="id-entrada" name="id-entrada" value="<?php echo $id_entrada;?>">

<div class='form-group'>
    <label for='titulo'> Títol </label>
    <input type='text' class='form-control' id='titulo' name="titulo" placeholder="Escriu el títol de l'entrada"
           value ="<?php echo $validador_new -> obtener_titulo(); ?>">
    
    <input type="hidden" id="titulo-original" name="titulo-original" value="<?php echo  $entrada_recuperada-> obtener_titulo_entrada();?>">
    <?php
        $validador_new -> mostrar_error_titulo();
    ?>
</div>  
<br>
<div class='form-group'>
    <label for='url'> URL </label>
    <input type='text' class='form-control' id='url' name="url" placeholder="Direcció-única-sense-espais-per-a-l'entrada"
            value ="<?php echo $validador_new -> obtener_url(); ?>">
    
    <input type="hidden" id="url-original" name="url-original" value="<?php echo $entrada_recuperada-> obtener_url();?>">
    <?php
            $validador_new -> mostrar_error_url();
    ?>
</div>  

<br>
<div class='form-group'>
    <label for='contenido'> Text </label>
    <textarea class="form-control" rows="7" id="contenido" name="texto" placeholder="Escriu aquí el teu article"><?php echo $validador_new -> obtener_texto(); ?></textarea> 
    <input type="hidden" id="texto-original" name="texto-original" value="<?php echo $entrada_recuperada-> obtener_texto_entrada();?>">
    <?php
            $validador_new -> mostrar_error_texto();
    ?>  
</div> 

<div class='checkbox'>
    <label> 
        <input type='checkbox' name="publicar" value="si" <?php if ($entrada_publica_nueva) echo'checked';?>> 
        Vols que la teva publicació es publiqui immediatament?
        
       <input type="hidden" id="checkbox-original" name="checkbox-original" value="<?php echo $entrada_recuperada-> esta_activa_entrada();?>">

        
    </label>
</div> 

<button type='submit' class='btn btn-default pull-right' name="guardar-cambios-entrada">Guardar canvis</button>

