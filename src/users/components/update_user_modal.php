<style> 
    .modal {
        z-index: 1055;
    }
    .modal-backdrop {
        z-index: 1050;
    }
</style>
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateUserForm" action="../business_logic/update_user.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel">Actualizar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_usuario" id="updateUserId">
                    <div class="mb-3">
                        <label for="updateUserName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="updateUserName" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateUserEmail" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="updateUserEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateUserRole" class="form-label">Rol</label>
                        <select class="form-control" id="updateUserRole" name="rol_id" required>
                            <!-- Opciones de roles se llenarán dinámicamente -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>