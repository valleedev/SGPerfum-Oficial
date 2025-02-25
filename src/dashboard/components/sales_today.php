<?php
include_once '../business_logic/sales_today_logic.php';
?>


<div class="col-lg-8 px-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Ventas Realizadas Hoy</h4>
            <p class="card-subtitle mb-4 font-size-13">Resumen de ventas del día actual</p>
            <div class="table-responsive">
                <table class="table table-centered table-striped table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>Nombre de Vendedor</th>
                            <th>Cantidad de Ventas</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td class="table-user">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">
                                        <?php echo htmlspecialchars($row['nombre']); ?>
                                    </a>
                                </td>
                                <td><?php echo $row['cantidad_ventas']; ?></td>
                                <td>
                                    <a href="detalles_ventas.php?usuario_id=<?php echo $row['id_usuario']; ?>" class="btn btn-primary btn-sm">
                                        Ver Detalles
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$con->close();

?>
