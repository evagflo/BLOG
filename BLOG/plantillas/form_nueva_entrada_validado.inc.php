<div class='form-group'>
    <label for='titulo'> Títol </label>
    <input type='text' class='form-control' id='titulo' name="titulo" placeholder="Escriu el títol de l'entrada" 
        <?php $validador -> mostrar_titulo();?>>

    <?php  $validador -> mostrar_error_titulo();?>
</div>  
<br>
<div class='form-group'>
    <label for='url'> URL </label>
    <input type='text' class='form-control' id='url' name="url" placeholder="Direcció-única-sense-espais-per-a-l'entrada"
           <?php  $validador -> mostrar_url()?>>
    
      <?php  $validador -> mostrar_error_url();?>
</div>  

<br>
<div class='form-group'>
    <label for='contenido'> Text </label>
    <textarea class="form-control" rows="7" id="contenido" name="texto" placeholder="Escriu aquí el teu article"
              ><?php $validador -> mostrar_texto(); ?></textarea>   <!--<> JUNTS-->
      <?php  $validador -> mostrar_error_texto();?>
  
</div> 
<div class='checkbox'>
    <label> 
        <input type='checkbox' name="publicar" value="si" <?php if ($entrada_publica) echo 'checked'; ?>
               > Vols que la teva publicació es publiqui immediatament?
    </label>
</div> 

<button type='submit' class='btn btn-default pull-right' name="guardar">Guardar entrada</button>

