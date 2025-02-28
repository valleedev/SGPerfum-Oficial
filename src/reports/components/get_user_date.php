<?php
include '../business_logic/get_users.php';

?>
<div class="report p-3">
    <form id="form" action="../business_logic/general_logic_report.php" method="POST" class="form-inline"">
        <div class="row">
            <div class="form-group mb-2 mr-2 col-md-3">
                <label for="vendedor" class="mr-2">Vendedor:</label>
                <select class="form-control" name="vendedor" id="vendedor" required>
                    <option value="0" disabled selected>nombres vendedores</option>
                    <?php
                    foreach ($usuarios as $usuario) {
                        echo "<option value='{$usuario['id_usuario']}'>{$usuario['nombre']}</option>";
                    };
                    ?>
                </select>
            </div>
            <div class="form-group mb-2 mr-2 col-md-3">
                <label for="fecha" class="mr-2">Fecha:</label>
                <select class="form-control" name="fecha" id="fecha" onchange="toggleCustomDate(this.value)">
                    <option value="hoy">Hoy</option>
                    <option value="mes">Este mes</option>
                    <option value="ano">Este año</option>
                    <option value="personalizado">Personalizado</option>
                </select>
            </div>
            <div id="custom-date" class="form-group mb-2 mr-2 col-md-4" style="display: none;">
                <label for="fecha_inicio" class="mr-2">Fecha Inicio:</label>
                <input type="date" class="form-control mr-2" name="fecha_inicio" id="fechaInicio">
                <label for="fecha_fin" class="mr-2">Fecha Fin:</label>
                <input type="date" class="form-control mr-2" name="fecha_fin" id="fechaFin">
            </div>
            <div class="form-group mb-2 col-md-2">
                <button type="submit" class="btn btn-secondary" id="btnFiltar">Generar Reporte</button>
            </div>
        </div>
    </form>
</div>

<script>
function toggleCustomDate(value) {
    var customDateDiv = document.getElementById('custom-date');
    if (value === 'personalizado') {
        customDateDiv.style.display = 'block';
    } else {
        customDateDiv.style.display = 'none';
    }
}


</script>