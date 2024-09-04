<?php
include('./connection.php');
//Pegar ip do usuario
$ip = $_SERVER['REMOTE_ADDR'];

//
//
//


// Postar informacoes do formulario no database 
// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos obrigatórios estão preenchidos
    if (isset($_POST["loc"]) && isset($_POST["posgrad"]) && isset($_POST["user_name"]) && isset($_POST["cpu"]) && isset($_POST["os"]) && isset($_POST["ram"]) && isset($_POST["rom"]) && isset($_POST["ip_addr"]) && isset($_POST["mac_addr"]) && isset($_POST["n_ficha"])) {
        
        // Conexão com o banco de dados (já que você já incluiu o arquivo de conexão)
        include('database/connection.php');

        // Captura os dados do formulário
        $local = $_POST["loc"];
        $user_name =strtoupper($_POST["user_name"]);
        $postograd = $_POST["posgrad"];
        $cpu = strtoupper($_POST["cpu"]);
        $os = $_POST["os"];
        $ram = $_POST["ram"];
        $rom = $_POST["rom"];
        $ip_addr = $_POST["ip_addr"];
        $mac_addr = strtoupper($_POST["mac_addr"]);
        $n_ficha = strtoupper(trim($_POST["n_ficha"]));
        $n_lacre = strtoupper(trim($_POST["n_lacre"]));
        $obs = strtoupper($_POST["obs"]);

        //alteracao de valores caso null
        if (empty($n_lacre)) {
            $n_lacre = "0000";
        };
        if (empty($n_ficha)) {
            $n_ficha = "0000";
        };

        // Aqui você pode executar as ações desejadas com os dados, como inserir no banco de dados
       $sql_insert = "INSERT INTO all_computers (local,  user, cpu, os, ram, rom, ip_addr, mac_addr, n_ficha, n_lacre, obs, pos) 
                      VALUES ('$local', '$user_name', '$cpu', '$os', '$ram', '$rom', '$ip_addr', '$mac_addr', '$n_ficha', '$n_lacre', '$obs', '$postograd')";
        
        if (1 == 1) {
            //echo "SQL: " . $sql_insert . "<br>";
            //var_dump($sql_insert);
            if ($conn->query($sql_insert) === TRUE) {
                echo"<script language=\"javascript\" type=\"text/javascript\">";
                echo"alert(\"Hardware cadastrado com sucesso!\");window.location.href=\"../regComp.php\"</script>\"";
            } else {
                echo "Erro ao inserir registro: " . $conn->error;
            }
        };

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Se algum campo obrigatório não estiver preenchido, exiba uma mensagem de erro
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
} else {
    // Se a requisição não for POST, exiba uma mensagem de erro
    echo "Erro: método de requisição inválido.";
}

?>