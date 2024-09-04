<?php
session_start();
include('database/connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //session_start();
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
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./media/pc_2291988.png" type="image/png">
    <link href="./styles.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script language="JavaScript" type="text/javascript"></script>
    <style>
        .realloginmonengue {
            margin-top: 18vh;
        }
        .tchunais {
            width: 120px;
        }
    </style>
    <title>Ips Mallet - Login</title>
</head>
<body data-bs-theme="dark">
    <div class="card">
        <div class="card-header text-center">
            <div class="logo">
                <img src="./media/pc_2291988.png" class="logo">
            </div>
        </div>
        <div class="card-body ps-0 pe-0" style="min-height: 78vh;">
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <div class="row align-items-center">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center realloginmonengue">
            <i class="fa-regular fa-user fs-1"></i>
                <form method="POST" action="">
                    <div class="input-group flex-nowrap mt-3">
                        <span class="input-group-text fs-4 tchunais" id="user">Usuario</span>
                        <input type="text" name="username" class="form-control fs-4" aria-describedby="user">
                    </div>
                    <div class="input-group flex-nowrap mt-3">
                        <span class="input-group-text fs-4 tchunais" id="passwd">Senha</span>
                        <input type="password" name="passwd" class="form-control fs-4" aria-describedby="passwd">
                    </div>
                    <button type="submit" class="btn btn-outline-primary w-100 fs-4 mt-3">Login</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
        </div>
        <div class="card-footer text-muted text-center">
            Sistema criado por Sd Naysinger - 2024
        </div>
    </div>
    <script src="./script.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0635eb955e.js" crossorigin="anonymous"></script>
</body>
</html>