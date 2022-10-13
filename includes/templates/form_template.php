<fieldset>
    <legend>Información General</legend>

    <label for="formCreateTittle">Título</label>
    <input id="formCreateTittle" name="property[tittle]" type="text" placeholder="Título de la Propiedad" value="<?php echo cleanInput($property->tittle); ?>">

    <label for="formCreatePrice">Precio ($)</label>
    <input id="formCreatePrice" name="property[price]" type="number" placeholder="$100,000" min=0 max=99999999 value="<?php echo cleanInput($property->price); ?>">

    <label for="formCreateImage">Image</label>
    <input id="formCreateImage" name="property[image]" type="file" accept="image/jpeg, image/png">

    <?php if ($property->image) : ?>
        <img class="small-image" src="/images/<?php echo $property->image; ?>" alt="Imagen de la Propiedad">
    <?php endif; ?>

    <label for="formCreateDescription">Descripción</label>
    <textarea id="formCreateDescription" name="property[description]" cols="30" rows="10"><?php echo cleanInput($property->description); ?></textarea>

</fieldset>

<fieldset>
    <legend>Características de la Propiedad</legend>

    <label for="formCreateBRooms">Habitaciones</label>
    <input id="formCreateBRooms" type="number" name="property[bedrooms]" placeholder="0" min=0 max=9 value="<?php echo cleanInput($property->bedrooms); ?>">

    <label for="formCreateWC">Baños</label>
    <input id="formCreateWC" type="number" name="property[wc]" placeholder="0" min=0 max=9 value="<?php echo cleanInput($property->wc); ?>">

    <label for="formCreateParking">Estacionamientos</label>
    <input id="formCreateParking" type="number" name="property[parking]" placeholder="0" min=0 max=9 value="<?php echo cleanInput($property->parking); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <select id="formCreateSeller" name="property[sellers_id]">
        <option selected disabled>-Seleccionar-</option>
        <?php foreach ($sellers as $seller) : ?>
            <option <?php echo $property->sellers_id === $seller->id ? 'selected' : '' ?> value="<?php echo cleanInput($seller->id); ?>">
                <?php echo cleanInput($seller->name) . " " . cleanInput($seller->lastname); ?>
            </option>
        <?php endforeach; ?>
    </select>
</fieldset>