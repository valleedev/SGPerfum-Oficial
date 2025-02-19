<?php
session_start();
require_once '../../config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo json_encode(['success' => false, 'message' => 'Error al obtener los datos del usuario']);
    exit;
}

$usuario = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents('php://input');
    $saleData = json_decode($inputJSON, true);

    if (!$saleData) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
        exit;
    }

    if (!$con) {
        echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
        exit;
    }

    $totalVenta = array_sum(array_column($saleData, 'subtotal'));
    $id_vendedor = $usuario['id_usuario'];

    // Insertar venta
    $sqlVenta = "INSERT INTO ventas (id_usuario, fecha_hora) VALUES (?, NOW())";
    $stmtVenta = $con->prepare($sqlVenta);
    $stmtVenta->bind_param("i", $id_vendedor);

    if (!$stmtVenta->execute()) {
        echo json_encode(['success' => false, 'message' => 'Error al registrar la venta']);
        exit;
    }

    $id_venta = $con->insert_id;
    if (!$id_venta) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener el ID de la venta']);
        exit;
    }

    $sqlDetalle = "INSERT INTO detalle_ventas (id_venta, id_perfume, id_envase, gramos_en_venta, gramos_adicionales, valor_venta) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtDetalle = $con->prepare($sqlDetalle);

    foreach ($saleData as $item) {
        $clave_fragancia = $item['clave'];
        $id_envase = (int) $item['envase'];
        $gramos_en_venta = (int) $item['total_gramos'];
        $gramos_adicionales = (int) $item['gramos_adicionales'];

        $query = $con->prepare("SELECT id_perfume FROM perfumes WHERE clave_bouquet = ?");
        $query->bind_param("s", $clave_fragancia);
        $query->execute();
        $query->bind_result($id_perfume);
        $query->fetch();
        $query->close();

        if (!$id_perfume) {
            echo json_encode(['success' => false, 'message' => "El perfume con clave '$clave_fragancia' no existe"]);
            exit;
        }

        if (!$stmtDetalle->bind_param("iiiiii", $id_venta, $id_perfume, $id_envase, $gramos_en_venta, $gramos_adicionales, $totalVenta)) {
            echo json_encode(['success' => false, 'message' => 'Error al preparar el detalle de venta']);
            exit;
        }

        if (!$stmtDetalle->execute()) {
            echo json_encode(['success' => false, 'message' => 'Error al registrar el detalle de la venta']);
            exit;
        }
    }

    $stmtVenta->close();
    $stmtDetalle->close();
    $con->close();

    echo json_encode(['success' => true, 'message' => 'Venta registrada con éxito', 'id_venta' => $id_venta]);
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida']);
}
