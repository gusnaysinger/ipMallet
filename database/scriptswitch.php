<?php
include('./connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["marca"]) && isset($_POST["modelo"]) && isset($_POST["portas"]) && isset($_POST["qtd"]) && isset($_POST["loc"])) {
        $marca = strtoupper($_POST["marca"]);
        $modelo = strtoupper($_POST["modelo"]);
        $portas = $_POST["portas"];
        $qtd = intval($_POST["qtd"]);
        $loc = $_POST["loc"];
        $obs = strtoupper($_POST["obs"]);
        $work = strtoupper($_POST["funci_check"]);
        

        $sql_insert = "INSERT INTO all_switch (marca, modelo, portas, local, obs, funciona)
                        VALUES ('$marca', '$modelo', '$portas', '$loc', '$obs', '$work')";
        
        
        echo $sql_insert;
        for ($i = 1; $i < $qtd; $i++) {
            $conn->query($sql_insert);
        };
        if ($conn->query($sql_insert) === TRUE) {
            //echo $work;
            echo"<script language=\"javascript\" type=\"text/javascript\">";
            echo"alert(\"Switch cadastrado com sucesso!\");window.location.href=\"../regSwitch.php\"</script>\"";
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
        $conn->close();
    } else {
        $marca = strtoupper($_POST["marca"]);
        $modelo = strtoupper($_POST["modelo"]);
        $portas = $_POST["portas"];
        $qtd = intval($_POST["qtd"]);
        $loc = $_POST["loc"];
        $obs = strtoupper($_POST["obs"]);
        echo "marca:" . $marca . "modelo:" . $modelo . "conector:" . $conector . $qtd . "localizacao:" . $loc . "obs:" . $obs;
    }
} else {
    echo "request method not post";
}
?>