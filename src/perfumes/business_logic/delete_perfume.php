<?php 
require_once '../../config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $perfume_id = $_POST['id'] ?? null;

        if ($perfume_id) {
            // Obtener el nombre del archivo de imagen asociado al perfume
            $sql = "SELECT imagen FROM perfumes WHERE id_perfume = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $perfume_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $imagen = $row['imagen']; // Nombre del archivo con extensión
                
                // Definir la ruta de la imagen (ajústala según la ubicación real de los archivos)
                $rutaImagen = "../../../public/uploads/perfumes/" . $imagen;
                
                // Verificar si la imagen existe y eliminarla
                if (file_exists($rutaImagen)) {
                    if (!unlink($rutaImagen)) {
                        echo "<script>alert('No se pudo eliminar la imagen asociada.');</script>";
                    }
                }
            }

            // Eliminar el registro del perfume de la base de datos
            $sql = "DELETE FROM perfumes WHERE id_perfume = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $perfume_id);
            
            if ($stmt->execute()) {
                echo "<script>alert('Perfume eliminado correctamente.'); window.location.href='../views/list_perfumes.php';</script>";
            } else {
                echo "<script>alert('No se pudo eliminar el perfume.'); window.location.href=document.referrer;</script>";
            }
        } else {
            echo "<script>alert('ID de perfume no proporcionado.'); window.location.href=document.referrer;</script>";
        }
    } else {
        echo "<script>alert('Método no permitido.'); window.location.href=document.referrer;</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href=document.referrer;</script>";
}
?>
