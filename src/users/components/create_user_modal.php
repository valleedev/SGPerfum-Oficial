<?php
require_once '../../config.php';

$roles = [];
$sql = "SELECT id_rol, nombre_rol FROM roles ORDER BY id_rol DESC";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $roles[] = $row; 
    }
}
?>
<style> 
    .modal {
        z-index: 1055;
    }
    .modal-backdrop {
        z-index: 1050;
    }
</style>

<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createUserForm" method="POST" action="../business_logic/create_user.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-select" id="role" name="role" required>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= htmlspecialchars($role['id_rol']) ?>">
                                    <?= htmlspecialchars($role['nombre_rol']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>