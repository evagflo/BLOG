<div class='form-group'> 
    <label>Nom d'usuari</label>
    <input type='text' class='form-control' name='nombre' placeholder='Eva' <?php $validador -> mostrar_nombre() ?>> 
    <?php 
        $validador -> mostrar_error_nombre();
    ?>
</div>

<div class='form-group'> 
    <label>Email</label>
    <input type='email' class='form-control' name='email'placeholder='usuari@gmail.com' <?php $validador -> mostrar_email() ?>> 
    <?php 
        $validador -> mostrar_error_email();
    ?>
</div>

<div class='form-group'> 
    <label>Contrasenya</label>
    <input type='password' class='form-control' name='clave1'placeholder='****'> 
    <?php 
        $validador -> mostrar_error_clave1();
    ?>
</div>

<div class='form-group'> 
    <label>Repeteix la contrasenya</label>
    <input type='password' class='form-control' name='clave2'placeholder='****'> 
    <?php 
        $validador -> mostrar_error_clave2();
    ?>
</div>
<br>
<button class= btn btn-default btn-prymary type='reset'>Reiniciar</button>
<button class= btn btn-default btn-prymary type='sumbit' name='enviar'> Enviar</button>


