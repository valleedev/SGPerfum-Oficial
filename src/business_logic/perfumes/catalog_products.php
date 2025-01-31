<?php
require_once '../config.php';

$keyBFilter = $_GET['keyB'] ?? '';
$nameFilter = $_GET['name'] ?? '';
$houseFilter = $_GET['house'] ?? '';
$familyOFilter = $_GET['familyO'] ?? '';
$genderFilter = $_GET['gender'] ?? '';
$sizeFilter = $_GET['size'] ?? '';

$sql = "SELECT * FROM perfumes WHERE 1=1";

// filtros si se aplican
if (!empty($keyBFilter)) {
    $sql .= " AND clave_bouquet LIKE '%" . $con->real_escape_string($keyBFilter) . "%'";
}
if (!empty($nameFilter)) {
    $sql .= " AND nombre LIKE '%" . $con->real_escape_string($nameFilter) . "%'";
}
if (!empty($houseFilter)) {
    $sql .= " AND casa LIKE '%" . $con->real_escape_string($houseFilter) . "%'";
}
if (!empty($familyOFilter)) {
    $sql .= " AND familia_olfativa LIKE '%" . $con->real_escape_string($familyOFilter) . "%'";
}
if (!empty($genderFilter)) {
    $sql .= " AND genero = '" . $con->real_escape_string($genderFilter) . "'";
}
if (!empty($sizeFilter)) {
    $sql .= " AND cantidad = '" . $con->real_escape_string($sizeFilter) . "'";
}

$sql .= " ORDER BY id_perfume DESC";

$result = $con->query($sql);
if (!$result) {
    die("Error en la consulta: " . $con->error);
}

?>
<div class="filter-container">
    <form method="GET">
        <div class="row g-2 mb-4">
            <div class="col-md-1">
                <input type="text" id="keyB" name="keyB" class="form-control" placeholder="Clave " value="<?= htmlspecialchars($keyBFilter) ?>">
            </div>
            <div class="col-md-2">
                <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" value="<?= htmlspecialchars($nameFilter) ?>">
            </div>
            <div class="col-md-1">
                <input type="text" id="house" name="house" class="form-control" placeholder="Casa" value="<?= htmlspecialchars($houseFilter) ?>">
            </div>
            <div class="col-md-2">
                <input type="text" id="familyO" name="familyO" class="form-control" placeholder="Familia Olfativa" value="<?= htmlspecialchars($familyOFilter) ?>">
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
                <input type="number" id="size" name="size" class="form-control" placeholder="Cantidad" value="<?= htmlspecialchars($size) ?>">
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
            $id = htmlspecialchars($row['id_perfume']);
            $image = htmlspecialchars($row['imagen']);
            $keyB = htmlspecialchars($row['clave_bouquet']);
            $name = htmlspecialchars($row['nombre']);
            $house = htmlspecialchars($row['casa']);
            $familyO = htmlspecialchars($row['familia_olfativa']);
            $gender = htmlspecialchars($row['genero']);
            $size = htmlspecialchars($row['cantidad']);

            echo "
            <div class='col-lg-4 col-md-6 mb-4'>
                <a href='". VIEWS . "perfume_detail.php?id=$id'>
                <div class='card shadow-sm'>
                    <div class='bg-white flex center'>
                        <img class='card-img-top  w-50 m-2' src='" . PUB . "uploads/perfumes/" . $image ."' alt='$name'  '>
                    </div>
                    <div class='card-body'>
                        <h4 class='card-title'>$name</h4>
                        <p class='card-text'>
                            <strong>Casa:</strong> $house<br>
                            <strong>Código:</strong> $keyB<br>
                            <strong>Género:</strong> $gender<br>
                            <strong>Gramos Disponible:</strong> $size gr<br>
                        </p>
                    </div>
                </div>
                </a>
            </div>";
        }
    } else {
        echo "<p>No se encontraron fragancias que coincidan con los filtros.</p>";
    }
    ?>
</div>
