<?php
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
                        <p class="card-text"><strong>Casa:</strong> <span id="brand-text"><?php echo $house; ?></span></p>
                        <p class="card-text"><strong>Clave Bouquet:</strong> <span id="brand-text"><?php echo $keyB; ?></span></p>
                        <p class="card-text"><strong>Familia Olfativa:</strong> <span id="brand-text"><?php echo $familyO; ?></span></p>
                        <p class="card-text"><strong>Género:</strong> <span id="gender-text"><?php echo $gender; ?></span></p>
                        <p class="card-text"><strong>Cantidad Disponible:</strong> <span id="size-text"><?php echo $size; ?></span> ml</p>
                        <a href="../views/list_perfumes.php" class="btn btn-primary mt-3">Volver al Catálogo</a>
                        <button class="btn btn-secondary mt-3" id="edit-button">Editar</button>
                    </div>
                    <!-- Modo edición -->
                    <div id="edit-mode" class="d-none">
                        <form id="form" action="../business_logic/perfumes/update_perfume.php" method="post">
                            <input type="hidden" id="perfumeId" value="<?php echo $perfume_id; ?>">
                            
                            <label for="name-input" class="form-label">Clave Bouquet</label>
                            <input type="text" name="keyB" id="name-input" class="form-control mb-2" value="<?php echo $keyB; ?>" />

                            <label for="name-input" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name-input" class="form-control mb-2" value="<?php echo $name; ?>" />

                            <label for="brand-input" class="form-label">Casa</label>
                            <input type="text"  name="house" id="brand-input" class="form-control mb-2" value="<?php echo $house; ?>" />

                            <label for="gender-input" class="form-label">Género</label>
                            <select id="gender-input"  name="gender" class="form-select mb-2">
                                <option value="Masculino" <?php if ($gender === 'Masculino') echo 'selected'; ?>>Masculino</option>
                                <option value="Femenino" <?php if ($gender === 'Femenino') echo 'selected'; ?>>Femenino</option>
                                <option value="Unisex" <?php if ($gender === 'Unisex') echo 'selected'; ?>>Unisex</option>
                            </select>

                            <label for="brand-input" class="form-label">Familia Olfativa</label>
                            <input type="text"  name="familyO" id="brand-input" class="form-control mb-2" value="<?php echo $familyO; ?>" />

                            <label for="size-input" class="form-label">Cantidad Disponible (ml)</label>
                            <input type="number"  name="size" id="size-input" class="form-control mb-2" value="<?php echo $size; ?>" />


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
