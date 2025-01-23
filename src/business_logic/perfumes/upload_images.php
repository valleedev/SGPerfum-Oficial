<?php

include '../config.php'; 

// Función para validar el archivo de imagen
function validateImage($image) {
    $allowedFormats = ['image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (!in_array($image['type'], $allowedFormats)) {
        return 'Formato de imagen no permitido. Solo se permiten JPG o PNG.';
    }

    if ($image['size'] > $maxSize) {
        return 'El tamaño de la imagen excede el límite de 2MB.';
    }

    return true;
}

// Función para manejar la carga de una nueva imagen
function uploadImage($table, $column, $idColumn, $id, $image) {
    global $con; 

    $validation = validateImage($image);
    if ($validation !== true) {
        echo $validation;
        return;
    }

    $targetDir = "../../../public/uploads/$table/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Crea la carpeta si no existe
    }

    $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $newImageName = "$id." . $imageExtension;
    $targetFile = $targetDir . $newImageName;

    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        // Inserta el nombre de la imagen en la base de datos
        $query = "UPDATE $table SET $column = ? WHERE $idColumn = ?";
        $stmt =$con->prepare($query);
        $stmt->bind_param('si', $newImageName, $id);

        if ($stmt->execute()) {
            echo 'Imagen cargada exitosamente.';
        } else {
            echo 'Error al actualizar la base de datos.';
        }

        $stmt->close();
    } else {
        echo 'Error al subir la imagen.';
    }
}

// Función para manejar la actualización de una imagen existente
function updateImage($table, $column, $idColumn, $id, $image) {
    global $con; // Usamos la conexión de la base de datos incluida desde config.php

    // Primero validamos la nueva imagen
    $validation = validateImage($image);
    if ($validation !== true) {
        echo $validation;
        return;
    }

    // Inicializar la variable $currentImage en null antes de la consulta
    $currentImage = null;

    // Obtener el nombre de la imagen actual desde la base de datos
    $query = "SELECT $column FROM $table WHERE $idColumn = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result(); // Asegura que los resultados se almacenen

    // Verificamos si hay algún resultado
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($currentImage);  // Vínculo de la columna con la variable
        $stmt->fetch();
    }

    $stmt->close();

    // Eliminar la imagen actual si existe
    if ($currentImage) {
        $currentImagePath = "../../public/uploads/$table/$currentImage";
        if (file_exists($currentImagePath)) {
            unlink($currentImagePath);  // Eliminar la imagen del servidor
        }
    }

    // Subir la nueva imagen
    $targetDir = "../../public/uploads/$table/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);  // Crear la carpeta si no existe
    }

    $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $newImageName = "$id." . $imageExtension;
    $targetFile = $targetDir . $newImageName;

    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        // Actualizar la base de datos con el nuevo nombre de la imagen
        $query = "UPDATE $table SET $column = ? WHERE $idColumn = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('si', $newImageName, $id);

        if ($stmt->execute()) {
            echo 'Imagen actualizada exitosamente.';
        } else {
            echo 'Error al actualizar la base de datos.';
        }

        $stmt->close();
    } else {
        echo 'Error al subir la imagen.';
    }
}
?>
