<?php
include_once '../../config.php'; 

require 'create_user_modal.php';
?>
<button type="button" class="btn btn-primary col-lg-2 m-2" data-bs-toggle="modal" data-bs-target="#createUserModal">
    Crear Usuario
</button>
<div class="col-lg-10 m-2">
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
                                    <a href='../business_logic/editar_usuario.php?id=" . urlencode($row['id_usuario']) . "' class='btn btn-sm btn-primary'>Editar</a>
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
