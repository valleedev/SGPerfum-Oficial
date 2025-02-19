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
                        <h3 class="card-title" id="view-name"><?php echo $name; ?></h3>
                        <p class="card-text"><strong>Casa:</strong> <span id="view-house"><?php echo $house; ?></span></p>
                        <p class="card-text"><strong>Código:</strong> <span id="view-keyB"><?php echo $keyB; ?></span></p>
                        <p class="card-text"><strong>Familia Olfativa:</strong> <span id="view-familyO"><?php echo $familyO; ?></span></p>
                        <p class="card-text"><strong>Género:</strong> <span id="view-gender"><?php echo $gender; ?></span></p>
                        <p class="card-text"><strong>Gramos Disponibles:</strong> <span id="view-size"><?php echo $size; ?></span> gr</p>
                        <a href="../views/list_perfumes.php" class="btn btn-primary mt-3">Volver al Catálogo</a>
                        <button class="btn btn-secondary mt-3" id="edit-button">Editar</button>
                    </div>
                    <!-- Modo edición -->
                    <div id="edit-mode" class="d-none">
                        <form id="form" action="../business_logic/perfumes/update_perfume.php" method="post">
                            <input type="hidden" id="perfumeId" name="id" value="<?php echo $perfume_id; ?>">

                            <label for="name-input" class="form-label">Código</label>
                            <input type="text" name="keyB" id="name-input" class="form-control mb-2" value="<?php echo $keyB; ?>" />

                            <label for="name-input" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name-input" class="form-control mb-2" value="<?php echo $name; ?>" />

                            <label for="brand-input" class="form-label">Casa</label>
                            <input type="text" name="house" id="brand-input" class="form-control mb-2" value="<?php echo $house; ?>" />

                            <label for="gender-input" class="form-label">Género</label>
                            <select id="gender-input" name="gender" class="form-select mb-2">
                                <option value="Masculino" <?php if ($gender === 'Masculino') echo 'selected'; ?>>Masculino</option>
                                <option value="Femenino" <?php if ($gender === 'Femenino') echo 'selected'; ?>>Femenino</option>
                                <option value="Unisex" <?php if ($gender === 'Unisex') echo 'selected'; ?>>Unisex</option>
                            </select>

                            <label for="brand-input" class="form-label">Familia Olfativa</label>
                            <input type="text" name="familyO" id="brand-input" class="form-control mb-2" value="<?php echo $familyO; ?>" />

                            <label for="size-input" class="form-label">Gramos Disponibles (gr)</label>
                            <input type="number" name="size" id="size-input" class="form-control mb-2" value="<?php echo $size; ?>" />

                            <!--
                            <label for="image-input" class="form-label">Imagen</label>
                            <input type="file" name="image" id="image-input" class="form-control mb-2"/>
-->
                            <!-- Botones de acción -->
                            <button class="btn btn-success mt-3" type="submit" id="save-button">Guardar</button>
                            <div class="btn btn-secondary mt-3" id="cancel-button">Cancelar</div>

                            
                            <!-- Botón para abrir el formulario de eliminación -->
                            <button type="button" class="btn btn-outline-danger mt-3 " id="delete-toggle-button">
                                Eliminar Fragancia
                            </button>
                            <!-- Aquí comienza la sección de eliminación, oculta inicialmente -->
                            <div id="delete-section" class="mt-3" style="display: none;">
                                <p class="text-danger">¡Advertencia! Esta acción eliminará la fragancia de manera permanente.</p>
                               
                                <button  type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#warning-alert-modal">Eliminar</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--Modals-->
    <!-- Warning Alert Modal -->
    <div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="bx bxs-no-entry h1 text-warning"></i>
                        <h4 class="mt-2">Esto es una zona de riesgo</h4>
                        <p class="mt-3">Si usted esta completamente seguro que desea eliminar la fragancia de click en aceptar, de lo contrario haga click fuera del modal.</p>
                        <form id="delete-form" action="../business_logic/delete_perfume.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $perfume_id; ?>">
                            <button type="submit" class="btn btn-warning my-2" data-bs-dismiss="modal">Aceptar</button>
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

    // JavaScript para alternar la visibilidad de la sección de eliminación
    document.getElementById("delete-toggle-button").addEventListener("click", function() {
    var deleteSection = document.getElementById("delete-section");
    if (deleteSection.style.display === "none" || deleteSection.style.display === "") {
        deleteSection.style.display = "block";
    } else {
        deleteSection.style.display = "none";
    }
    });
    document.getElementById('change-image').addEventListener('click', () => {
    document.getElementById('upload-form').style.display = 'block';
});

</script>
