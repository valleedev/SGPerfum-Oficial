<?php

include '../config.php'; 

header('Content-Type: application/json'); // Asegura que la salida sea JSON

// Función para validar el archivo de imagen
function validateImage($image) {
    $allowedFormats = ['image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (!in_array($image['type'], $allowedFormats)) {
        return json_encode(['success' => false, 'message' => 'Formato de imagen no permitido. Solo se permiten JPG o PNG.']);
    }

    if ($image['size'] > $maxSize) {
        return json_encode(['success' => false, 'message' => 'El tamaño de la imagen excede el límite de 2MB.']);
    }

    return json_encode(['success' => true]);
}

// Función para manejar la carga de una nueva imagen
function uploadImage($table, $column, $idColumn, $id, $image) {
    global $con; 

    $validation = json_decode(validateImage($image), true);
    if (!$validation['success']) {
        echo json_encode($validation);
        return;
    }

    $targetDir = "../../../public/uploads/$table/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $newImageName = "$id.$imageExtension";
    $targetFile = $targetDir . $newImageName;

    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        $query = "UPDATE $table SET $column = ? WHERE $idColumn = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('si', $newImageName, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Imagen cargada exitosamente.', 'image' => $newImageName]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al subir la imagen.']);
    }
}

// Función para manejar la actualización de una imagen existente
function updateImage($table, $column, $idColumn, $id, $image) {
    global $con;

    $validation = json_decode(validateImage($image), true);
    if (!$validation['success']) {
        return json_encode($validation);
    }

    $currentImage = null;

    $query = "SELECT $column FROM $table WHERE $idColumn = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($currentImage);
        $stmt->fetch();
    }

    $stmt->close();

    if ($currentImage) {
        $currentImagePath = "../../../public/uploads/$table/$currentImage";
        if (file_exists($currentImagePath)) {
            unlink($currentImagePath);
        }
    }

    $targetDir = "../../../public/uploads/$table/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $newImageName = "$id.$imageExtension";
    $targetFile = $targetDir . $newImageName;

    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        $query = "UPDATE $table SET $column = ? WHERE $idColumn = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('si', $newImageName, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return json_encode(['success' => true, 'message' => 'Imagen actualizada exitosamente.', 'image' => $newImageName]);
        } else {
            $stmt->close();
            return json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
        }
    } else {
        return json_encode(['success' => false, 'message' => 'Error al subir la imagen.']);
    }
}
