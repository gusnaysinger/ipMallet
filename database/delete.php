<?php 
include('connection.php');

echo $sql;
echo $id;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $db = $_GET['db'];
    $web = $_GET['web'];

    // Validação e sanitização do ID (por segurança)
    $id = intval($id);

    // Preparar a consulta SQL para deletar o registro
    $sqlDelete = "DELETE FROM `$db` WHERE id = $id";
    
    $stmt = $conn->prepare($sqlDelete);
    if ($stmt->execute()) {
        echo"<script language=\"javascript\" type=\"text/javascript\">";
                echo"window.location.href=\"../" . $web .".php\"</script>\"";
    } else {
        echo "Erro ao deletar registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "error requisition method";
}
?>