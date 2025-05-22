<div class="container mt-5">
    <h1 class="mb-4">Configuración</h1>
    <div class="row">
        <!-- Menú lateral -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="#envases" class="list-group-item list-group-item-action active" data-bs-toggle="tab">Envases</a>
                <a href="#gramo-adicional" class="list-group-item list-group-item-action" data-bs-toggle="tab">Gramo Adicional</a>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="col-md-9">
            <div class="tab-content">
                <!-- Sección Envases -->
                <div class="tab-pane fade show active" id="envases">
                    <h3>Configuración de Envases</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Capacidad Mls</th>
                                <th>Precio Actual</th>
                                <th>Nuevo Precio</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Consulta para obtener los envases
                            $envases = $con->query("SELECT * FROM envases");
                            while ($envase = $envases->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($envase['capacidad_mls']); ?></td>
                                <td>$<?= number_format($envase['precio'], 2); ?></td>
                                <td>
                                    <input type="number" class="form-control" id="nuevoPrecio_<?= $envase['id_envase']; ?>" placeholder="Nuevo precio" step="0.01" min="0">
                                </td>
                                <td>
                                    <button class="btn btn-primary" onclick="actualizarPrecio(<?= $envase['id_envase']; ?>)">Actualizar</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Sección Preferencias -->
                <div class="tab-pane fade" id="gramo-adicional">
                    <h3>Preferencias</h3>
                    <form id="preferenciasForm">
                        <div class="mb-3">
                            <label for="temaUsuario" class="form-label">Tema</label>
                            <select class="form-control" id="temaUsuario" name="tema">
                                <option value="claro">Claro</option>
                                <option value="oscuro">Oscuro</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function actualizarPrecio(idEnvase) {
        const nuevoPrecio = document.getElementById(`nuevoPrecio_${idEnvase}`).value;

        if (nuevoPrecio === '' || parseFloat(nuevoPrecio) < 0) {
            alert('Por favor, ingrese un precio válido.');
            return;
        }

        // Enviar la solicitud AJAX para actualizar el precio
        fetch('update_envase_price.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id_envase: idEnvase,
                nuevo_precio: nuevoPrecio,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Precio actualizado correctamente.');
                location.reload(); // Recargar la página para reflejar los cambios
            } else {
                alert('Error al actualizar el precio: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al actualizar el precio.');
        });
    }
</script>