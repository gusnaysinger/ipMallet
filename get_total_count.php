<?php
include('database/connection.php');

header('Content-Type: application/json');

// Fetch total count
$sql = "SELECT COUNT(*) as total FROM `all_computers`";
$result = $conn->query($sql);

$data = $result->fetch_assoc();

echo json_encode(['total' => $data['total']]);

$conn->close();
?>
