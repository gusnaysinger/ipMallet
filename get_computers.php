<?php
include('database/connection.php');

header('Content-Type: application/json');

// Obter o rótulo dos parâmetros da URL
$label = $_GET['label'];
$label = $conn->real_escape_string($label);

// Buscar computadores com base no rótulo
$sql = "SELECT * FROM `all_computers` WHERE `os` = '$label' OR `local` = '$label'";
$result = $conn->query($sql);

$computers = [];
while ($row = $result->fetch_assoc()) {
    $computers[] = $row;
}

echo json_encode($computers);

$conn->close();
?>
