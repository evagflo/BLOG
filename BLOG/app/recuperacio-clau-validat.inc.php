<div class='form-group'>
    <label for='clave'>Contrasenya nova</label>
    <input type='password' name='clave' id='clave' class='form-control' placeholder='Mínim 6 caràcters' required>
    <?php
    $validador_clave->mostrar_error_clave1();
    ?>
</div>

<div class='form-group'>
    <label for='clave'>Repeteix la contrasenya nova</label>
    <input type='password' name='clave2' id='clave2' class='form-control' placeholder='La contrasenya ha de coincidir' required>
    <?php
    $validador_clave->mostrar_error_clave2();
    ?>
</div>

<button type='submit' name='guardar-clave' class='btn btn-primary btn-block'>Guardar contrasenya</button>

