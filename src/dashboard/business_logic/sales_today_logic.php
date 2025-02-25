<?php
require_once '../../config.php'; 

$fecha_hoy = date('Y-m-d');

// Consulta para obtener el nombre de usuario y la cantidad de ventas del día actual
$sql = "SELECT usuarios.id_usuario, usuarios.nombre, COUNT(ventas.id_venta) as cantidad_ventas 
        FROM usuarios 
        LEFT JOIN ventas ON usuarios.id_usuario = ventas.id_usuario AND DATE(ventas.fecha_hora) = '$fecha_hoy'
        GROUP BY usuarios.id_usuario, usuarios.nombre";
$result = $con->query($sql);
?>