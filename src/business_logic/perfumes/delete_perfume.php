<?php 
require_once '../../config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $perfume_id = $_POST['id'] ?? null;
        
        $sql = "UPDATE perfumes SET 
                    clave_bouquet = ?, nombre = ?, casa = ?, familia_olfativa = ?, genero = ?, cantidad = ?
                WHERE id_perfume = ?";
        $stmt = $con->prepare($sql);
    }




} catch (Exception $e) {
}
?>