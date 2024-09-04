<?php
include('connection.php');

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
};

//echo "aaaa";
if (1 == 1) {
    $db = $_POST['db'];
    $web = $_POST['web'];

    $id = $_POST['id'];
    $loc = $_POST['loc'];
    $marca = strtoupper($_POST['marca']);
    $modelo = strtoupper($_POST['modelo']);
    $func = $_POST['func'];
    $obs = strtoupper($_POST['obs']);
    
    $sqlUpdate = "UPDATE $db SET 
        local = '$loc', 
        marca = '$marca', 
        modelo = '$modelo', 
        funciona = '$func', 
        obs = '$obs' 
        WHERE id = $id";

    $stmt = $conn->prepare($sqlUpdate);
    if ($stmt->execute()) {
        echo"<script language=\"javascript\" type=\"text/javascript\">";
        echo"window.location.href=\"../" . $web .".php\"</script>\"";
    } else {
        echo "Erro ao atualizar registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
};

?>