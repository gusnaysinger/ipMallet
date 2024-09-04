<?php
include('database/connection.php');

// Verifica se o formulário foi enviado
echo "Método de requisição: " . $_SERVER['REQUEST_METHOD'] . "<br>";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['passwd'];

    // Prepara a consulta SQL com placeholders para evitar SQL Injection
    $sql = $conn->prepare("SELECT id, passwd FROM users WHERE user = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    // Verifica as credenciais
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['passwd'])) {
            // Credenciais corretas
            $_SESSION['user'] = $username;
            echo "Login bem-sucedido! Bem-vindo, " . htmlspecialchars($username) . ".";
        } else {
            // Senha incorreta
            echo "Nome de usuário ou senha incorretos.";
        }
    } else {
        // Usuário não encontrado
        echo "Nome de usuário ou senha incorretos.";
    }

    // Fecha a consulta
    $sql->close();
} else {
    echo "Método de requisição inválido.";
}

// Fecha a conexão
$conn->close();
?>
