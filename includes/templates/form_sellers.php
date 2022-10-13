<fieldset>
    <legend>Información Personal</legend>

    <label for="formCreateName">Nombre</label>
    <input id="formCreateName" name="seller[name]" type="text" placeholder="Juan" value="<?php echo cleanInput($seller->name); ?>">

    <label for="formCreateLastname">Apellido</label>
    <input id="formCreateLastname" name="seller[lastname]" type="text" placeholder="Perez" value="<?php echo cleanInput($seller->lastname); ?>">

</fieldset>

<fieldset>
    <legend>Contacto</legend>

    <label for="formCreatePhone">Teléfono</label>
    <input id="formCreatePhone" name="seller[phone]" type="tel" placeholder="1222445567" value="<?php echo cleanInput($seller->phone); ?>">

</fieldset>