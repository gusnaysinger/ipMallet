<?php
include('database/connection.php');

header('Content-Type: application/json');

// Fetch data for OS
$sqlOS = "SELECT `os`, COUNT(*) as count FROM `all_computers` GROUP BY `os`";
$resultOS = $conn->query($sqlOS);

$osData = ['labels' => [], 'data' => []];
while ($row = $resultOS->fetch_assoc()) {
    $osData['labels'][] = $row['os'];
    $osData['data'][] = $row['count'];
}

// Fetch data for Local
$sqlLocal = "SELECT `local`, COUNT(*) as count FROM `all_computers` GROUP BY `local`";
$resultLocal = $conn->query($sqlLocal);

$localData = ['labels' => [], 'data' => []];
while ($row = $resultLocal->fetch_assoc()) {
    $localData['labels'][] = $row['local'];
    $localData['data'][] = $row['count'];
}

echo json_encode(['os' => $osData, 'local' => $localData]);

$conn->close();
?>
