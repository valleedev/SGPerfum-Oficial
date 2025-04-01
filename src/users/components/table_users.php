<?php
include_once '../../config.php'; 

require 'create_user_modal.php';
require 'update_user_modal.php';
?>
<button type="button" class="btn btn-primary col-lg-2 m-2" data-bs-toggle="modal" data-bs-target="#createUserModal">
    Crear Usuario
</button>
<div class="col-lg-7 m-2">
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-striped table-nowrap mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verificar conexión
                    if ($con->connect_error) {
                        die("Error de conexión: " . $con->connect_error);
                    }

                    // Consulta para obtener los usuarios
                    $sql = "SELECT * FROM usuarios";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        // Mostrar los datos de cada usuario
                        while ($row = $result->fetch_assoc()) {
                            $id_rol = $row['rol_id'];
                            $rol_sql = "SELECT nombre_rol FROM roles WHERE id_rol = '$id_rol'";
                            $rol_result = $con->query($rol_sql);
                            $rol_row = $rol_result->fetch_assoc();
                            echo "<tr>";
                            echo "<td class='table-user'><a href='javascript:void(0);' class='text-body font-weight-semibold'>" . htmlspecialchars($row['nombre']) . "</a></td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($rol_row['nombre_rol']) . "</td>";
                            echo "<td>
                                    <button type='button' class='btn btn-sm btn-primary btn-edit-user' data-id='" . htmlspecialchars($row['id_usuario']) . "' data-bs-toggle='modal' data-bs-target='#updateUserModal'>Editar</button>
                                    <a href='../business_logic/delete_user.php?id_usuario=" . urlencode($row['id_usuario']) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar este usuario?\");'>Eliminar</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No hay usuarios registrados</td></tr>";
                    }

                    // Cerrar conexión
                    $con->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--end card body-->
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-edit-user');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            
            // Realizar una solicitud AJAX para obtener los datos del usuario
            fetch(`../business_logic/get_user.php?id_usuario=${userId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Llenar los campos del modal con los datos del usuario
                        document.getElementById('updateUserId').value = data.user.id_usuario;
                        document.getElementById('updateUserName').value = data.user.nombre;
                        document.getElementById('updateUserEmail').value = data.user.email;

                        // Llenar el select de roles
                        const roleSelect = document.getElementById('updateUserRole');
                        roleSelect.innerHTML = ''; // Limpiar opciones existentes
                        data.roles.forEach(role => {
                            const option = document.createElement('option');
                            option.value = role.id_rol;
                            option.textContent = role.nombre_rol;
                            if (role.id_rol == data.user.rol_id) {
                                option.selected = true;
                            }
                            roleSelect.appendChild(option);
                        });
                    } else {
                        alert('Error al cargar los datos del usuario.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
});
</script>