<?php

$sql = "SELECT * FROM usuarios";
$result = $con->query($sql);

$usuarios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
} else {
    echo json_encode(["mensaje" => "No se encontraron usuarios"]);
}

$con->close();
?>
