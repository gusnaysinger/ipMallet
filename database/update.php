<?php
include('connection.php');

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $user_name = strtoupper($_POST['user_name']);
    $posgrad = $_POST['posgrad'];
    $cpu = strtoupper($_POST['cpu']);
    $os = $_POST['system'];
    $ram = $_POST['ram'];
    $rom = $_POST['rom'];
    $ip_addr = $_POST['ip_addr'];
    $mac_addr = strtoupper($_POST['mac_addr']);
    $n_ficha = $_POST['n_ficha'];
    $n_lacre = strtoupper(trim($_POST['n_lacre']));
    $n_lacre = strtoupper(trim($_POST['n_lacre']));
    $loc = $_POST['loc'];
    $obs = strtoupper($_POST['obs']);

    $sqlUpdate = "UPDATE all_computers SET 
        user = '$user_name', 
        pos = '$posgrad', 
        cpu = '$cpu', 
        os = '$os', 
        ram = '$ram', 
        rom = '$rom', 
        ip_addr = '$ip_addr', 
        mac_addr = '$mac_addr', 
        n_ficha = '$n_ficha', 
        n_lacre = '$n_lacre', 
        local = '$loc', 
        obs = '$obs' 
        WHERE id = $id";

    $stmt = $conn->prepare($sqlUpdate);
    //$stmt->bind_param("ssssssssssssi", $user_name, $posgrad, $cpu, $os, $ram, $rom, $ip_addr, $mac_addr, $n_ficha, $n_lacre, $loc, $obs, $id);
    if ($stmt->execute()) {
        echo"<script language=\"javascript\" type=\"text/javascript\">";
                echo"window.location.href=\"../index.php\"</script>\"";
    } else {
        echo "Erro ao atualizar registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}




//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    // Obtenha os dados do formulário
//    $id = intval($_POST['id']);
//    $user_name = $_POST['user_name'];
//    $posgrad = $_POST['posgrad'];
//    $cpu = $_POST['processor'];
//    $os = $_POST['system'];
//    $ram = $_POST['ram'];
//    $rom = $_POST['rom'];
//    $ip_addr = $_POST['ip_addr'];
//    $mac_addr = $_POST['mac_addr'];
//    $n_ficha = $_POST['n_ficha'];
//    $n_lacre = $_POST['n_lacre'];
//    $loc = $_POST['loc'];
//    $obs = $_POST['obs'];
//    echo "aaa";
//    // Prepare a declaração SQL
//    $stmt = $conn->prepare("UPDATE `all_computers` SET user_name = ?, posgrad = ?, cpu = ?, os = ?, ram = ?, rom = ?, ip_addr = ?, mac_addr = ?, n_ficha = ?, n_lacre = ?, loc = ?, obs = ? WHERE id = ?");
//    if ($stmt === false) {
//        die("Erro na preparação da declaração: " . $conn->error);
//    }
//
//    $stmt->bind_param('ssssssssssssi', $user_name, $posgrad, $cpu, $os, $ram, $rom, $ip_addr, $mac_addr, $n_ficha, $n_lacre, $loc, $obs, $id);
//
//    // Execute a declaração SQL
//    if ($stmt->execute()) {
//        echo "Registro atualizado com sucesso.";
//    } else {
//        echo "Erro ao atualizar registro: " . $stmt->error;
//    }
//
//    // Fechar a declaração e a conexão
//    $stmt->close();
//    $conn->close();
//}
?>
