<?php
require_once '../config.php';

$nameFilter = $_GET['name'] ?? '';
$brandFilter = $_GET['brand'] ?? '';
$genderFilter = $_GET['gender'] ?? '';
$minPrice = $_GET['min_price'] ?? '';
$maxPrice = $_GET['max_price'] ?? '';

$sql = "SELECT * FROM perfumes WHERE 1=1";

// filtros si se aplican
if (!empty($nameFilter)) {
    $sql .= " AND nombre LIKE '%" . $con->real_escape_string($nameFilter) . "%'";
}
if (!empty($brandFilter)) {
    $sql .= " AND marca LIKE '%" . $con->real_escape_string($brandFilter) . "%'";
}
if (!empty($genderFilter)) {
    $sql .= " AND genero = '" . $con->real_escape_string($genderFilter) . "'";
}
if (!empty($minPrice)) {
    $sql .= " AND precio >= " . (float)$minPrice;
}
if (!empty($maxPrice)) {
    $sql .= " AND precio <= " . (float)$maxPrice;
}

$sql .= " ORDER BY id DESC";

$result = $con->query($sql);
?>
<div class="filter-container">
    <form method="GET">
        <div class="row g-2 mb-4">
            <div class="col-md-2">
                <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" value="<?= htmlspecialchars($nameFilter) ?>">
            </div>
            <div class="col-md-2">
                <input type="text" id="brand" name="brand" class="form-control" placeholder="Marca" value="<?= htmlspecialchars($brandFilter) ?>">
            </div>
            <div class="col-md-2">
                <select id="gender" name="gender" class="form-select">
                    <option value="">Género</option>
                    <option value="Masculino" <?= ($genderFilter == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                    <option value="Femenino" <?= ($genderFilter == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
                    <option value="Unisex" <?= ($genderFilter == 'Unisex') ? 'selected' : '' ?>>Unisex</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" id="min_price" name="min_price" class="form-control" placeholder="Min. $" value="<?= htmlspecialchars($minPrice) ?>">
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" id="max_price" name="max_price" class="form-control" placeholder="Max. $" value="<?= htmlspecialchars($maxPrice) ?>">
            </div>
            <div class="col-md-2 text-start">
                <button type="submit" class="btn btn-primary btn-lr">Filtrar</button>
                <a href="?" class="btn btn-secondary btn-lr">Limpiar</a>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = htmlspecialchars($row['id']);
            $image = htmlspecialchars($row['imagen']);
            $name = htmlspecialchars($row['nombre']);
            $brand = htmlspecialchars($row['marca']);
            $gender = htmlspecialchars($row['genero']);
            $price = number_format($row['precio'], 2);
            $size = htmlspecialchars($row['tamano']);
            $concentration = htmlspecialchars($row['concentracion']);

            echo "
            <div class='col-lg-4 col-md-6 mb-4'>
                <a href='". VIEWS . "perfume_detail.php?id=$id'>
                <div class='card shadow-sm'>
                    <div class='bg-white flex center'>
                        <img class='card-img-top img-fluid w-50 m-2' src='" . PUB . "uploads/perfumes/" . $image ."' alt='$name'  '>
                    </div>
                    <div class='card-body'>
                        <h4 class='card-title'>$name</h4>
                        <p class='card-text'>
                            <strong>Marca:</strong> $brand<br>
                            <strong>Género:</strong> $gender<br>
                            <strong>Tamaño:</strong> $size ml<br>
                            <strong>Concentración:</strong> $concentration<br>
                            <strong>Precio:</strong> <span class='text-success'>$$price</span>
                        </p>
                    </div>
                </div>
                </a>
            </div>";
        }
    } else {
        echo "<p>No se encontraron perfumes que coincidan con los filtros.</p>";
    }
    ?>
</div>
