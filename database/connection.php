<?php 
$server = "localhost";
$user = "root";
$password = "f1r3f0xM4ll3t1831";
$dbname = "computers";

//criar conexao
$conn = mysqli_connect($server, $user, $password, $dbname);
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
?>
