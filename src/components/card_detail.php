<?php
$sanitized = str_replace(',', '', $price); 
$priceS = floatval($sanitized); 
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Card principal -->
        <div class="col-12">
            <div class="card d-flex flex-row align-items-center p-3">
                <!-- Imagen del perfume -->
                <div class="w-50 text-center">
                    <img src="<?php echo PUB ?>uploads/perfumes/<?php echo $image ?>" 
                         class="img-fluid" 
                         alt="Imagen del perfume" 
                         style="max-height: 300px; object-fit: contain;" />
                </div>
                <!-- Información del perfume -->
                <div class="w-50 px-4" id="info-container">
                    <!-- Modo visualización -->
                    <div id="view-mode">
                        <h3 class="card-title"><?php echo $name; ?></h3>
                        <p class="card-text"><strong>Marca:</strong> <span id="brand-text"><?php echo $brand; ?></span></p>
                        <p class="card-text"><strong>Género:</strong> <span id="gender-text"><?php echo $gender; ?></span></p>
                        <p class="card-text"><strong>Tamaño:</strong> <span id="size-text"><?php echo $size; ?></span> ml</p>
                        <p class="card-text"><strong>Concentración:</strong> <span id="concentration-text"><?php echo $concentration; ?></span></p>
                        <h4 class="text-success"><strong>$<span id="price-text"><?php echo $price; ?></span></strong></h4>
                        <a href="../views/list_perfumes.php" class="btn btn-primary mt-3">Volver al Catálogo</a>
                        <button class="btn btn-secondary mt-3" id="edit-button">Editar</button>
                    </div>
                    <!-- Modo edición -->
                    <div id="edit-mode" class="d-none">
                        <form id="form" action="../business_logic/perfumes/update_perfume.php" method="post">
                            <input type="hidden" id="perfumeId" value="<?php echo $perfume_id; ?>">
                            <label for="name-input" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name-input" class="form-control mb-2" value="<?php echo $name; ?>" />

                            <label for="brand-input" class="form-label">Marca</label>
                            <input type="text"  name="brand" id="brand-input" class="form-control mb-2" value="<?php echo $brand; ?>" />

                            <label for="gender-input" class="form-label">Género</label>
                            <select id="gender-input"  name="gender" class="form-select mb-2">
                                <option value="Masculino" <?php if ($gender === 'Masculino') echo 'selected'; ?>>Masculino</option>
                                <option value="Femenino" <?php if ($gender === 'Femenino') echo 'selected'; ?>>Femenino</option>
                                <option value="Unisex" <?php if ($gender === 'Unisex') echo 'selected'; ?>>Unisex</option>
                            </select>

                            <label for="size-input" class="form-label">Tamaño (ml)</label>
                            <input type="number"  name="size" id="size-input" class="form-control mb-2" value="<?php echo $size; ?>" />

                            <label for="concentration-input" class="form-label">Concentración</label>
                            <input type="text"  name="concentration" id="concentration-input" class="form-control mb-2" value="<?php echo $concentration; ?>" />

                            <label for="price-input" class="form-label">Precio</label>
                            <input type="number"  name="price" id="price-input" class="form-control mb-2" value="<?php echo $priceS; ?>" />

                            <button class="btn btn-success mt-3" type="submit" id="save-button">Guardar</button>
                            <div class="btn btn-danger mt-3" id="cancel-button">Cancelar</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Variables para los elementos
    const viewMode = document.getElementById('view-mode');
    const editMode = document.getElementById('edit-mode');
    const editButton = document.getElementById('edit-button');
    const saveButton = document.getElementById('save-button');
    const cancelButton = document.getElementById('cancel-button');

    // Mostrar modo edición
    editButton.addEventListener('click', () => {
        viewMode.classList.add('d-none');
        editMode.classList.remove('d-none');
    });

    // Cancelar edición y volver al modo visualización
    cancelButton.addEventListener('click', () => {
        editMode.classList.add('d-none');
        viewMode.classList.remove('d-none');
    });
</script>
