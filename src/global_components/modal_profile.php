<!-- Modal Perfil -->
<?php
$id_rol = $usuario['rol_id'];
$rol = $con->query("SELECT nombre_rol FROM roles WHERE id_rol = $id_rol")->fetch_assoc();
$roles = $con->query("SELECT id_rol, nombre_rol FROM roles"); // Obtener todos los roles
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
                    <!-- Campo oculto para enviar el id_usuario -->
                    <input type="hidden" id="idUsuario" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']); ?>">

                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombre" value="<?= htmlspecialchars($usuario['nombre']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="emailUsuario" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="emailUsuario" name="email" value="<?= htmlspecialchars($usuario['email']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="rolUsuario" class="form-label">Rol</label>
                        <select class="form-control" id="rolUsuario" name="rol_id">
                            <?php while ($row = $roles->fetch_assoc()): ?>
                                <option value="<?= $row['id_rol']; ?>" <?= $row['id_rol'] == $id_rol ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($row['nombre_rol']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
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