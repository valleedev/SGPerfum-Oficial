<!-- Modal Perfil -->
<?php
$id_rol = $usuario['rol_id'];
$rol = $con->query("SELECT nombre_rol FROM roles WHERE id_rol = $id_rol")->fetch_assoc();
?>
<div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="perfilModalLabel">Información del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="perfilForm">
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombre" value="<?= htmlspecialchars($usuario['nombre']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="emailUsuario" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="emailUsuario" name="email" value="<?= htmlspecialchars($usuario['email']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefonoUsuario" class="form-label">Rol</label>
                        <input type="text" class="form-control" id="telefonoUsuario" name="telefono" value="<?= htmlspecialchars($rol['nombre_rol']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="passwordUsuario" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="passwordUsuario" name="password" placeholder="Ingrese una nueva contraseña si desea cambiarla">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>